<?php

namespace App\Http\Controllers;

use App\Models\Product_category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Show homepage
    public function home()
    {
        return view('home', ['categories' => Product_category::get()]);
    }

    // Show about
    public function about()
    {
        return view('about');
    }

    // Show contact
    public function contact()
    {
        return view('contact');
    }
}
