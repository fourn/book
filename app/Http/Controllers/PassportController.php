<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use SmsManager;
use Validator;


class PassportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except'=>[
            'showRegisterForm', 'showLoginForm', 'register', 'login', 'LoginBySms', 'loginByPassword'
        ]]);

        $this->middleware('guest', ['only'=>[
            'showRegisterForm', 'showLoginForm'
        ]]);
    }

    public function showRegisterForm()
    {

        return view('passport.register_form');
    }

    /**
     * 注册表单提交位置
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|confirm_mobile_not_change',
            'verifyCode' => 'required|verify_code',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(['mobile']);
        }
        $user = User::create([
            'name'=>'手机用户'.substr($request->mobile, -4),
            'mobile'=>$request->mobile,
            'password'=>bcrypt($request->password),
            'last_actived_at'=>date('Y-m-d H:i:s', time()),
        ]);
        Auth::login($user);
        return redirect()->route('index');
    }

    public function showLoginForm(){
        return view('passport.login_form');
    }

    public function login(Request $request){
        if($request->loginType == 'sms'){
            return $this->loginBySms($request);
        }else if($request->loginType == 'password'){
            return $this->loginByPassword($request);
        }else{
            abort(401);
        }
    }

    /**
     * 短信方式登录
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    protected function LoginBySms(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|confirm_mobile_not_change|confirm_rule:check_mobile_exists',
            'verifyCode' => 'required|verify_code',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('mobile', $request->mobile)->first();
        Auth::login($user, true);
        session()->flash('success', '欢迎回来！');
        return redirect()->intended(route('index'));
    }

    /**
     * 密码方式登录
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    protected function loginByPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|zh_mobile',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(Auth::attempt($request->all(['mobile', 'password']),  true)){
            session()->flash('success', '欢迎回来！');
            return redirect()->intended(route('index'));
        }else{
            return redirect()->back()->withErrors('登录失败')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        session()->flash('success', '您已成功退出');
        return redirect()->route('index');
    }

    public function showForgotForm(Request $request){
        if($request->has('autoSend')){
            session()->flash('message', '一条短信已经发送到您的手机');
        }
        return view('passport.forgot');
    }

    public function forgot(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|confirm_mobile_not_change|confirm_rule:check_mobile_exists',
            'verifyCode' => 'required|verify_code',
            'password'=>'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->route('passport.forgot')->withErrors($validator);
        }
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $result = $user->save();
        if($result){
            Auth::logout();
            return redirect()->route('passport.login')->with('success', ' 密码修改成功！请重新登录')->withInput(['loginType'=>'password']);
        }
    }


}
