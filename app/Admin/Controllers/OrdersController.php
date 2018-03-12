<?php

namespace App\Admin\Controllers;

use App\Models\Order;

use App\Models\School;
use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrdersController extends Controller
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

            $content->header('订单列表');
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

            $content->header('订单编辑');
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

            $content->header('添加订单');
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
        return Admin::grid(Order::class, function (Grid $grid) {
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
            $grid->model()->orderBy('created_at', 'desc');
            $statuses = array_pluck(config('custom.order.status'), 'name', 'id');

            $grid->id('ID')->sortable();
            $grid->sn('订单号');
            $grid->book_id('书本ID');
            $grid->name('订单名称');
            $grid->column('image', '图片')->image(null, 100, 100);
            $grid->column('user.mobile', '买家');
            $grid->column('seller.mobile', '卖家');
            $grid->column('school.name', '学校');
            $grid->price('订单价')->display(function ($val) {
                return '￥'.$val;
            });
            $grid->payed_amount('支付价')->display(function ($val) {
                return '￥'.$val;
            });
            $grid->out_sn('外部单号');
            $grid->status('订单状态')->select($statuses);
            $grid->created_at('创建时间');
            $grid->payed_at('支付时间');
            $grid->updated_at('最近操作时间');

            $grid->filter(function ($filter) {
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                $filter->like('sn', '订单号');
                $filter->between('created_at', '创建时间')->datetime();
                $filter->between('payed_at', '支付时间')->datetime();
                $filter->equal('user_id', '买家')->select(User::all()->pluck('mobile', 'id')->toArray());
                $filter->equal('seller_id', '卖家')->select(User::all()->pluck('mobile', 'id')->toArray());
                $filter->equal('school_id', '学校')->select(School::all()->pluck('name', 'id')->toArray());
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
        return Admin::form(Order::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
