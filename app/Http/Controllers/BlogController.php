<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::where('published','yes')->orderByDesc('updated_at')->paginate(6);
        $categories = Category::all();

        $articles->each(function($article, $key) {
            $category = Category::where('id',$article->category_id)->first();
            $article['catname'] = $category['name'];
        });

        return view('blog')->with('articles',$articles);
    }
}
