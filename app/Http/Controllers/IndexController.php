<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $podcasts = Podcast::all();
        return view('index', compact('podcasts'));
    }
}
