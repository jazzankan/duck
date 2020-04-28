<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::where('published','yes')->orderByDesc('updated_at')->paginate(6);

        return view('blog')->with('articles',$articles);
    }
}
