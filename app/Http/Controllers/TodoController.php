<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Project;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectid)
    {
        $taskProject = Project::where('id', $projectid)->first();

        return view('todos.create')->with('taskProject',$taskProject);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['status'] = 'n';
        $request['deadline'] = $request['date'];

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'details' => 'required | min:5',
            'deadline' => 'nullable|date',
            'status' => 'required',
            'priority' => 'required',
            'assigned' => 'nullable',
            'project_id' => 'required'
        ]);
        Todo::create($attributes);

        return redirect('/projects/' . $request['project_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
