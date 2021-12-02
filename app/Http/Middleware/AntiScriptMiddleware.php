<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AntiScriptMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $harmful_words = [
            'script',
            '<script>',
            '</script>',
        ];

        $catch = false;
        foreach ($request->all() as $key => $req) {
            foreach ($harmful_words as $i => $harm) {
                if(!is_array($req)){
                    if(str_contains(
                        strtolower($req),
                        $harm
                    )){
                        $catch = true;
                        return redirect()
                                ->back()
                                ->withInput()
                                ->withErrors([
                                    $key => 'Isian Terdeteksi Percobaan Injeksi'
                                ])
                                ->withError("Percobaan Injeksi Ditemukan, silahkan periksa isian !");
    
                        break;
                    }
                }
            }
        }
        return $next($request);
    }
}
