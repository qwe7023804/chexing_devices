<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Models\Tools\User;


// 注意，我们要继承的是 jwt 的 BaseMiddleware
class ToolsRefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     */
    public function handle($request, Closure $next)
    {
        // 检查此次请求中是否带有 token，如果没有则抛出异常。
        //$authToken = Auth::guard('sp110')->getToken();
        $authToken = auth('tools')->getToken();
        if (!$authToken) {
            return response()->json(['code' => 401, 'msg' => '未登录']);
        }

        // 检测用户的登录状态，如果正常则通过
        if (auth('tools')->check()) {
            $admin_id = Auth::guard('tools')->payload()['sub'];
            $time = auth('tools')->payload()['exp'];

            //刷新Token
            if (($time - time()) < 10 * 60 && ($time - time()) > 0) {
                $token = auth('tools')->refresh();
                if ($token) {
                    $request->headers->set('Authorization', 'Bearer ' . $token);
                } else {
                    return response()->json(['code' => 401, 'msg' => '登录失效']);
                }

                // 在响应头中返回新的 token
                $respone = $next($request);
                if (isset($token) && $token) {
                    $respone->headers->set('Authorization', 'Bearer ' . $token);
                }
                return $respone;
            }

            //token通过验证 执行下一补操作
            return $next($request);
        }
        return response()->json(['code' => 401, 'msg' => '登录失效，请重新登录']);
    }
}