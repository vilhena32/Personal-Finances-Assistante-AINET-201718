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

    }

    public function store(Request $request, $id)
    {

    }


    public function edit($id)
    {

    }

    public function delete($id)
    {

    }
}
