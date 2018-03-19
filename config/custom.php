<?php
return [
    'user'=>[
        'gender'=>[
            ['id'=>0, 'name'=>'未知'],
            ['id'=>1, 'name'=>'男'],
            ['id'=>2, 'name'=>'女'],
        ],
        'account'=>[
            ['id'=>1, 'name'=>'书本资金入账', 'symbol'=>'+'],
            ['id'=>2, 'name'=>'成功申请提现', 'symbol'=>'-'],
        ],
    ],


    'book'=>[
        'status'=>[
            ['id'=>1, 'name'=>'待审核', 'canEdit'=>true, 'canDelete'=>true, 'canShow'=>false],
            ['id'=>2, 'name'=>'审核通过', 'canEdit'=>true, 'canDelete'=>true, 'canShow'=>true],
            ['id'=>3, 'name'=>'审核不通过', 'canEdit'=>true, 'canDelete'=>true, 'canShow'=>false],
            ['id'=>4, 'name'=>'已售', 'canEdit'=>false, 'canDelete'=>false, 'canShow'=>false],
        ],
        'used'=>['5'=>'5成新','6'=>'6成新','7'=>'7成新','8'=>'8成新','9'=>'9成新','10'=>'全新'],
    ],

    'order'=>[
        'status'=>[
            ['id'=>1, 'name'=>'待付款', 'forUser'=> true, 'forSeller'=>false, 'ico'=>'member01.png',],
            ['id'=>2, 'name'=>'待确认', 'forUser'=> false, 'forSeller'=>true, 'ico'=>'member10.png'],
            ['id'=>3, 'name'=>'待发货', 'forUser'=> false, 'forSeller'=>true, 'ico'=>'member11.png'],
            ['id'=>4, 'name'=>'待取货', 'forUser'=> true, 'forSeller'=>false, 'ico'=>'member02.png'],
            ['id'=>5, 'name'=>'已完成', 'forUser'=> true, 'forSeller'=>true, 'ico'=>'member04.png'],
            ['id'=>6, 'name'=>'已取消', 'forUser'=> true, 'forSeller'=>true, 'ico'=>'member03.png'],
            ['id'=>7, 'name'=>'已失效', 'forUser'=> false, 'forSeller'=>false, 'ico'=>'member01.png'],
        ],
        'forUser'=>[1, 4, 5, 6, 7],
        'forSeller'=>[2, 3, 5, 6, 7],
        'logs'=>[
            ['id'=>1, 'name'=>'买家下单'],
            ['id'=>2, 'name'=>'买家已付款'],
            ['id'=>3, 'name'=>'卖家已确认订单'],
            ['id'=>4, 'name'=>'卖家已将书本送达'],
            ['id'=>5, 'name'=>'买家确认取书（卖家入账）'],
            ['id'=>6, 'name'=>'订单已取消'],
            ['id'=>7, 'name'=>'订单已失效'],
        ],
        'operator'=>[
            ['id'=>1, 'name'=>'买家'],
            ['id'=>2, 'name'=>'卖家'],
            ['id'=>3, 'name'=>'管理员'],
            ['id'=>4, 'name'=>'系统'],
        ],
    ],

    'transfer'=>[
        'status'=>[
            ['id'=>1, 'name'=>'待打款'],
            ['id'=>2, 'name'=>'已打款']
        ],
    ],
];