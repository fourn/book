<?php

namespace App\Http\Middleware;

use Closure;
use Overtrue\Socialite\User as SocialiteUser;


class SimWxOauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(env('APP_ENV') == 'local'){
            $user = new SocialiteUser([
                'id' => uniqid(),
                'name' => 'NICKNAME',
                'nickname' => 'NICKNAME',
                'avatar' => "http://thirdwx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46",
                'email' => null,
                'original' => [],
                'provider' => 'WeChat',
            ]);

            session(['wechat.oauth_user.default' => $user]);
        }

        return $next($request);
    }
}
