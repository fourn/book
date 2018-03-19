<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('仪表盘');

            $content->row(function (Row $row) {

                $row->column(4, Dashboard::environment());

                $row->column(8, function (Column $column) {
                    $column->row(function (Row $row){
                        $count = DB::table('users')->count();
                        $infoBox = new InfoBox('会员总数', 'users', 'aqua', '/admin/users', $count);
                        $row->column(4, $infoBox->render());
                        $count = DB::table('orders')->count();
                        $infoBox = new InfoBox('订单总数', 'file', 'red', '/admin/orders', $count);
                        $row->column(4, $infoBox->render());
                        $count = DB::table('books')->count();
                        $infoBox = new InfoBox('书本总数', 'book', 'yellow', '/admin/books', $count);
                        $row->column(4, $infoBox->render());
                    });
                    $column->row('');
                    $column->row('');
                });
            });

        });
    }
}
