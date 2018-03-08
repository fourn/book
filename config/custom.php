<?php
return [
    'user'=>[
        'gender'=>[
            ['id'=>0, 'name'=>'未知'],
            ['id'=>1, 'name'=>'男'],
            ['id'=>2, 'name'=>'女'],
        ]
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


];