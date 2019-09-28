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
    public function __construct(){

        $this->middleware('auth');  //->only(['store','update']) eller ->except....
    }

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
        $detailstring = $request['details'];

        $request['details'] = str_replace("\r\n", '&#13;', $detailstring);

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'details' => 'nullable | min:5',
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
        $project = Project::where('id', $todo['project_id'])->first();

        return view('todos.edit')->with('todo',$todo)->with('project',$project);
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
        //$this->authorize('update',$todo);

        $projid =  $request['projid'];

        if($request['delete'] === 'delete'){
            $this->destroy($todo);
            return redirect('/projects/' . $projid);
        }

        request()->validate([
            'title' => 'required | min:3',
            'details' => 'nullable | min:5',
            'deadline' => 'nullable|date',
            'status' => 'required',
            'priority' => 'required',
            'assigned' => 'nullable',
        ]);
        $detailstring = $request['details'];
        $request['details'] = str_replace("\r\n", '&#13;', $detailstring);

        $todo->update(request(['title','details','deadline','status','priority','assigned']));
        return redirect('/projects/' . $projid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
    }
}
