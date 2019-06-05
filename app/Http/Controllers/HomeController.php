<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use Illuminate\Support\Facades\Auth;



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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $foods = Food::with('state', 'district')->orderBy('created_at', 'desc')->paginate(7);

        $foods = Food::where('saiz_hidangan', '>', '0')->orderBy('created_at', 'asc')->paginate(7);
        // dd($foods);
        // dd($foods)
        return view('home', compact('foods'));


    }

    public function error()
    {
        $foods = Food::all()->where([
           ['saiz_hidangan', '>', '0'],
          ])->orderBy('created_at', 'asc')->paginate(7);

        return view('home', compact('foods'));

    }
}
