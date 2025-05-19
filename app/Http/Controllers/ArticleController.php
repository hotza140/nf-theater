<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public static function testmail(Request $request)
    {         
        $email = $request->email; // "yuthapichai140@gmail.com" // duriantumjam@gmail.com egachai7765@gmail.com
        Mail::to($email)->send(new TestMail());
    }
}
