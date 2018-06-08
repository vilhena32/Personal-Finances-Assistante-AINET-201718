<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
class DocumentController extends Controller
{
    //


    public function show($id)
    {
    	$doc= Document::find($id);
    	return view('documents.showDocument',compact('doc'));

    }

    public function create()
    {
    	return view('documents.addDocument');
    }

    public function store(Request $request, $id)
    {
    	//return view();
    }


    public function edit($id)
    {
    	return view('documents.editDoc');
    }

    public function delete($id)
    {
    	$mov= Movement::find($id);
    	$mov->document->dissociate();
    	$mov->save();	
    }
}
