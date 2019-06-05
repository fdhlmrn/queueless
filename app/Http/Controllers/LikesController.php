<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Auth;


class LikesController extends Controller
{
    //
    public function LikesAction(Profile $profile)
    {
      $user = Auth::user();
      $stats = $user->likes()->toggle($profile);
      // dd($stats);

      return back();
    }
}
