<?php

namespace App\Http\Controllers;

use App\hospital;
use Illuminate\Http\Request;

class hospitalApiController extends Controller
{
public function hospitalget(){

        return response()->json(['error'=>FALSE,'message'=>'','data'=>hospital::get()],200);
    }

    public function hospitalById($id)
    {
        $hospital = hospital::find($id);
        if (is_null($hospital)){
            return response()->json(['error'=>TRUE,'message'=>"hospital not found",'data'=>null],200);
        }
        return response()->json(['error'=>FALSE,'message'=>'','data'=>$hospital],200);
    }
}