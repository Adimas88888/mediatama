<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function jualBeli()
    {
        $videos = Video::all();
        return view('user.home', compact('videos'));
    }

    public function index()
    {
        // if(Auth::id())
        // {
        //     $usertype=Auth()->user()->usertype;

        //     if($usertype=='user')
        //     {
        //         return view('user.home');
        //     }

        //     else if($usertype=='admin')
        //     {
        //         return view('admin.crud');
        //     }
        //     else
        //     {
        //         return redirect()->back();
        //     }

        // }
    }

}
