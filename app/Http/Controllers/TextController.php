<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;
 use DB;
use Auth;
use Hash;
use JWTAuth;
use JWTAuthException;
use Response;
use App\Http\Controllers\Controller;
 use App\Providers\RouteServiceProvider;
 use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
class TextController extends Controller
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
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth:api')->except('logout');
    }
   
    public function text(Request $request)
    {
        $credentials=([
             'email'=>$request->email,
          'password'=>$request->password
        ]);
        $token=null;
           $user=auth('admin')->attempt( $credentials);
       if(!$token =$user) {
        return response()->json([
          'success' => false,
          'message' => 'Invalid Email or Password',
      ]);       
     }
    $user_details=$this->responseWithToken($token);

    return ($user_details);
    }
    public function responseWithToken($token)
    {
      return response()->json([
        'success' => true,
        'user'=>auth('admin')->user(),
        'token'=>$token,
        'token_type' => 'bearer',
        'expires_in' => auth('admin')->factory()->getTTL() * 60
      ]);
    }
   public function verifyUserIdentity(Request $request)
   {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_URL => 'http://adem.io/user_me',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 100,
    CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer {{Api key}}'
          ),
    ));
    
    $response = curl_exec($curl);
    $result=json_decode($response);
    return  $result;
//     $http_response_header=array();
//     $http_response_header=
//     request()->header('Authorization');
//       $user=auth('admin')->user();
//     if( $http_response_header == false)
//    {
//  return "wrong";
//    }
//      return redirect('me');
  }
   public function me(Request $request)
   {
    //$_SERVER['HTTP_AUTHORIZATION']
  	  return view('me',['user'=>$this->user()]);
   }
    public function user()
    {
    return response()->json( 
        ['user'=>auth('admin')->user()
      ]);
    }
    
}
