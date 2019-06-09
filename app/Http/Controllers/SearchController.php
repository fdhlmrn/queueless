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
        return view('search.index');
    }

    public function find( Request $request)
    {
        $keyword=Input::get('keyword');
        $lat = $request->latitude;
        $lng = $request->longitude;
        $distance = 5;

        if (is_null($lat)) {
            $foods = Food::where([
                ['saiz_hidangan', '>', '0'],
                ['nama_makanan', 'LIKE', "%$keyword%"],
            ])->orderBy('created_at', 'asc')->paginate(7);
        } else
        {
            $query = Food::getByDistance($lat, $lng, $distance);

            if(empty($query)) {
                $foods = Food::where('saiz_hidangan', '>', '0')->orderBy('created_at', 'asc')->paginate(7);
                return view('home', compact('foods'));
            }

            $ids = [];
            foreach($query as $q)
            {
                array_push($ids, $q->id);
            }
            $foods = Food::whereIn('id', $ids)->where([
            ['nama_makanan', 'LIKE', "%$keyword%"],
            ['saiz_hidangan', '>', "0"],
            ])->paginate(5);
        }

        return view('search.result', compact('foods'));
    }
}
