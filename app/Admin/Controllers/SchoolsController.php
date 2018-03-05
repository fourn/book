<?php

namespace App\Admin\Controllers;

use App\Models\School;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SchoolsController extends Controller
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

            $content->header('学校列表');
            $content->description('');

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

            $content->header('编辑学校');
            $content->description('');

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

            $content->header('创建学校');
            $content->description('');

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
        return Admin::grid(School::class, function (Grid $grid) {
            $grid->disableFilter();
            $grid->disableExport();
            $grid->disablePagination();
            $grid->id('ID')->sortable();
            $grid->name('学校名称');
            $grid->depot('取货点');
            $grid->working_time('取货时间');
            $grid->worker('负责人');
            $grid->mobile('联系方式');
            $grid->created_at('创建于');
            $grid->updated_at('修改于');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(School::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '学校名称')->rules('required');
            $form->text('depot', '取货点')->rules('required');
            $form->text('worker', '负责人');
            $form->text('working_time', '取货时间');
            $form->text('mobile', '联系方式');

        });
    }
}
