<?php

namespace App\Http\Controllers;

use App\hospital;
use Illuminate\Http\Request;

class hospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = hospital::latest()->paginate(5);
  
        return view('hospitals.index',compact('hospitals'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hospital_name' => 'required',
            'hospital_url' => 'required',
            'photo' => 'required',
        ]);
  
       
        $hospital =  hospital::create($request->all());
        
        $images_names = ['photo'];
        //dd($request->file('photo'));
        
        if ($request->file('photo')){
           
            $image_name = md5($hospital->id."app".$hospital->id . rand(1,1000));
        
            $image_ext = $request->file('photo')->getClientOriginalExtension(); // example: png, jpg ... etc
            
            $image_full_name = $image_name . '.' . $image_ext;
    
            $uploads_folder =  getcwd() .'/images/';
    
            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
             

            $request->file('photo')->move($uploads_folder, $image_name  . '.' . $image_ext);
            

           $hospital->{'photo'} =  $image_full_name;
        
    }

        $hospital->save();
        return redirect()->route('hospitals.index')
                        ->with('success','hospital created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(hospital $hospital)
    {
        return view('hospitals.show',compact('hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(hospital $hospital)
    {
        return view('hospitals.edit',compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hospital $hospital)
    {
        $request->validate([
            'hospital_name' => 'required',
            'hospital_url' => 'required',
        ]);
  
        $hospital->update($request->all());
  
         
        
//dd($request->file('photo'));
            $file = 'photo';
            if ($request->file($file)){
    
                $file_name = md5($hospital->id."store".$hospital->id . rand(1,1000));
                        
                $file_ext = $request->file($file)->getClientOriginalExtension(); // example: png, jpg ... etc
                
                $file_full_name = $file_name . '.' . $file_ext;
        
                $uploads_folder =  getcwd() .'/images/';
        
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                
    
                $request->file($file)->move($uploads_folder, $file_name  . '.' . $file_ext);
                
    
                $hospital[$file] =  $file_full_name;
    
            

        }

        $hospital->save();


        return redirect()->route('hospitals.index')
                        ->with('success','hospital updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(hospital $hospital)
    {
        $hospital->delete();
  
        return redirect()->route('hospitals.index')
                        ->with('success','hospital deleted successfully');
    }
}
