<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'products' => Product::count(),
            'blogs' => Blog::count(),
            'pages' => Page::count(),
        ]);
    }
}
