<?php

namespace App\Http\Requests;

class BookRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // CREATE ROLES
                    'sn'=>'required',
                    'name'=>'required',
//                    'author'=>'required',
                    'press'=>'required',
                    'published_at'=>'nullable|date_format:Y',
                    'used'=>'integer|min:1',
                    'category_id'=>'integer|min:1',
                    'original_price'=>'required|numeric|min:0.01',
                    'price'=>'required|numeric|min:0.01',
                    'image'=>'required',
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
            // Validation messages
            'sn.required'=>'请输入 ISBM 码',
            'name.required'=>'请输入书名',
            'author.required'=>'请输入作者',
            'press.required'=>'请输入出版社',
            'published_at.required'=>'请输入出版年份',
            'published_at.date_format'=>'出版年份格式不正确',
            'used.min'=>'请选择新旧程度',
            'category_id.min'=>'请选择书本分类',
            'original_price.required'=>'请输入原价',
            'original_price.numeric'=>'原价格式不正确',
            'original_price.min'=>'原价最小为0.01',
            'price.required'=>'请输入售价',
            'price.numeric'=>'售价格式不正确',
            'price.min'=>'售价最小为0.01',
            'image.required'=>'请上传封面图片',
        ];
    }
}
