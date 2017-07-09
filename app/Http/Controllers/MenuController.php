<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
  
    public function index()
    {
        $items = [
            'home'          => [],
            'about'         => [],
            'contact-us'    => [],
            'login'         => [],
            'register'      => []
        ];
        //return view('layouts.master', compact('items'));
        return view('layouts.app', compact('items'));
    }
}
