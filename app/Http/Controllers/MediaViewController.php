<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;


class MediaViewController extends Controller
{
    
    public function index ():View{

        return view('media');

    }



}
