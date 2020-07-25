<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hospital;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hospitals = hospital::all();
        return view('hospitals.index',compact('hospitals'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
