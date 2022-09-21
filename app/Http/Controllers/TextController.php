<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;
 use DB;
use Auth;
use Hash;
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
   
    public function text(Request $request)
    {
        $credentials=([
            
          'email'=>$request->email,
          'password'=>$request->password
        ]);
   
       if(Auth::guard('admin')->attempt( $credentials,$request->filled('remember'))) {
   
        
     return redirect('me'); 
     }
     
     return response()->json([
      'success' => false,
      'message' => 'opiiis Email or Password',
  ]);  
    }
   
    
    
}
