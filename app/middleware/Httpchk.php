<?php
declare (strict_types = 1);

namespace app\middleware;

class Httpchk
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        if ($request->param('content')) {
            $request->param('content') = str_replace(PHP_EOL, '', $request->param('content'));
            $request->param('content') = str_replace("`", '', $request->param('content'));
            $request->param('content') = str_replace("'", '', $request->param('content'));
        }
        return $next($request);
 
    }
}
