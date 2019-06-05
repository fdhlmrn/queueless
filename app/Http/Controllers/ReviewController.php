<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\User;  
use App\Profile;  

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $user = User::where('id', Auth::user()->id)->first();
        $profile = Profile::findOrFail($id);
        // dd($profile);
        // dd($user);
        return view ('profile.comment', compact('profile'))->with('user', $user);
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

        $review = new Review;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->user_id = Auth::user()->id;
        $review->profile_id = $request->profile;
        // dd($review);
        $review->save();

        return redirect()->action('ProfilesController@show', $review->profile->id)->withMessage('Comment added');


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
        // $reviews = Review::where('profile_id', $id)->get();
        // $profile = Profile::where('user_id', $id)->first();
        // // dd($reviews);
        // return view ('profile.details', compact('profile'))->with('reviews', $reviews);

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
        $review = Review::findOrFail($id);
        $review->delete();
        return back()->withError('Comment has been deleted');
    }
}
