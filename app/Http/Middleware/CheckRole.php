<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|int  $role (ค่าที่ส่งมาจาก web.php เช่น 1 หรือ 2)
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. ตรวจสอบว่าได้ Login หรือยัง
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. ตรวจสอบว่า user_role ในฐานข้อมูล ตรงกับที่ Route กำหนดไว้หรือไม่
        // ใช้ == เพื่อให้รองรับทั้ง string และ int ที่ส่งมาจาก parameter
        if (Auth::user()->user_role == $role) {
            return $next($request);
        }

        // 3. กรณีไม่มีสิทธิ์เข้าถึง (Unauthorized)
        // ถ้าเป็น Inertia App แนะนำให้ส่ง error ผ่าน session หรือ abort 403
        return redirect()->route('dashboard')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้ (Unauthorized Access)');
        
        // หรือจะใช้คำสั่งนี้เพื่อให้แสดงหน้า 403 Forbidden ของ Laravel โดยตรงก็ได้ครับ:
        // abort(403, 'Unauthorized action.');
    }
}