<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Login;
 use DB;
use JWTAuth;
use JWTAuthException;
use Auth;
use Response;
use App\Http\Controllers\Controller;
 use App\Providers\RouteServiceProvider;
 use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('guest:admin')->except('logout');
    }
    // public function loging(Request $request)
    // {
    //     $token = null;
    //     //$credentials = $request->only('email', 'password');
    //     try {
    //         if (!$token = JWTAuth::attempt( ['email'=>$request, 'password'=>$request])) {
    //             return response()->json([
    //                 'response' => 'error',
    //                 'message' => 'Password or email is invalid',
    //                 //'token'=>$token
    //             ]);
    //         }
    //         return response()->json([
    //                 'success' => true,
    //                 'token' => $token,
    //             ]);
    //     } catch (JWTAuthException $e) {
    //         return response()->json([
    //             'response' => 'error',
    //             'status'=>"failed",
    //             'message' => 'Token creation failed',
    //         ]);
    //     }
    //     return $token;
    // }
    public function loging(Request $request)
    {
   
        $credentials = 
       ([
          'email'=>$request->email,
          'password'=>$request->password
        ]) ;
           $token = null;

      if (!$token = JWTAuth::attempt($credentials)) {
          return response()->json([
              'success' => false,
              'message' => 'Invalid Email or Password',
          ]);
      }

      return $this->responseWithToken($token);
    //   $data_all=([
    //     "email"=>$request->email,
    //      "password"=>$request->password

    //   ]);
    // }
    //   $input =Auth::guard('admin')->validate( 
    //     $request->only('email', 'password'));
    //    $jwt_token = null;
    //    if (!$jwt_token = JWTAuth::attempt($input)) {
    //   {
    //     return response()->json([
         
    //       'status'=> "failed",
    //       'data'=>"Email or Password incorrect"]);
   
    //   }
   
    //     return response()->json([
    //       'status'=>200,
    //       'data'=>$jwt_token
    //     ]);
    
    //    }
     }
     public function get_user(Request $request)
     {
         $this->validate($request, [
             'token' => 'required'
         ]);
  
         $user = JWTAuth::loging($request->token);
  
     return response()->json(['user' => $user]);
     }
     public function responseWithToken($token)
   {
    return response()->json([
        'success' => true,
        'token'=>$token,
        'token_type' => 'bearer',
            'expires_in' => JWTAUTH::factory()->getTTL() * 60
    ]);
   }
}
