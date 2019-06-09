<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\State;
use App\District;
use App\Review;
use App\Food;
Use App\Profile;
Use App\Bought;
Use App\Order;
use Illuminate\Support\Facades\Auth;


class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowOnline = User::where('id', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $reviews = Review::where('profile_id', Auth::user()->id)->get()->sortByDesc('created_at');
        $profiles = Profile::where('user_id', Auth::user()->id)->get();
        return view ('profile.profile', compact('profiles'))->with('reviews', $reviews)->with('user', $user)->with('usernow', $nowOnline);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reviews = Review::where('profile_id', $id)->orderBy('created_at', 'desc')->paginate(4);
        $profile = Profile::where('user_id', $id)->first();
        $user = User::where('id', $id)->first();
        $nowOnline = User::where('id', Auth::user()->id)->first();

        return view ('profile.details', compact('profile'))->with('reviews', $reviews)->with('user', $user)->with('usernow', $nowOnline);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $profile = Profile::findorFail($id);
        return view('profile.editprofile', compact('profile'))->with('user', $user);
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
        $user = User::findOrFail($id);
        $profile = Profile::where('user_id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $profile->no_phone = $request->no_phone;
        $profile->address = $request->address;
        $profile->location = $request->location;
        $profile->latitude = $request->latitude;
        $profile->longitude = $request->longitude;

        if ($request->hasFile('image')){
          $this->validate($request, [
                'image' => 'required|image'
        ]);
        $image = '/images/user/user_' . time() . $user->id . '.' . $request->image->getClientOriginalExtension();
          $request->image->move(public_path('images/user/'), $image);
          $user->image = $image;
        }

        $user->save();
        $profile->save();

        return redirect()->action('ProfilesController@index')->withMessage('Profile has been successfully updated');
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

    public function getOrder()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('profile.order', compact('orders'));
    }

    public function getBought()
    {
        $boughts = Bought::where('seller_id',  Auth::user()->id)->get()->sortByDesc('created_at');

        return view('jualan.sold', compact('boughts'));
    }

    public function testEmel($id)
    {
        $boughts = Bought::where('seller_id',  Auth::user()->id)->get()->sortByDesc('created_at');
        foreach ($boughts as $bought) {
            $buyer = User::where('id', $bought->buyer_id)->first();
            $food = Food::where('id', $bought->food_id)->first();
        }
      $bought = Bought::findorFail($id);
      dd($bought);
    }
}
