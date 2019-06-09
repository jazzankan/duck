<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProjectController extends Controller
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
        //$projectlist = Project::all();
        $projectlist = auth()->user()->projects->sortByDesc('must');
        $visibleproj = $projectlist->filter(function ($item){
        return $item->visible === 'y';
    });

        return view('projects.list')->with('visibleproj', $visibleproj);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['visible'] = 'y';
        $request['deadline'] = $request['date'];

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'description' => 'required | min:5',
            'deadline' => 'nullable|date',
            'must' => 'required',
            'visible' => 'required'



        ]);
        //$attributes['user_id'] = auth()->id();

        $project = Project::create($attributes);

        $user_id = auth()->id();

        $project->users()->attach($user_id);

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $myname = auth()->user()->name;
        $sharing = User::Shared($myname, $project);

        return view('projects.show')->with('project',$project)->with('sharing',$sharing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
       $this->authorize('update',$project);

        $myname = auth()->user()->name;
        $users = User::all();
        $usernames = array();
        foreach ($users as $u) {
            if($u->name !== $myname) {
                array_push($usernames, $u->name);
                    }
                };
        $sharing = User::Shared($myname, $project);

        return view('projects.edit')->with('project',$project)->with('usernames',$usernames)->with('sharing',$sharing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if($request['delete'] === 'delete'){
            $this->destroy($project);
            return redirect('/projects');
        }

        if($request['visible'] != 'n'){
            $request['visible'] = 'y';
        }
        $request['deadline'] = $request['date'];

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'description' => 'required | min:5',
            'deadline' => 'nullable|date',
            'must' => 'required',
            'visible' => 'required'
        ]);

        $project->update(request(['title','description','deadline','must','visible']));

        return redirect('/projects/' . $project->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('view',$project);
        $project->delete();
    }
}
