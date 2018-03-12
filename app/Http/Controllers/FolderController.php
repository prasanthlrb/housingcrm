<?php

namespace App\Http\Controllers;
use App\folder;
use App\document;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function docs()
    {
       $folder = folder::all();
      $docs = document::all();
    return view('docs/index',compact('folder','docs'));
    }
    public function folder($id)
    {
       $folder = folder::all();
      $docs = document::all();
    return view('docs/index',compact('folder','docs'));
    }
    public function doc_store(Request $request) {
      $document = new document;

         $document->docname = $request->docname;
         $document->docurl = $request->docurl;
         $document->doctype = $request->doctype;

         $document->parent_id = $request->parent;
         $document->remark = $request->remark;
         $document->save();
         return response()->json("Save successfully");
    }
    public function fol_store(Request $request) {
      $folder = new folder;

         $folder->folder_name = $request->folder;
         $folder->parent_id = $request->parent;
         $folder->save();
         return response()->json("Save successfully");
    }
}
