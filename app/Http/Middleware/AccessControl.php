<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class AccessControl.
 */
class AccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * 設定 domain address 白名單
         */
        $host = $request->getHost();
        $domains = [
            $host,
            'init.engineer',
            'v5.init.engineer',
            'testing.init.engineer',
        ];

        /**
         * 判斷 request 的 header 中是否包含 'ORIGIN' 資訊
         */
        if (isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];

            /**
             * 如果 origin 帶有 http 或 https，則把它們移除，只保留網域
             */
            $pattern = "";
            if (preg_match('#^http?://#', $origin)) {
                $pattern = preg_replace('#^http?://#', '', $origin);
            }
            if (preg_match('#^https?://#', $origin)) {
                $pattern = preg_replace('#^https?://#', '', $origin);
            }

            if (in_array($pattern, $domains)) {
                /**
                 * 設定 response header 的訊息
                 */
                return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin)
                    ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization')
                    ->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS')
                    ->header('Access-Control-Allow-Credentials', true);
            }
        }

        return $next($request);
    }
}
