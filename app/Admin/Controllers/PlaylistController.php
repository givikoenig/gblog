<?php

namespace App\Admin\Controllers;

use App\Playlist;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PlaylistController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Playlist');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Playlist::findOrFail($id), function (Show $show) {

                $show->id();

                $show->created_at();
                $show->updated_at();
            }));
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
            $content->header('СПИСОК');
            $content->description('HLS-video');

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

            $content->header('Create');
            $content->description('description');

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
        return Admin::grid(Playlist::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->type();
            $grid->src()->editable();
            $grid->descr()->editable();
            $grid->poster("Заставка")->image( asset( 'assets') . '/img/post/', 100 ) ;
            
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Playlist::class, function (Form $form) {
            $form->display('id', 'ID');
            $types = [
                'video/mp4' => 'mp4',
                'application/x-mpegURL' => 'x-mpegURL'
            ];
            $form->select('type', 'Формат видео')->options($types)->default('video/mp4');
            $form->text('src')->rules('required');
            $form->text('descr')->rules('required');
            $form->image('poster','Изображение')->default( asset('assets') . '/img/post/images/no_image.png'  )->removable();
            
        });
    }
}
