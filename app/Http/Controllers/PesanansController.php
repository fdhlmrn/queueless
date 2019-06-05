<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pesanans = Pesanan::with('state', 'district')->paginate(5);
        // return view('order.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        
        $states = State::all();

        return view('order.create', compact('states'));
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
        $pesanan = new Pesanan;
        $pesanan->nama_makanan = $request->nama_makanan;
        $pesanan->saiz_hidangan = $request->saiz_hidangan;
        $pesanan->harga = $request->harga;
        $pesanan->state_id = $request->state;
        $pesanan->district_id = $request->district;
        $pesanan->user_id = Auth::user()->id;
        // dd($pesanan); 
        $pesanan->save();

        return redirect()->action('OrdersController@index')->withMessage('Order has been added');
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
        $states = State::all();
        $pesanan = Pesanan::findOrFail($id);
        return view('order.edit', compact('pesanan'))->with('states', $states);
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
        $this->validate($request, [
          'nama_makanan' => 'required',
          'saiz_hidangan' => 'required',
          'harga' => 'required',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->nama_makanan = $request->nama_makanan;
        $pesanan->saiz_hidangan = $request->saiz_hidangan;
        $pesanan->harga = $request->harga;
        $pesanan->state_id = $request->state;
        $pesanan->district_id = $request->district;
        $pesanan->save();

        return redirect()->action('OrdersController@index')->withMessage('Your order has been updated');
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
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        return back()->withError('Order has been deleted');
    }
}
