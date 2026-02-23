<?php

namespace App\Http\Controllers;

use App\Mail\PrEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to($data['email'])->send(new PrEmail($data));

        return response()->json(['message' => 'ส่งอีเมลเข้าคิวเรียบร้อยแล้ว!']);
    }
}