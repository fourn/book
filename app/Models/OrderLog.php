<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Admin;

class OrderLog extends Model
{
    public $fillable = [''];

    const OPERATOR_USER = 1;
    const OPERATOR_SELLER = 2;
    const OPERATOR_ADMIN = 3;
    const OPERATOR_SYSTEM = 4;

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function getNameAttribute()
    {
        $types = config('custom.order.logs');
        $types = array_pluck($types, 'name', 'id');
        return $types[$this->status];
    }

    public function getOperatorNameAttribute()
    {
        $operators = config('custom.order.operator');
        $operators = array_pluck($operators, 'name', 'id');
        return $operators[$this->operator];
    }

    public function log(Order $order, $operator){
        switch ($operator){
            case self::OPERATOR_USER:$operator_id = $order->user_id;break;
            case self::OPERATOR_SELLER:$operator_id = $order->seller_id;break;
            case self::OPERATOR_ADMIN:$operator_id = Admin::user()->id;break;
            case self::OPERATOR_SYSTEM:$operator_id = 0;break;
        }
        $this->order_id = $order->id;
        $this->order_status = $order->status;
        $this->operator = $operator;
        $this->operator_id = $operator_id;
        $this->save();
        return $this;
    }

}
