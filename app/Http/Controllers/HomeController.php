<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
       $alumni = DB::table('alumnis')->orderBy('adm', 'asc')->paginate(100);

        return view('home',['alumni' => $alumni]);
    
    }

    public function search(Request $request){
        $search=$request->get('search');
        $alumni=DB::table('alumnis')    -> where('adm','like','%'.$search. '%' )
                                        ->orWhere('idnum', 'like','%'.$search. '%' )
                                        ->orWhere('fullname','like','%' .$search.'%')
                                        ->orWhere('mobile','like','%'.$search.'%')
                                        ->orWhere('course','like','%'.$search.'%')
                                        ->orWhere('dept','like','%'.$search.'%')
                                        ->orWhere('email','like','%'.$search.'%')
                                        ->orderBy('adm', 'asc')
                                        ->paginate(50); 

            return view('home',['alumni' => $alumni]);
    }
}
