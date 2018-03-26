<?php

namespace App\Admin\Controllers;

use App\Models\Article;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Storage;

class ArticlesController extends Controller
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

            $content->header('文章管理');
//            $content->description('description');

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

            $content->header('文章编辑');
//            $content->description('description');

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

            $content->header('文章添加');
//            $content->description('description');

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
        return Admin::grid(Article::class, function (Grid $grid) {
            $grid->disableExport();

            $grid->id('ID')->sortable();
            $grid->alias('显示位置')->display(function ($val){
                return explode(',', $val);
            })->label();
            $grid->name('名称');
            $grid->title('标题');
            $grid->column('image', '图片')->image(null, 100, 100);
            $grid->column('link', '链接')->editable();
            $grid->is_show('是否显示')->switch(config('admin.states'));
            $grid->views('浏览数量');
            $grid->sort('排序')->sortable()->editable();
            $grid->created_at('添加时间');
            $grid->updated_at('编辑时间');

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', '名称');
                $filter->like('title', '标题');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->tags('alias', '显示位置');
            $form->text('name', '名称');
            $form->text('title', '标题');
            $form->image('image', '图片')->removable()->uniqueName()->move('images/articles')->help('只能上传一张图片');
            $form->editor('content', '内容')->help('如果需要在文章中使用图片，请先将图片上传到媒体管理中');
            $form->text('link', '链接')->default(0)->help('默认跳转到文章详情页，0不跳转');
            $form->switch('is_show', '是否显示')->states(config('admin.states'))->default(1);
            $form->number('sort', '排序')->default(100)->help('越小越靠前');
            $form->display('created_at', '添加时间');
            $form->display('updated_at', '修改时间');

            $form->saved(function (Form $form) {
                $model = $form->model();
                $model->image = Storage::disk(config('admin.upload.disk'))->url($model->image);
                $model->save();
            });

        });
    }
}
