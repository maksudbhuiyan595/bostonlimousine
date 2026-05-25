<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
     public function serviceDetails($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    $settings = app(GeneralSettings::class);
    return view('layout.page.service_details', compact('page','settings'));
}
}
