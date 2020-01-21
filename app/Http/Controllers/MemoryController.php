<?php

namespace App\Http\Controllers;

use App\Memory;
use App\Tag;
use Illuminate\Http\Request;

class MemoryController extends Controller
{
    public function __construct(){

        $this->middleware('auth');  //->only(['store','update']) eller ->except....
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memories = auth()->user()->memories;
        return view('memories.list')->with('memories',$memories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = auth()->user()->tags;
        return view('memories.create')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = auth()->id();

        $attributes = request()->validate([
            'title' => 'required | min:3',
            'description' => 'nullable | min:5',
            'source' => 'nullable',
            'link' => 'nullable',
            'importance' => 'required',
            'user_id' => 'required'
        ]);

        $memory = Memory::create($attributes);

        return redirect('/memories');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function show(Memory $memory)
    {

        $this->authorize('view', $memory);
        $tags = Tag::whereIn('id', $memory['selshare'])->get();
        return view('memories.show')->with('memory',$memory)->with('tags', $tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function edit(Memory $memory)
    {
        $tags = auth()->user()->tags;
        return view('memories.edit')->with('memory', $memory)->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Memory $memory)
    {
        $request['user_id'] = auth()->id();

        $attributes = request()->validate([
            'title' => 'required | min:3',
            'description' => 'nullable | min:5',
            'source' => 'nullable',
            'link' => 'nullable',
            'importance' => 'required',
            'user_id' => 'required'
        ]);
        $memory->update(request(['title','description','source','link','importance','user_id']));
        return redirect('/memories/' . $memory->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memory $memory)
    {
        //
    }
}
