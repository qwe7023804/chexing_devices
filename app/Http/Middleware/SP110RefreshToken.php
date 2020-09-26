<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Models\Sp110\User;
use App\Models\Sp110\Permission;
use App\Models\Sp110\Role;


// 注意，我们要继承的是 jwt 的 BaseMiddleware
class SP110RefreshToken extends BaseMiddleware
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
        $authToken = auth('sp110')->getToken();
        if (!$authToken) {
            return response()->json(['code' => 401, 'msg' => '未登录']);
        }

        // 检测用户的登录状态，如果正常则通过
        if (auth('sp110')->check()) {
            $time = auth('sp110')->payload()['exp'];
//            $user_id = auth('sp110')->user()->value('id');
//            $url = $request->url();
//            if(!$this->getPermission()){
//                return response()->json(['code'=>402, 'msg'=>'无此权限']);
//            }
            //刷新Token
            if (($time - time()) < 10 * 60 && ($time - time()) > 0) {
                $token = auth('sp110')->refresh();
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

    // 获取该路由需要哪些权限
    private function getPermission()
    {
        $users_model = new User;
        $roles_model = new Role;
        $userInfo = auth('sp110')->user();
        $userInfo = $users_model->with('roles')->where('id', $userInfo['id'])->first()->toArray(); // 获取该用户的角色
        $action = request()->route()->getActionName(); // 获取路由器和方法
        $actionName = explode('Controllers', $action)[1]; // 获取方法
        $roles = $userInfo['roles'];

        $isPermission = false;

        foreach ($roles as $v) {
            $list = $roles_model->with('hooks')->where('id', $v['id'])->first()->toArray()['hooks'];
            foreach ($list as $vo) {
                // echo $vo['controller_action'].'----------'.$actionName.'<br>';
                if ($vo['controller_action'] == $actionName) {
                    $isPermission = true;
                    break 2;
                }
            }
        }
    }
//
//        return $isPermission;
//
//    }
//        private function getPermission(){
//               $action = request()->path();
////               per_id = Permission::where('')
//        }
}