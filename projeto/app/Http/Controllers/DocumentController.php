<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Movement;
use Illuminate\Support\Facades\Validator;
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

    public function store(AddDocumentRequest $request, $id)
    {

        $data = $request->validated();
        $document = new Document();
       
        $mov = Movement::find($id);
        $mov->documents()->save($mov);
        
       
        //redirect

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
