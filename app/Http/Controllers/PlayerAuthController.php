<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\UserSignup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ForgotPassword;
///use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;

class PlayerAuthController extends Controller
{


  public function login(Request $request)
  {
    //dd($request);
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (auth()->guard('player')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])) {
      $user = auth()->guard('player')->user();
      //dd( $user);


      return redirect()->route('player.home')->with('success', 'You are Logged in sucessfully.');
    } else {
      return back()->with('error', 'Whoops! invalid email and password.');
    }
  }

  public function logout(Request $request)
  {
    auth()->guard('admin')->logout();
    Session::flush();
    Session::put('success', 'You are logout sucessfully');
    return redirect(route('adminLogin'));
  }
}
