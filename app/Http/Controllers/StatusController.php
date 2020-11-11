<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller{
    public function index(){
        $status = Status::all();
        return view('pages.status.index')->with('states',$status);
    }

    public function addStatus(Request $request){
        $status = Status::create([
            'description' => $request->desc,
            'status_code' => $request->code
        ]);
        
        if (!$status) {
            return response()->json(['result'=>false, 'msg'=>'No se pudo agregar el estado.']);
        } else {
            return response()->json(['result'=>true]);
        }

    }
}
