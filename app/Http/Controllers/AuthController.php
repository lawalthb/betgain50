<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\UserSignup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ForgotPassword;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (!Auth::attempt(array($fieldType => $request->email, 'password' => $request->password))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 422)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }


        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)->where('user_role', 'user')->first();

        $token = $user->createToken('Token of ' . $user->email)->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login Successful',
            'token' => $token,
            'user' => $user,
            'user_role' => $user->user_role,
        ], 200)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }


    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'username' => 'string|required|unique:users',
            'phone_number' => 'required|unique:users',
        ]);


        //create account
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);
        $lastInsertId = $user->id;
        $bonus = 'real';
        if ($user) {
            Transaction::create([
                'user_id' => $lastInsertId,
                'email' => $request->email,
                'phone' => $request->phone_number,
                'amount' => 300,
                'reference' => 'real' . $lastInsertId,
                'authorization_url' => "",
                'callback_url' => "",
                'money_type' => $bonus,
                'gateway_response' => "Successful",
                'status' => "success"

            ]);
        }

        //Check for pending verification
        $verify =  DB::table('password_resets')->where('email', $request->email);

        if ($verify->exists()) {
            $verify->delete();
        }
        //Generate token
        $token = Str::random(64);
        DB::table('password_resets')
            ->insert(
                [
                    'email' => $request->email,
                    'token' => $token
                ]
            );

        // Send email notification to user
        $user->notify(new UserSignup($token, $request->username));

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User registration successful.',
            ], 201)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'An error occured',
            ], 500)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
    }

    public function get_user_info(string $id)
    {

        if (Auth::user()->id != $id) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }

        $user =  User::where('id', $id)->get();


        // $user = UserResource::collection($user);

        return response()->json([
            'status' => true,
            'message' => 'User retrieved',
            'user' => $user
        ], 200);
    }



    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        //Auth::logout();

        return response()->json([
            'status' => true,
            'message' => 'You have successfully logged out and your token has been deleted.'
        ], 200)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function forget_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        //Generate token
        $token = Str::random(64);

        //Find user
        $user = User::where('email', $request->email)->first();
        //check if request exist
        $verify =  DB::table('password_resets')->where(
            'email',
            $request->email
        );

        if ($verify->exists()) {
            $verify->delete();
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        //Send Email
        Notification::send($user, new ForgotPassword($token));

        return response()->json([
            'message' => 'Your password reset link has been sent',
            'reset_token' => $token
        ], 200);

        //return back()->with('message', 'We have e-mailed your password reset link!');
    }


    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'reset_token' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->reset_token
            ])
            ->first();

        if (!$updatePassword) {
            return response()->json([
                'message' => 'Invalid token!'
            ], 401);
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        // return redirect('/login')->with('message', 'Your password has been changed!');
        return response()->json([
            'message' => 'Your password has been changed!'
        ], 200);
    }


    public function signup_verification(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email'
        ]);

        $select = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token);

        if ($select->get()->isEmpty()) {

            return response()->json([
                'message' => 'Invalid Token!, kindly try again or click resend verification Email'
            ], 401)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }

        $select->delete();

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->email_verified_at = Carbon::now()->getTimestamp();
            $user->save();
        }

        return response()->json([
            'message' => 'Signup verification successful',
            'user' => $user,
            //  'token' => Auth::user()->currentAccessToken()->plainTextToken
        ], 200)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function resend_token(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $verify =  DB::table('password_resets')->where('email', $request->email);

        if ($verify->exists()) {
            $verify->delete();
        }



        //Generate token
        $token = Str::random(64);;
        $password_reset = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' =>  $token,
            'created_at' => Carbon::now()
        ]);

        if ($password_reset) {

            return response()->json([
                'message' => 'New verification Token sent',
            ], 200)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
    }

    public function edit_profile(Request $request)
    {
        //   dd($request);
        $this->validate($request, [
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',
            'phone_number' => 'required',
            'username' => 'required',


        ]);
        if ($request->image) {
            $image_path = $request->file('image')->store('image', 'public');
        }

        $user = User::find($request->user_id);
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        if ($request->image) {
            $user->image = $image_path;
        }
        $user->updated_at = now();
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->to('/?logout=1');
    }
}
