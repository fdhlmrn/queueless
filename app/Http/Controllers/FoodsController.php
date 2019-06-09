<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use Illuminate\Support\Facades\Auth;
// use App\State;
use Charts;
use App\Cart;
use App\Company;
use App\Bought;
use App\User;
use App\Order;
use Session;
use Carbon\Carbon;
Use Illuminate\Support\Facades\Input;
Use App\Notifications\EmelBought;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function charts()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $tests = Order::where('user_id', $user->id)->get()->groupBy(function ($date) {
          return Carbon::parse($date->created_at)->format('m');
        });
        $orders = \DB::table('orders')->selectRaw('SUM(totalPrice) as total, MONTH(created_at) as month')->whereUserId(auth()->id())->groupBy('month')->get();

        return view('chart', ['chart' => $chart]);

    }

    public function index()
    {
        $company = Company::where('user_id', Auth::user()->id)->first();
        if ($company == null) {
            return view('jualan.register')->with('alertMsg', 'You need to add company to sell items');
        }
        else{
        $foods = Food::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(7);
        // dd($foods);
        return view('jualan.index', compact('foods'));
        }
    }

    public function registerCompany(Request $request)
    {
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->company_contact = $request->company_contact;
        $company->location = $request->location;
        $company->latitude = $request->latitude;
        $company->longitude = $request->longitude;
        $company->user_id = Auth::user()->id;
        $company->save();

        return redirect()->action('FoodsController@index')->withMessage('Company registered!');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jualan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $food = new Food;
        $food->nama_makanan = $request->nama_makanan;
        $food->saiz_hidangan = $request->saiz_hidangan;
        $food->harga = $request->harga;
        $food->user_id = Auth::user()->id;

        if ($request->hasFile('image')){
          $this->validate($request, [
                'image' => 'required|image'
        ]);
        $image = '/images/foods/food_' . time() . $food->id . '.' . $request->image->getClientOriginalExtension();
          $request->image->move(public_path('images/foods/'), $image);
          $food->image = $image;
        }
        $food->save();

        return redirect()->action('FoodsController@store')->withMessage('Food has been added');
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
        $food = Food::findOrFail($id);
        return view('jualan.edit', compact('food'));
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
        $this->validate($request, [
          'nama_makanan' => 'required',
          'saiz_hidangan' => 'required',
          'harga' => 'required',
        ]);
        $food = Food::findOrFail($id);
        $food->nama_makanan = $request->nama_makanan;
        $food->saiz_hidangan = $request->saiz_hidangan;
        $food->harga = $request->harga;
        if ($request->hasFile('image')){
          $this->validate($request, [
                'image' => 'required|image'
        ]);
        $image = '/images/foods/food_' . time() . $food->id . '.' . $request->image->getClientOriginalExtension();
          $request->image->move(public_path('images/foods/'), $image);
          $food->image = $image;
        }
        $food->save();

        return redirect()->action('FoodsController@index')->withMessage('Your food has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return back()->withError('Post has been deleted');
    }

    public function cart(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
      
        if (!is_null($cart->foods)) {
          foreach ($cart->foods as $key => $value) {
          $makanan = Food::findorFail($id);
          $quantity = $value['qty'];
          if (($key == $id) && ($quantity >= $makanan->saiz_hidangan))
            return redirect()->action('HomeController@index')->withErrors("Number of {$makanan->nama_makanan} is not enough");
          }
        }

        $cart->add($food, $food->id);
        $request->session()->put('cart', $cart);

        return redirect()->action('HomeController@index')->withMessage('Food updated');
    }

    public function carthome(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
      
        if (!is_null($cart->foods)) {
          foreach ($cart->foods as $key => $value) {
          $makanan = Food::findorFail($id);
          $quantity = $value['qty'];
          if ($quantity >= $makanan->saiz_hidangan)
            return redirect()->back()->withErrors("Number of {$makanan->nama_makanan} is not enough");
          }
        }
        $cart->add($food, $food->id);
        $request->session()->put('cart', $cart);

        return redirect()->action('FoodsController@getCart')->withMessage('Food updated');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        if (!Session::has('cart')) {

        return redirect()->route('home')->withErrors('No food to remove');
        }

        $cart->reduceByOne($id);

        if (count($cart->foods) > 0){
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');

        }

        return redirect()->route('product.shoppingCart');
    }

    public function getReduceByOneHome($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        //bila cart kosong tapi nak remove jgk
        if (!Session::has('cart')) {

        return redirect()->route('home')->withErrors('No food to remove');
        }

        $cart->reduceByOne($id);

        if (count($cart->foods) > 0){
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');

        }

        return redirect()->route('home')->withMessage('Food removed');
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->foods) > 0){
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');

        }

        return redirect()->route('product.shoppingCart');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shop.shopping-cart', ['foods' => $cart->foods, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout() {
         if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function generateBarcodeNumber() {
        $number = mt_rand(1000000000, 9999999999); // get random number
        $duplicate = Order::where('order_no', $number)->exists(); // find duplicate
        if (!$duplicate) {
            return $number; //check duplicate
        }
        return generateBarcodeNumber();
    }

    public function postCheckout(Request $request) {
         if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        
        foreach ($oldCart->foods as $id => $cart) {
          $makanan = Food::findorFail($id);
          $quantity = $cart['qty'];

          if ($makanan->saiz_hidangan < $quantity) {
            return redirect()->back()->withErrors('Your food has been purchased');
          }

        }

        // add cart into bought
        $randNumber = $this->generateBarcodeNumber();
        $orderid = "ORDR".$randNumber;
        foreach ($oldCart->foods as $id => $cart) {
            $makanan = Food::findorFail($id);
            $quantity = $cart['qty'];
            $bought = new Bought;
            $bought->seller_id = $cart['food']->user_id;
            $bought->buyer_id =  Auth::user()->id;
            $bought->food_id = $id;
            $bought->order_no = $orderid;
            $bought->quantity = $cart['qty'];
            $bought->totalPrice = $cart['qty'] * $makanan->harga;
            $bought->save();

            //call food to reduce quantity
            $makanan->saiz_hidangan = $makanan->saiz_hidangan-$quantity; 
            $makanan->save();

            $penjual = User::where('id', $bought->seller_id)->first();
            $pembeli = User::where('id', $bought->buyer_id)->first();
            $food = Food::where('id', $bought->food_id)->first();
            $jumlah = $bought->quantity;
            $harga = $bought->totalPrice;

            $penjual->notify(new EmelBought($penjual->name, $pembeli->name, $food->nama_makanan, $jumlah, $harga));

        }
        $cart = new Cart($oldCart);
        $order = new Order();

        $order->cart = serialize($cart);
        $order->totalPrice = $request->input('totalPrice');
        $order->order_no = $orderid;

        Auth::user()->orders()->save($order);

        // clear session
        Session::forget('cart');
        return redirect()->action('HomeController@index')->withMessage('Your food has been purchased');    
    }

}
