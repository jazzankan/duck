<?php

namespace App\Http\Controllers;

use App\Projcomment;
use Illuminate\Http\Request;

class ProjcommentController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('projcomments.create');
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
     * @param  \App\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function show(Projcomment $projcomment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function edit(Projcomment $projcomment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projcomment $projcomment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projcomment $projcomment)
    {
        //
    }
}
