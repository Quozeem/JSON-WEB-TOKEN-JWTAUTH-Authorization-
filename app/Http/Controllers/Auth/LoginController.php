<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\SecondToken;
 use DB;
 use Config;
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
      //  $this->middleware('auth:api')->except('logout');
    }
   
    public function secondToken(Request $request)
    {
        $credentials=([
            
          'email'=>$request->email,
          'password'=>$request->password
        ]);
        $token = null;
        // config::set('second',\App\Models\SecondToken::class);
        // Config::set('auth.providers.users.model',
        // SecondToken::class);
     

     try{
     if(!$token = auth('second')->attempt($credentials))
     {
        return response()->json([
            'success' => false,
            'message' => 'ops Email or Password',
        ]);
     }
     return $this->responseWithToken($token);
        }
        catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'status'=>"failed",
                'message' => 'Token creation failed',
            ]);
        }
    }
    public function authenticate(Request $request)
    {
   
        $credentials = 
       ([
          'email'=>$request->email,
          'password'=>$request->password
        ]) ;
           $token = null;
           //if(Hash::check($request->password,$user->password))
      
           try {
      if (!$token = JWTAuth::attempt($credentials)) {
          return response()->json([
              'success' => false,
              'message' => 'Invalid Email or Password',
          ]);
      }
  
      return $this->responseWithToken($token);
           }
           catch (JWTAuthException $e) {
                    return response()->json([
                        'response' => 'error',
                        'status'=>"failed",
                        'message' => 'Token creation failed',
                    ]);
                }
      
     }
     public function get_user()
     {
        // $this->validate($request, [
        //     'token' => 'required'
        // ]);
 
      //  $user = JWTAUTH::authenticate($request->token);
 
      //  return response()->json(auth('second')->user());
    //     {
            try {

                    if (! $user =JWTAUTH::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
    
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
