<?php

namespace App\Admin\Controllers;

use App\Models\Transfer;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TransfersController extends Controller
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

            $content->header('提现申请');
//            $content->description('');

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
        return Admin::grid(Transfer::class, function (Grid $grid) {
            $grid->disableCreateButton();
            $grid->disableExport();

            $grid->id('ID')->sortable();
            $grid->column('user.name', '提现用户');
            $grid->column('user.mobile', '手机号码');
            $grid->column('alipay', '支付宝账号');
            $grid->column('amount', '提现金额')->display(function ($val) {
                return '￥'.$val;
            })->badge('primary');
            $grid->created_at('申请时间')->sortable();
            $grid->payed_at('确认打款时间')->sortable();
            $grid->admin_id('操作员 ID');
            $transfer_status = array_pluck(config('custom.transfer.status'), 'name', 'id');
            $grid->status('打款状态')->display(function ($val) use ($transfer_status){
                return $transfer_status[$val];
            });

            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                if($actions->row['status'] == 1){
                    $actions->append('<a href="'.route('transfer_confirm', $actions->row['id']).'" class="btn btn-warning">确认已打款</a>');
                }
            });

            $grid->filter(function ($filter) use ($transfer_status){
                $filter->disableIdFilter();
                $filter->between('created_at', '申请时间')->datetime();
                $filter->equal('status', '打款状态')->select($transfer_status);
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
        return Admin::form(Transfer::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }


    public function confirm(Transfer $transfer){
        $transfer->status = 2;
        $transfer->admin_id = Admin::user()->id;
        $transfer->payed_at = Carbon::now();
        $transfer->save();
        return redirect()->back();
    }
}
