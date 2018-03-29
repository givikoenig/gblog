<?php

namespace App\Admin\Controllers;

use App\Post;
use App\PostType;
use App\User;
use App\Tag;
use DB;
use App\Admin\Extensions\DeletePost;
use App\Repositories\PblRepository;
use App\Repositories\WidgetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use risul\LaravelLikeComment\Models\Comment;
use risul\LaravelLikeComment\Models\Like;
    
class PostController extends Controller
{

    use ModelForm;

    protected $p_rep;
    protected $w_rep;

    public function __construct(PblRepository $p_rep, WidgetRepository $w_rep) {

        $this->p_rep = $p_rep;
        $this->w_rep = $w_rep;

    }

 /**
     * Saves encoded image in filesystem - Original !!!!!
     * It doesn't work in Windows Server ( see: https://github.com/Intervention/image/issues/231#issuecomment-308308621 )
     * In fact - I've changed the method directly in vendor\intervention\image\src\Intervention\Image\Image.php 
     *
     * @param  string  $path
     * @param  integer $quality
     * @return \Intervention\Image\Image
     */
    // public function save($path = null, $quality = null)
    // {

    //     $path = is_null($path) ? $this->basePath() : $path;

    //     if (is_null($path)) {
    //         throw new Exception\NotWritableException(
    //             "Can't write to undefined path."
    //         );
    //     }

    //     $data = $this->encode(pathinfo($path, PATHINFO_EXTENSION), $quality);


    //     $saved = @file_put_contents($path, $data);

    //     if ($saved === false) {
    //         throw new Exception\NotWritableException(
    //             "Can't write image data to path ({$path})"
    //         );
    //     }

    //     // set new file info
    //     $this->setFileInfoFromPath($path);

    //     return $this;
    // }




    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {

        return Admin::content(function (Content $content) {

            $content->header('Статьи');
            $content->description('СПИСОК');

            $content->body($this->grid());
        });

    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit( $id)
    {       
            return Admin::content(function (Content $content) use ($id) {
            $post =  Post::findOrFail($id);
            $content->header('"' . $post->title . '"');
            $content->description(' РЕДАКТИРОВАНИЕ');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Статья');
            $content->description('СОЗДАНИЕ');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Post::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Заголовок')->editable();
            $grid->user()->name('Автор');
            $grid->img("Изображение")->image( asset( 'assets') . '/img/post/', 100 ) ;
            $grid->desc('Описание')->display(function($desc) {
                return str_limit($desc, 100, '…');
            });
            $grid->column('column_not_in_table', 'Лайки')->display(function(){
                $likes = Like::where('item_id', $this->id)->count();
                return $likes;
            });
            $grid->column('column_not_in_table', 'Комментарии')->display(function(){
                $comments = Comment::where('item_id', $this->id)->count();
                return $comments;
            });
            $grid->posttype()->name('Тип');
            $grid->alias('Slug');
            $grid->created_at('Дата создания');
            $grid->updated_at('Дата обновления');
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->append(new DeletePost($actions->getKey()));
            });

        });
    }


    protected function remove(Request $request) {
        
        $post = Post::find($request->get('id'));

        $post_comments = Comment::where('item_id', $post->id)->get();
        foreach ($post_comments as $post_comment) {
            $post_comment->delete();
        }

        $post_likes = Like::where('item_id', $post->id)->get();
        foreach ($post_likes as $post_like) {
            $post_like->delete();
        }
        DB::table('post_tag')->where('post_id', $post->id)->delete();
        $post->delete();
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(Post::class, function (Form $form) {

            $imgpath = asset('assets').'/img/post/';
            /** ===== массив типов постов ========= */
            $posttypes = PostType::all();
            $types = $this->p_rep->getArrayIdFieldFromCollection($posttypes, 'name');
            /** ===== массив пользователей ========= */ 
            $allusers = User::all();
            $users = $this->p_rep->getArrayIdFieldFromCollection($allusers, 'name');
            /** ===== массив тегов ========= */ 
            $form->display('id', 'ID');
            $form->select('user_id','Автор')->options($users)->default(1);
            $form->select('posttype_id', 'Тип отображения на гл.стр.')->options($types)->default(3);
            $form->text('title','Заголовок')->rules('required|max:255');
            $form->image('img','Изображение')->fit(720,466)->default( asset('assets') . '/img/post/images/no_image.png'  )->removable();
            $form->multipleImage('img_slide','Галерея')->fit(720,466)->removable();
            $form->ckeditor('desc', 'Описание (преамбула)');
            $form->ckeditor('body', 'Основной текст');
            // $form->text('alias','Slug')->value('p_' . date('YmdHi') )->rules('max:250');
            $form->text('alias','Slug')->rules('max:250');
            // $form->display('alias','Slug');

            // $form->multipleSelect('tags', 'Теги')->options($tags);
            $form->multipleSelect('tags', 'Теги')->options(Tag::all()->pluck('name','id'));
            $form->text('keywords');
            $form->text('meta_desc');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            // $form->tags('tags');

            // $form->tools(function(Form\Tools $tools) {
            //     $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            // });

        });
    }


}
