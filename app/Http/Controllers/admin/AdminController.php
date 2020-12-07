<?php

namespace App\Http\Controllers\admin;

use App\Models\Blog;
use App\Models\Service;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        $blog_count = Blog::where('delete_status', 1)->get()->count();
        $service_count =  Service::where('delete_status', 1)->get()->count();
        $user_count =  User::get()->count();
        $product_count = Product::where('delete_status', 1)->get()->count();
        return view('admin.home', compact('blog_count', 'service_count', 'user_count', 'product_count'));
    }
}
