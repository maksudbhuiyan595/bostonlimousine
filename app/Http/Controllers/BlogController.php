<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function blogDetails($slug) {
        $blog = BlogPost::where('slug', $slug)->firstOrFail();
        return view('layout.page.blog_details', compact('blog'));
    }
}
