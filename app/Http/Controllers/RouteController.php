<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Http\Request;

class RouteController extends Controller
{
     public function index($slug)
    {
        $serviceExists = Page::where('slug', $slug)->exists();

        if ($serviceExists) {
            return app(ServiceController::class)->serviceDetails($slug);
        }
        $blogExists = BlogPost::where('slug', $slug)->exists();

        if ($blogExists) {
            return app(BlogController::class)->blogDetails($slug);
        }
        abort(404);
    }
}
