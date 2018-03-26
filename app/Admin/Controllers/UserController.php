<?php

namespace App\Admin\Controllers;

use App\Models\School;
use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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

            $content->header('会员列表');
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

            $content->header('编辑会员');
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

            $content->header('创建会员');
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
        return Admin::grid(User::class, function (Grid $grid) {
            //不可创建
            $grid->disableCreateButton();
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->column('avatar', '头像')->image(null, 100, 100);
            $grid->column('name', '昵称');
            $gender_config = config('custom.user.gender');
            $grid->column('gender', '性别')->display(function ($gender) use ($gender_config) {
                return $gender_config[$gender]['name'];
            });
            $grid->column('mobile', '手机号码');
            $grid->column('balance','账户余额')->sortable()->display(function ($val) {
                return '￥'.$val;
            });
            $grid->column('school.name', '所属学校');
            $grid->column('last_actived_at', '最后活跃于')->sortable();
            $grid->column('created_at', '注册于')->sortable();

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                $filter->like('mobile', '手机号码');
                $filter->equal('school_id', '所属学校')->select(School::all()->pluck('name', 'id')->toArray());

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
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->display('name', '昵称');
            $form->display('mobile', '手机号码');
            $form->currency('balance', '账户余额')->symbol('￥');
        });
    }
}
