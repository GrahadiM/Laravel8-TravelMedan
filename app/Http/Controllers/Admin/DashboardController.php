<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\TravelPackage;

class DashboardController extends Controller
{
    public function index(){
        $travelPackages = TravelPackage::with('galleries')->count();
        $posts = Post::count();
        return view('admin.dashboard.index', compact('travelPackages', 'posts'));
    }
}
