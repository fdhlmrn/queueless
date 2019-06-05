<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Food;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $states = State::all();

        return view('search.index');
    }

    // public function ajax()
    // {
    //   $state_id = Input::get('state_id');
    //   $district = District::where('state_id', '=', $state_id)->get();

    //   return \Response::json($district);
    // }

    public function find( Request $request)
    {

        $keyword=Input::get('keyword');
        $lat = $request->latitude;
        $lng = $request->longitude;
        $distance = 5;



        $query = Food::getByDistance($lat, $lng, $distance);
        // dd($query);

        if(empty($query)) {
         $foods = Food::where('saiz_hidangan', '>', '0')->orderBy('created_at', 'asc')->paginate(7);
        // dd($foods);
        // dd($foods)
        return view('home', compact('foods'));
        }

        $ids = [];

        foreach($query as $q)
        {

             array_push($ids, $q->id);
        }
        // dd($ids);
            $foods = Food::whereIn('id', $ids)->where([
            ['nama_makanan', 'LIKE', "%$keyword%"],
            ['saiz_hidangan', '>', "0"],
            ])->paginate(5);
        // $results = \DB::table('foods')->whereIn( 'id', $ids)->orderBy('rating', 'DESC')->paginate(3);     
        // $foods = Food::where([
        //     ['id', '=', $ids],
        //     ['nama_makanan', 'LIKE', "%$keyword%"],
        //     ['saiz_hidangan', '>', "0"],
        //     ])->paginate(5);   



        // dd($foods);


        // $foods = Food::where([
        //     ['nama_makanan', 'LIKE', "%$keyword%"],
        //     ['saiz_hidangan', '>', "0"],
        //     ['location', 'LIKE', "%$location%"],
        //     ])->paginate(5);
        

        // $state=Input::get('state');
        // $district=Input::get('district');

        // if($district == 'null') {
        // $foods = Food::where([
        //     ['nama_makanan', 'LIKE', "%$keyword%"],
        //     ['saiz_hidangan', '>', "0"],
        //     ])->Where('state_id', $state)->orderBy('id')->paginate(5);
        // }

        // else {
        // $foods = Food::where([
        //     ['nama_makanan', 'LIKE', "%$keyword%"],
        //     ['saiz_hidangan', '>', "0"],
        //     ])->Where('state_id', $state)->orWhere('district_id', $district)->orderBy('id')->paginate(5);
        // }

        // dd($foods);
        return view('search.result', compact('foods'));
    }

    public function details()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }           

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
