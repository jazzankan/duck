<?php

namespace App\Http\Controllers;
use App\File;
use App\Memfile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index(request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file|mimes:docx,xlxs,odt,ods,pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $fileName = request()->fileToUpload->getClientOriginalName();

        $path = $request->fileToUpload->storeAs('files',$fileName);

        if($path){
            $file = new File;
            $file->filename = $fileName;
            $file->projectid = $request->projectid;
            $file->save();
        }
        return redirect('/projects/' . $request->projectid);
    }

    public function memories(request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file|mimes:docx,xlxs,odt,ods,pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $fileName = request()->fileToUpload->getClientOriginalName();

        $path = $request->fileToUpload->storeAs('files',$fileName);

        if($path){
            $file = new Memfile;
            $file->filename = $fileName;
            $file->memoryid = $request->memoryid;
            $file->save();
        }
        return redirect('/memories/'. $request->memoryid);
    }
}


