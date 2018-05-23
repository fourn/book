<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

class FooterComposer{

    public function compose(View $view){
        $qq = config('service_qq_num');
        $view->with(compact('qq'));
    }
}