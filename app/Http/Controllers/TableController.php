<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\Table;
use DB;
use Hash;
use AmrShawky\LaravelCurrency\Facade\Currency;
use validator;
class TableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
      public function delete($delete_id)
      {
        $deleted_user=new Table;
       return  $deleted_user->delete_user($delete_id);
      }
    public function converter(Request $request)
    {
      //composer
      $from=$request->from; $to=$request->to;
      $amount=$request->amount;
      $converting=Currency::convert()
      ->from($from)
      ->to($to)
      ->amount($amount)
      ->get();
    }
    public function insert(Request $request)
    {
      $store=Table::store($request);
    return $store;
    }
   
    public function fetchtable()
    {
        $fetchall=Table::fetchall();
 return $fetchall;
    }
    public function edittable(Request $request,$user_id)
    {
      $extendTableclass= new Table();
      $edituser=$extendTableclass->edituser($user_id);
        return $edituser;
    }
    public function update(Request $request)
    {
      $extendTableclass= new Table();
      $updateuser=$extendTableclass->updatealluser($request);
        return $updateuser;
     
  }
}
