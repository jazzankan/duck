<?php

namespace App\Http\Controllers;

use App\Memory;
use App\Tag;
use Illuminate\Http\Request;
use App\Memfile;
use DB;
use App\Traits\DeleteTagTrait;
use Carbon\Carbon;

class MemoryController extends Controller
{
    use DeleteTagTrait;

    public function __construct(){

        $this->middleware('auth');  //->only(['store','update']) eller ->except....
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchterm = $request['search'];
        $userid = auth()->id();
        $tags = Tag::where('user_id',$userid)->orderBy('name')->get();
        if($request['importance'] === null){
            $request['importance'] = '%';
        }
        if($request['tag'] === ""){
            $request['tag'] = '%';
        }
        if(empty($_POST)) {
            $memories = DB::table('memories')->where('user_id', $userid)->orderBy('updated_at', 'desc')->paginate(10);
        }
        else{
            //dd($request['importance']);
            request()->validate([
                'search' => 'max:20'
            ]);
            $memories = Memory::
                where(function ($q) use ($searchterm) {
                $q->whereHas('tags', function ($query) use ($searchterm) {
                    $query->where('name', 'LIKE', '%'.$searchterm.'%');
                    })
                ->orWhere('memories.title', 'LIKE', '%'.$searchterm.'%')
                ->orWhere('memories.description', 'LIKE', '%'.$searchterm.'%');
            })
                ->where(function ($q) use ($request) {
                    $q->where('memories.importance', 'LIKE', $request['importance']);
                })
                ->where(function ($q) use ($searchterm,$request) {
                    $q->whereHas('tags', function ($query) use ($request) {
                        $query->where('tags.id', 'LIKE', $request['tag']);
                        });
                })
                ->where(function ($q) use ($request,$userid) {
                    $q->where('user_id', $userid);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }

        return view('memories.list')->with('memories',$memories)->with('searchterm',$searchterm)->with('tags',$tags);
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
            'user_id' => 'required',
        ]);

        $memory = Memory::create($attributes);

        if($request['tags'] !== null) {
            $tags = $request['tags'];
                foreach ($tags as $tag){
                    $memory->tags()->attach($tag);
                }
        }
        if($request['newtag1'] !== null) {
            $newtag1 = $request['newtag1'];
            $userid = auth()->id();
            $newtag1id = DB::table('tags')->insertGetId(
                ['name' => $newtag1, 'user_id' => $userid,'created_at' => Carbon::now(),'updated_at' => Carbon::now(),]
            );
            $memory->tags()->attach($newtag1id);
        }
        if($request['newtag2'] !== null) {
            $newtag2 = $request['newtag2'];
            $userid = auth()->id();
            $newtag2id = DB::table('tags')->insertGetId(
                ['name' => $newtag2, 'user_id' => $userid,'created_at' => Carbon::now(),'updated_at' => Carbon::now(),]
            );
            $memory->tags()->attach($newtag2id);
        }


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
        $tags = $memory->tags()->orderBy('name')->get();
        $belongingfiles = Memfile::whereIn('memoryid',[$memory->id])->get();
        return view('memories.show')->with('memory',$memory)->with('tags', $tags)->with('belongingfiles', $belongingfiles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function edit(Memory $memory)
    {
        $this->authorize('update',$memory);

        $tags = auth()->user()->tags()->orderBy('name')->get();
        $seltags = $memory->tags()->orderBy('name')->get();
        return view('memories.edit')->with('memory', $memory)->with('tags', $tags)->with('seltags',$seltags);
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
        if($request['delete'] === 'delete'){
            $this->destroy($memory);
            return redirect('/memories');
        }

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
        $selectedtags = $request['tags'];
        if($selectedtags) {
            $integerIDs = array_map('intval', $selectedtags);
            $memory->tags()->sync($integerIDs);
        }
        else{
            $memory->tags()->sync([]);
        }

        if($request['newtag1'] !== null) {
            $newtag1 = $request['newtag1'];
            $userid = auth()->id();
            $newtag1id = DB::table('tags')->insertGetId(
                ['name' => $newtag1, 'user_id' => $userid,'created_at' => Carbon::now(),'updated_at' => Carbon::now(),]
            );
            $memory->tags()->attach($newtag1id);
        }
        if($request['newtag2'] !== null) {
            $newtag2 = $request['newtag2'];
            $userid = auth()->id();
            $newtag2id = DB::table('tags')->insertGetId(
                ['name' => $newtag2, 'user_id' => $userid,'created_at' => Carbon::now(),'updated_at' => Carbon::now(),]
            );
            $memory->tags()->attach($newtag2id);
        }

        $this->deleteUnusedTags();  //Metod i Traits

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
        $memory->tags()->detach();
        $this->deleteUnusedTags();
        $memory->delete();
    }
}
