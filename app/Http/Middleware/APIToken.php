<?php

namespace App\Http\Middleware;

use Closure;

class APIToken
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
//print_r($request->headers->all());
      $token = $request->header('APPKEY');
      // dd($request->header('APPKEY'));
      // print_r($token);die;
      if($token != 'Vy9YJXgBecbbqxjRVaHarcSnJytyhxRqJTkY6xKZRfrdXFy72HPXvFRvfEjy'){
        return response()->json(array(
                                    'status' => 401,
                                    'message'=> 'Error',
                                    'error_message'=>'API token not provided!'
                                ),401);
      }
      return $next($request);
    }
}