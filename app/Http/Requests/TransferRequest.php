<?php

namespace App\Http\Requests;

class TransferRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'alipay'=>'required',
                    'amount'=>'required|numeric|min:0.01',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'alipay.required'=>'请输入支付宝账号',
            'amount.required'=>'请输入提现金额',
            'amount.numeric'=>'请输入提现金额',
            'amount.min'=>'请输入提现金额',
        ];
    }
}
