<?php

namespace App\Admin\Controllers;

use App\About;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AboutController extends Controller
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

            $content->header('Блок "ОБО МНЕ"');
            $content->description('СПИСОК ЗАГОТОВОК');

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

            $content->header('header');
            $content->description('description');

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

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(About::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('Заголовок')->editable();

            $grid->img("Изображение")->image( asset( 'assets') . '/img/post/', 100 );

            $grid->column('text', 'Текст')->display( function($text) {
                return $text;
            });

            $grid->sig('Подпись')->display( function ($sig) {
                return empty($sig) ? '' : $sig;
            })->editable();
            
            $states = [
                'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->active()->switch($states);

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
        return Admin::form(About::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title','Заголовок')->rules('required|max:100');
            $form->image('img','Изображение')->fit(292,188);
            $form->ckeditor('text', 'Текст');
            $form->text('sig')->rules('max:100');
            $form->switch('active')->options([1 => 'Активен', 0 => 'Неактивен'])->default(0);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
