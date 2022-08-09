<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index(){
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(6);
        return view('welcome',compact('posts'));
    }

    public function show($slug){
        $product = Product::where('slug',$slug)->first();
        return view('product-show',compact('product'));
    }
}
