<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $page = [
            'title' => 'Home',
            'slug' => '/', 
            'body' => ''
        ];

        return view('site.home', [
            'page' => $page
        ]);
    }
}
