<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class PostController extends Controller
{
    public function show()
    {
        return view('posts.post');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('posts.top', compact('tags'));
    }
}
