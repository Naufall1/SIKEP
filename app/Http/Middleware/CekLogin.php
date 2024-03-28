<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Pada middleware CekLogin ini dilakukan penanganan request yang masuk pada sebuah route,
     * kemudian dilakukan pengecekkan role/level berdasarkan parameter yang diberikan pada $role.
     * Ada 3 kondisi yang bisa terjadi:
     *  - Jika request yang masuk belum melakukan login maka akan dialihkan menuju halaman login.
     *  - Jika request yang masuk telah login dan role/level sesuai dengan role yang diatur maka request akan diteruskan.
     *  - Jika request yang masuk telah login tetapi role/level tidak sesuai dengan role yang diatur maka akan diarahkan menuju halaman Home.
     * Contoh penggunaan: Route::get('/home', function () { return 'Home Page';})->middleware('role:admin');
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        foreach ($roles as $role) {
            if (strtoupper(Auth::user()->hasLevel['level_kode']) == strtoupper($role)) {
                return $next($request);
            }
        }
        return redirect()->route('home');
    }
}
