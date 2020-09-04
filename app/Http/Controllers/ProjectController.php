<?php

namespace App\Http\Controllers;

use App\Notifications\NewProject;
use App\Notifications\ChangedProject;
use App\Project;
use App\User;
use App\Todo;
use App\File;
use App\Projcomment;
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
        $today = date('Y-m-d');
        $late = false;
        $projectlist = auth()->user()->projects->sortByDesc('must');
        $visibleproj = $projectlist->filter(function ($item){
        return $item->visible === 'y';
    });
        $visibleproj->each(function ($item, $key) {
            $this->late = false;
            $belongingtodo = Todo::whereIn('project_id',[$item->id])->get();
               if($belongingtodo){
                   $belongingtodo->each(function ($todoitem, $key){
                    if($todoitem['deadline'] < date('Y-m-d') && $todoitem['deadline'] != null && $todoitem['status'] != 'd' ) {
                       $this->late = true;
                            }
                        });
                    }
               if($this->late){
                   $item['late'] = 'y';
               }
        });

        return view('projects.list')->with('visibleproj', $visibleproj)->with('today', $today);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $myname = auth()->user()->name;
        $users = User::all();
        $usernames = array();
        foreach ($users as $u) {
            if($u->name !== $myname) {
                array_push($usernames, $u->name);
            }
        };

        return view ('projects.create')->with('usernames',$usernames);
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
        $getSharingUsers = null;

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

        if($request['selshare'] !== null) {
            $getSharingUsers = User::whereIn('name', $request['selshare'])->get();

            //Avstår tills vidare från funktion för att återta delning.

            foreach ($getSharingUsers as $g) {
                if (!$g->projects->contains($project->id)) {
                    $g->projects()->attach($project->id);
                }
                if($g->id !== $user_id){
                    $g->notify(new NewProject());
                }
            }
        }
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
        $today = date('Y-m-d');
        $myname = auth()->user()->name;
        $sharing = User::Shared($myname, $project);
        $belongingfiles = File::whereIn('projectid',[$project->id])->get();
        $belongingtodos = Todo::whereIn('project_id', [$project->id])->orderBy('deadline', 'ASC')->get();

        $detlink = false;

        $belongingtodos->each(function ($todo, $key) {
            if ($todo['assigned']) {
            $todo['assigned'] = " Utförs av: " . $todo['assigned'];
            }
            else {
                $todo['assigned'] = "";
            }
            if(!$todo['deadline']) {
                $todo['deadline'] = "Ingen satt";
            }
            if($todo['priority'] == "l") {
                $todo['priority'] = "Prio: Låg ";
            }
            if($todo['priority'] == "m") {
                $todo['priority'] = "";
            }
            if($todo['priority'] == "h") {
                $todo['priority'] = "Prio: Hög ";
            }
            $todo['details'] = str_replace("'","\\'",$todo['details']); //Annars blank sida om ' förekommer
        });
        $projcomments = Projcomment::where('project_id', $project->id)->orderBy('id', 'DESC')->get();
        //dd($projcomments->user->name);

        return view('projects.show')->with('project',$project)->with('sharing',$sharing)->with('belongingtodos',$belongingtodos)->with('belongingfiles',$belongingfiles)->with('projcomments',$projcomments)->with('today',$today);
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

        $allUsers = User::all();
        $me = auth()->user();
        $user_id = auth()->id();

        $project->update(request(['title','description','deadline','must','visible']));

        if($request['selshare']) {
            $getSharingUsers = User::whereIn('name', $request['selshare'])->get();

            //Avstår tills vidare från funktion för att återta delning.
            foreach ($getSharingUsers as $g) {
                if (!$g->projects->contains($project->id)) {
                    $g->projects()->attach($project->id);
                }
                if($request['sendmail']) {
                    if ($g->id !== $user_id) {
                        $g->notify(new ChangedProject());
                    }
                }
            }
        }

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

        $allUsers = User::all();

        foreach($allUsers as $a) {
            $a->projects()->detach($project);
        }

        $project->delete();
    }
}
