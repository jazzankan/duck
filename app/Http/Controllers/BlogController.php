<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $searchterm = $request['search'];
        $requestcid = $request->cid;
        if(empty(['$_POST'])) {
            if (isset($requestcid) && $request->cid != "allcat") {
                $articles = Article::where('published', 'yes')->where('category_id',
                    $request->cid)->orderByDesc('updated_at')->paginate(6);
            } else {
                $articles = Article::where('published', 'yes')->orderByDesc('updated_at')->paginate(6);
            }
        }
        else {
            $articles = Article::
            where('body', 'LIKE', '%'.$searchterm.'%')
                    ->orWhere('heading', 'LIKE', '%'.$searchterm.'%')
                    ->orderByDesc('updated_at')->paginate(6);
        }

        $categories = Category::all();
        $categories->each(function($category, $articles){
            $numcat = Article::where('category_id',$category->id)->where('published', 'yes')->count();
            $category['numcat'] = $numcat;
        });

        $articles->each(function($article, $key) {
            $category = Category::where('id',$article->category_id)->first();
            $article['catname'] = $category['name'];
        });
        $allart = Article::where('published','yes')->count();
        return view('blog')->with('articles',$articles)->with('categories', $categories)->with('requestcid',$requestcid)->with('allart', $allart)->with('searchterm', $searchterm);
    }
}
