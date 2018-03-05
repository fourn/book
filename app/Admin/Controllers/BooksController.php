<?php

namespace App\Admin\Controllers;

use App\Models\Book;

use App\Models\Category;
use App\Models\School;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BooksController extends Controller
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

            $content->header('书本列表');
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

            $content->header('书本编辑');
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

            $content->header('书本添加');
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
        return Admin::grid(Book::class, function (Grid $grid) {
            //不可创建
            $grid->disableCreateButton();
            //不可导出
            $grid->disableExport();

            $grid->id('ID')->sortable();
            $grid->column('sn', 'ISBN');
            $grid->column('name', '书名');
            $grid->column('image', '封面')->image(null, 100, 100);
            $grid->column('original_price', '原价')->display(function ($val) {
                return '￥'.$val;
            });
            $grid->column('price', '售价')->sortable()->display(function ($val){
                return '￥'.$val;
            });
            $grid->column('school.name', '所属学校');
            $grid->column('category.name', '所属分类');
            $grid->column('user.name', '所属用户');

            $grid->column('is_show', '是否上架')->switch(config('admin.states'));
            $grid->column('is_recommend', '是否推荐')->switch(config('admin.states'));

            $book_status = array_pluck(config('custom.book.status'), 'name', 'id');
            $grid->status('书本状态')->select($book_status);

            $grid->created_at('添加时间')->sortable();
//            $grid->updated_at('修改时间');

            $grid->filter(function ($filter) use ($book_status){
                $filter->disableIdFilter();
                $filter->like('name', '书名');
                $filter->equal('school_id', '所属学校')->select(School::all()->pluck('name', 'id')->toArray());
                $filter->equal('category_id', '所属分类')->select( Category::all()->pluck('name', 'id')->toArray());
                $states = array_pluck(config('admin.states'), 'name', 'value');
                $filter->equal('is_show', '是否上架')->radio($states);
                $filter->equal('is_recommend', '是否推荐')->radio($states);
                $filter->equal('status', '书本状态')->select($book_status);
                $filter->between('created_at', '添加时间')->datetime();
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
        return Admin::form(Book::class, function (Form $form) {
            $form->hidden('admin_id')->value( Admin::user()->id);
            $form->display('id', 'ID');
            $form->display('user.name', '所属会员');
            $form->select('school_id', '所属学校')->options(School::all()->pluck('name', 'id')->toArray());
            $form->select('category_id', '所属分类')->options( Category::all()->pluck('name', 'id')->toArray());

            $form->text('sn', 'ISBN');
            $form->text('name', '书名');
            $form->image('image')->removable()->help('只能上传一张图片');
            $form->text('author', '作者');
            $form->text('press', '出版社');
            $form->date('published_at', '出版时间');
            $form->select('used', '新旧程度')->options(config('custom.book.used'));
            $form->currency('original_price', '原价')->symbol('￥');
            $form->currency('price', '售价')->symbol('￥');
            $form->textarea('description', '描述');

            $form->select('status', '书本状态')->options(array_pluck(config('custom.book.status'), 'name', 'id'));
            $form->switch('is_show', '是否上架')->states(config('admin.states'));
            $form->switch('is_recommend', '是否推荐')->states(config('admin.states'))->help('被推荐的书本将展示在首页');

            $form->textarea('admin_note', '管理员备注')->placeholder('可用于反馈驳回原因');

        });
    }
}
