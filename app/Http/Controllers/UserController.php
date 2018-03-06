<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $schools = School::all();
        return view('user.index', compact('user', 'schools'));
    }

    public function avatar(){
        $user = Auth::user();
        return view('user.avatar', compact('user'));
    }

    public function updateAvatar(Request $request, ImageUploadHandler $handler){
        if($request->base){
            $user = Auth::user();
            $result = $handler->saveBase($request->base, 'avatars', $user->id);
            if($result){
                $user->update(['avatar'=>$result['path']]);
            }
        }
        return redirect()->route('user.index')->with('success', '头像修改成功！');
    }

    public function name(){
        $user = Auth::user();
        return view('user.name', compact('user'));
    }

    public function updateName(Request $request){
        $this->validate($request, [
            'name'=>'required|between:1,25|unique:users,name,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('user.index')->with('success', '昵称修改成功！');
    }

    public function updateGender(Request $request){
        $this->validate($request, [
            'gender'=>['required', Rule::in([0,1,2])],
        ]);
        $user = Auth::user();
        $user->gender = $request->gender;
        $user->save();
        return ['code'=>1];
    }

    public function updateSchool(Request $request){
        $user = Auth::user();
        $user->school_id = $request->school_id;
        $user->save();
        return ['code'=>1];
    }

}
