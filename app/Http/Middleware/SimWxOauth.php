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


        $user = new SocialiteUser([
            'id' => 'oaAal1As4QtDCtCdDkIMz-L_1u08',
            'name' => 'NICKNAME',
            'nickname' => 'NICKNAME',
            'avatar' => "http://thirdwx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46",
            'email' => null,
            'original' => [],
            'provider' => 'WeChat',
        ]);

        session(['wechat.oauth_user.default' => $user]);


        return $next($request);
    }
}
