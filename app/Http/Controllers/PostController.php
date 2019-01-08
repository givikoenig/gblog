<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WidgetRepository;
use App\Repositories\PblRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use risul\LaravelLikeComment\Models\Comment;

use App\Post;
use App\About;
use App\Tag;
use Auth;
use Session;
use OpenGraph;
use App\Mail\ViewHero;

class PostController extends Controller {

    protected $w_rep;
    protected $p_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $image;
    protected $desc;
    protected $og;
//    protected $og;
    
    public function __construct(WidgetRepository $w_rep, PblRepository $p_rep) {
        $this->w_rep = $w_rep;
        $this->p_rep = $p_rep;
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
        /** ==== Данные для виджетов сайдбара   ======*/
        $this->alltags = $this->w_rep->getAllTags();
        $this->lastposts = $this->w_rep->getLastPosts();
        $this->lastcomments = $this->w_rep->getLastComments();
        $this->title = config('app.name');
        $this->meta_desc = 'GiviK blog';
        $this->keywords = 'GiviK blog';
        $this->image = asset('assets').'/img/post/tearsofsteel.jpg';
        $this->description = 'GiViK IT:SYS:WEB:PRO v.1.0';
        $this->og = '';
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = $this->p_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->image,$this->description);
        if (view()->exists('posts.index')) {
            $category = $request['category'];
            $keyword = Input::get('keyword', '');
            if(isset($category)) {
                 $posts = Tag::find($category)->posts()->orderBy('created_at', 'desc')->paginate(4);
            } else {
                if ($keyword) {
                 $posts = Post::SearchByKeyword($keyword)->paginate(4);
                } else {
                    $posts = Post::orderBy('created_at', 'desc')->paginate(4);
                }
            }
//            $posts_array = $posts->toArray();
    //        dd($posts_array['data'][0]['title']);
            /** ===== массив для постов типа gallery ========= */ 
            $slides = [];
            foreach ($posts as $item) {
                $slides[$item->id] = $item->img_slide;
            }
            /** ===== End of массив для постов типа gallery ===== */
            /** ===== данные для раздела "Обо мне" сайдбара ===== */
            $abouts = About::where('active', 1)->get();
            /** ===== End Of данные для раздела "Обо мне" сайдбара ===== */
            /** ==== массив коллекций тегов для каждой из статей  ======*/
            $tags = [];
            foreach ($posts as $post) {
                $tmp = $post->tags;
                array_push($tags, $tmp);
            }
            /** ==== End Of массив коллекций тегов ======*/
            return view('posts.index', $data,  [
                'posts' => $posts,
                'slides' => $slides,
                'abouts' => $abouts,
                'tags' => $tags,
                'lasts' => $this->lastposts,
                'alltags' => $this->alltags,
                'lastcomments' => $this->lastcomments,
            ]);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 

    //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required',
            ]);

        $title = $request['title'];
        $body = $request['body'];

        $post = Post::create($request->only('title', 'body', 'user_id'));

    //Display a successful message upon save
        return redirect()->route('posts.index')
            ->with('flash_message', 'Article,
             '. $post->title.' created');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $alias) {
        if (!$alias) {
            abort(404);
        }

        $post = Post::where('alias', strip_tags($alias))->first();


        if (!is_object($post)) {
            abort(404);
        }
        $this->title = $post->title;
        $this->meta_desc = $post->meta_desc;
        $this->keywords = $post->keywords;
        $this->description = $post->desc;
        $this->image = $post->img;
        
        $data = $this->p_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->image,$this->description);

        $og = new OpenGraph();

        $og = OpenGraph::title($post->title)
            ->type('article')
            ->image( asset('assets') . '/img/post/' . $post->img)
            ->description($post->desc)
            ->url();
         $this->og = $og;
         $og= $og->renderTags();
        /** ===== массив для постов типа gallery ========= */ 
        $slides = $post->img_slide;
        /** ===== End of массив для постов типа gallery ===== */
        
        // $post->tag('программирование');
        // $post->tag('cats');
        // $post->untag('php');
        // $post->untag();
        // $post->setTags('laravel, php');

        /** ==== массив тегов данного поста   ======*/
        // $tags=$post->tags;
        /** ==== End Of массив тегов данного поста   ======*/

        /** ==== кол-во комментариев к данному посту   ======*/
        $commentcount = Comment::where('item_id', $post->id)->count();
        /** ==== End Of кол-во комментариев к данному посту   ======*/

        // get previous post id
        $previous = Post::where('id', '<', $post->id)->max('id');

        // get next post id
        $next = Post::where('id', '>', $post->id)->min('id');
        
        $url_data = [
    		array(
    			'title' => 'DKA-DEVELOP',
    			'url' => 'https://dka-develop.ru'
    		),
    		array(
    			'title' => 'GiViK',
    			'url' => 'http://givik.ru'
    		)
    	];
        
        if (view()->exists('posts.show')) {
            return view('posts.show', compact('post'), [
                'title' => $data['title'],
                'meta_desc' => $data['meta_desc'],
                'keywords' => $data['keywords'],
                'image' => $data['image'],
                'desc' => $data['desc'],
                'slides' => $slides,
                'previous' => $previous,
                'next' => $next,
                'commentcount' => $commentcount,
                'lasts' => $this->lastposts,
                'alltags' => $this->alltags,
                'lastcomments' => $this->lastcomments,
                'og' => $og,
                'url_data' => $this->lastposts
                
            ]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'title'=>'required|max:100',
            'body'=>'required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect()->route('posts.show', 
            $post->alias)->with('flash_message', 
            'Article, '. $post->title.' updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('flash_message',
             'Article successfully deleted');

    }

     public function mail()
     {
        Mail::to('ivan@enet.ru')->send(new ViewHero());
           return 'Email was sent';
     }
    
}
