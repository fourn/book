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

            $content->header('二手书统计');

            //显示学校名称
            $schools = DB::table('schools')->pluck('name', 'id');

            $content->row(function (Row $row){
                $row->column(4, function (Column $column){
                    $count = DB::table('users')->count();
                    $infoBox = new InfoBox('会员总数', 'users', 'aqua', '/admin/users', $count);
                    $column->append($infoBox->render());

                });

                $row->column(4, function (Column $column) {
                    $count = DB::table('orders')->count();
                    $infoBox = new InfoBox('订单总数', 'file', 'red', '/admin/orders', $count);
                    $column->append($infoBox->render());
                });

                $row->column(4, function (Column $column) {
                    $count = DB::table('books')->count();
                    $infoBox = new InfoBox('书本总数', 'book', 'yellow', '/admin/books', $count);
                    $column->append($infoBox->render());
                });
            });

            $content->row(function (Row $row) use ($schools) {



                $row->column(4, function (Column $column) use ($schools) {
                    $group = DB::table('users')
                        ->selectRaw(DB::raw('count(*) as count, school_id'))
                        ->groupBy('school_id')
                        ->get();
                    $labels = [];
                    foreach ($group as $k => $v){
                        if($v->school_id){
                            $labels[] = $schools[$v->school_id];
                        }
                    }
                    $data = $group->pluck('count')->toArray();
                    $options = [
                        ''
                    ];
                    $column->append(view('admin.charts.count_by_school',
                        [
                            'id'=>'users',
                            'label'=>'会员数量',
                            'labels'=>json_encode($labels),
                            'data'=>json_encode($data),
                            'options'=>json_encode($options),
                        ]
                        ));
                });


                $row->column(4, function (Column $column) use ($schools) {
                    $group = DB::table('orders')
                        ->selectRaw(DB::raw('count(*) as count, school_id'))
                        ->groupBy('school_id')
                        ->get();
                    $labels = [];
                    foreach ($group as $k => $v){
                        if($v->school_id){
                            $labels[] = $schools[$v->school_id];
                        }
                    }
                    $data = $group->pluck('count')->toArray();
                    $options = [
                        ''
                    ];
                    $column->append(view('admin.charts.count_by_school',
                        [
                            'id'=>'orders',
                            'label'=>'订单数量',
                            'labels'=>json_encode($labels),
                            'data'=>json_encode($data),
                            'options'=>json_encode($options),
                        ]
                    ));
                });


                $row->column(4, function (Column $column) use ($schools) {
                    $group = DB::table('books')
                        ->selectRaw(DB::raw('count(*) as count, school_id'))
                        ->groupBy('school_id')
                        ->get();
                    $labels = [];
                    foreach ($group as $k => $v){
                        if($v->school_id){
                            $labels[] = $schools[$v->school_id];
                        }
                    }
                    $data = $group->pluck('count')->toArray();
                    $options = [
                        ''
                    ];
                    $column->append(view('admin.charts.count_by_school',
                        [
                            'id'=>'books',
                            'label'=>'书本数量',
                            'labels'=>json_encode($labels),
                            'data'=>json_encode($data),
                            'options'=>json_encode($options),
                        ]
                    ));
                });


            });





        });
    }
}
