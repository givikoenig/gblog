<?php

namespace App\Admin\Controllers;

use App\User;
use App\Repositories\PblRepository;
use App\Repositories\WidgetRepository;
use DB;
use App\Admin\Extensions\DeleteUser;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use risul\LaravelLikeComment\Models\Comment;
use risul\LaravelLikeComment\Models\Like;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ModelForm;

    protected $p_rep;
    protected $w_rep;

    public function __construct(PblRepository $p_rep, WidgetRepository $w_rep) {

        $this->p_rep = $p_rep;
        $this->w_rep = $w_rep;

    }

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Пользователи');
            $content->description('список');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $user = User::findOrFail($id);

            $content->header('Пользователь ' . $user->name);
            $content->description('РЕДАКТИРОВАНИЕ');

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

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }


    protected function remove(Request $request) {
        
        $user = User::find($request->get('id'));

        $user_comments = Comment::where('user_id', $user->id)->get();
        foreach ($user_comments as $user_comment) {
            $user_comment->delete();
        }

        $user_likes = Like::where('user_id', $user->id)->get();
        foreach ($user_likes as $user_like) {
            $user_like->delete();
        }
        $user->delete();

    }



    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        
        // dd($roles);

        return Admin::grid(User::class, function (Grid $grid) {

            
            

            $grid->id('ID')->sortable();

            $grid->column('name', 'Nick')->editable();
            $grid->email()->display(function ($email) {
                return "<a href='mailto:{$email}'>{$email}</a>";
            });
            $grid->avatar("Аватар")->image( asset( 'assets') . '/img/post/', 100 ) ;
            $grid->column('column_not_in_table', 'Комментарии')->display(function(){
                $comments = Comment::where('user_id', $this->id)->count();
                return $comments;
            });
            $grid->column('column_not_in_table', 'Лайки')->display(function(){
                $likes = Like::where('user_id', $this->id)->count();
                return $likes;
            });

            // $grid->roles()->display(function ($roles) {
            //     $roles = array_map(function ($role) {
            //         return "<span class='label label-warning'>{$role['name']}</span>";
            //     }, $roles);
            //     return join('&nbsp;', $roles);
            // });

            $grid->disableCreateButton();

            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->append(new DeleteUser($actions->getKey()));
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $allroles = DB::table('admin_roles')->get();
            $roles = $this->p_rep->getArrayIdFieldFromCollection($allroles, 'name');

            $form->display('id', 'ID');
            $form->text('name','Nick')->rules('required|max:100');
            $form->email('email');
            $form->multipleSelect('roles')->options($roles);
            $form->ignore('password','remember_token');
            // $form->password('password');
            $form->image('avatar', 'Аватар')->removable()->fit( 292, 188 );
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
