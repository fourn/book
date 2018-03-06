<?php
namespace App\Http\ViewComposers;

use App\Models\School;
use Illuminate\View\View;
use Auth;
class SetSchoolComposer{

    public function compose(View $view){
        if(!session()->has('school_id')){
            if(Auth::check()){
                $school_id = Auth::user()->school_id;
                if($school_id){
                    session('school_id', $school_id);
                }
            }
        }
        $schools = School::all();
        $view->with(compact('schools'));
    }
}