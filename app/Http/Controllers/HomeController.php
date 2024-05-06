<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title'] = 'Home ';
        $data['meta_keywords'] = 'eCommerce,Products,All Categories,Fshions,Men,Women,Shoes';
        $data['meta_description'] = 'Home Page for ModWir eCommerce Store ';
        return view('home', $data);
    }
    
}
