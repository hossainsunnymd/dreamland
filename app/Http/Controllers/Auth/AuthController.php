<?php


namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserSaveRequest;
use App\Http\Requests\UserLoginRequest;


class AuthController extends Controller
{


    //user registration page
    public function userRegistration(UserSaveRequest $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        return redirect()->back()->with(['status'=>true,'message'=>'Registration Successfully']);
    }

    //user login
    public function userLogin(UserLoginRequest $request){

          $user = User::where('email', $request->email)->first();
          if (!$user || !Hash::check($request->password, $user->password)) {
              return redirect()->back()->with(['status'=>false,'message'=>'Invalid email or password']);
          }
          Auth::login($user);
          $token=JWTToken::createToken($user->email);
          if($user->user_type=='admin'){
            return redirect('/admin/dashboard')->cookie('token', $token, 60);
          }else{
            return redirect('/student/dashboard')->cookie('token', $token, 60);
          }
    }

    //user logout
    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->cookie('token', '', -1);
    }

}
