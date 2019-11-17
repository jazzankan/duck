<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index(request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file|mimes:docx,xlxs,odt,ods,pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $fileName = request()->fileToUpload->getClientOriginalName();

        $path = $request->fileToUpload->storeAs('upload',$fileName);


        //$path = $request->file('fileToUpload')->store('upload');
        dd($path);

        return view('home');
    }
}


