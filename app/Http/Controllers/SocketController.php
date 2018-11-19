<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WidgetRepository;
use App\Repositories\PblRepository;
use risul\LaravelLikeComment\Models\Comment;

use App\Post;
use App\About;
use App\Tag;
use Auth;
use Session;
use OpenGraph;

class SocketController extends Controller
{
    protected $w_rep;
    protected $p_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $image;
    protected $desc;
    
        public function __construct(WidgetRepository $w_rep, PblRepository $p_rep) {
            $this->w_rep = $w_rep;
            $this->p_rep = $p_rep;
//            $this->middleware(['auth', 'clearance'])->except('index', 'show');
            /** ==== Данные для виджетов сайдбара   ======*/
            $this->alltags = $this->w_rep->getAllTags();
            $this->lastposts = $this->w_rep->getLastPosts();
            $this->lastcomments = $this->w_rep->getLastComments();
            $this->title = config('app.name');
            $this->meta_desc = 'GiviK blog';
            $this->keywords = 'GiviK blog';
            $this->image = 'https://givik.ru/assets/img/posts/photo_7830_20081101.jpg';
            $this->desc = 'GiViK IT:SYS:WEB:PRO v.1.0';
        }
    
	public function index(Request $request, $alias="vue-laravel-realtime-charts") {
            
            $data = $this->p_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->image,$this->desc);
            $post = Post::where('alias', strip_tags($alias))->first();
            $previous = Post::where('id', '<', $post->id)->max('id');
            $next = Post::where('id', '>', $post->id)->min('id');
            $commentcount = Comment::where('item_id', $post->id)->count();
		return view('posts.socket', $data, [
                    'post' => $post,
                    'lasts' => $this->lastposts,
                    'alltags' => $this->alltags,
                    'lastcomments' => $this->lastcomments,
                    'previous' => $previous,
                    'next' => $next,
                    'commentcount' => $commentcount,
                ]);
	}

	public function newEvent(\Illuminate\Http\Request $request) {

    	$result = [
            'labels' => ['март', 'апрель', 'май', 'июнь'],
            'datasets' => array([
                'label' => 'Продажи',
                'borderColor' => '#726202',
		'borderWidth' => 1, 
		'pointBorderColor' => '#726202',
                'backgroundColor' => 'rgba(0, 231, 255, 0.25)',
//				'backgroundColor' => '#F26202',
                'data' => [5000,24000,10000,30000],
            ]),
        ];
        
        if ($request->has('label')) {
            $result['labels'][] = $request->input('label');
            $result['datasets'][0]['data'][] = (integer)$request->input('sale');
            if ($request->has('realtime')) {
	       	if ( $request->input('realtime') == "true" ) {
                    event(new \App\Events\NewEvent($result));
	        }
	    }
        }
        return $result;
    }

}
