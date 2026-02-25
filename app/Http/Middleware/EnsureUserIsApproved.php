<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. ตรวจสอบว่า Login หรือยัง
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. ตรวจสอบสถานะการอนุมัติ (is_approved ต้องเป็น true)
        if (Auth::user()->is_approved) {
            return $next($request);
        }

        // 3. หากยังไม่อนุมัติ:
        // ในกรณีใช้ Inertia.js แนะนำให้ส่งไปที่หน้าเฉพาะเพื่อให้ข้อมูลผู้ใช้ทราบสถานะ
        return Inertia::render('Auth/PendingApproval', [
            'status' => 'บัญชีของคุณอยู่ระหว่างรอการอนุมัติจากผู้ดูแลระบบ',
        ]);

        /* หรือถ้าต้องการแบบเรียบง่าย สามารถใช้การ Redirect พร้อม Flash Message:
        Auth::logout(); // อาจจะสั่ง logout ทันที
        return redirect()->route('login')->with('error', 'บัญชีของคุณยังไม่ได้รับการอนุมัติ');
        */
    }
}