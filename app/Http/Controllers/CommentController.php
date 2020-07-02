<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $comments = Comment::where('published', 'no')->where('reviewed', 'no')->orderBy('created_at', 'desc')->get();
        $articles = Article::all();

       $comments->each(function ($item, $key) use ($articles){
            $item['belongart'] = $articles->firstWhere('id',$item->article_id);
        });

        return view('comments.list')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $article = Article::where('id', $request->artid)->first();

        return view('comments.create')->with('article', $article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit')->with('comment',$comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {

        if(!$request['reviewed']){
            $request['reviewed'] = "no";
        }
        if(!$request['published']){
            $request['published'] = "no";
        }
        //dd($request['reviewed']);

        request()->validate([
            'body' => 'required | min:2',
            'published' => 'required | in:yes,no',
            'reviewed' => 'required | in:yes,no'
        ]);

        $comment->update(request(['body','published','reviewed']));

        return redirect('/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
