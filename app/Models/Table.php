<?php

namespace App\Models;
use DB;
use Hash;
use Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $table="users";
    public $timestamps=false;
    protected $fillable=[
            'fname', 'email','password','status',
 'lname',  'address',  'phone', 'rank',
    ];
    public function delete_user($delete_id)
    {
      $delete=DB::table('users')
      ->where('user_id','=',$delete_id)
      ->delete();
     if($delete)
     {
      return response()->json([
        'status'=>200,
        'data'=>"Deleted !"
  ]);
    }
    }
    public static function store($request)
    {
      if($request->all()){
       
        $select=Table::where('email','=',$request->email)->get();
   
        if(empty($request->fname)){
        $data_to_check=(
            ['status'=>"fnameerror",
            'data' =>"Firstname is required"
          ]);
        }
       else if(empty($request->email)){
        $data_to_check=(
            ['status'=>"emailerror",
             'data' =>"Email is required"
          ]);
        }
      
      else if(count($select) >0)
       {
        $data_to_check=array(
               'status'=>"erroMailexit",
               'data'=> 'Email Already Exits'
             );
           } 
          
        else if(empty($request->address)){
          $data_to_check=array(
            'status'=>"addresserror",
             'data' =>"Address is required"
          );
        }
        else{
       $insert_all= $request->all();
      
       $insert_all['password']=Hash::make( $insert_all['password']) ;
       $table=Table::create($insert_all);
       if( $table){
        $data_to_check=array(
          'status'=>200,
           'data' =>"Successfully inserted!"
        );
       }
      }
      return json_encode( $data_to_check);
        }
    }
    public static function fetchall()
    {
        $tablefetch=DB::table('users')
        ->get();
        if(($tablefetch->count()) > 0)
  {     
 $alldata=([   
        'status'=> 200,
            'data'=> $tablefetch
              ,'count' => count($tablefetch)
          ] );
     }
     else{
      $alldata=([
        'error'=> "No Data Available"
        ]);
      }
  $fetch=json_encode($alldata);
   return $fetch;
    }

    public function edituser($user_id)
    {
        $edittable=  DB::table('users')
        ->WHERE('user_id','=',$user_id)
        ->get();
        return response()->json([
          'data'=>$edittable]);
    }
 public function updatealluser($request)
    {
      if($request->user_id)
      {
 $select=Table::where('email','=',$request->email)->get();
    if(count($select) >0)
    {
         return response()->json([
            'status'=>"failed",
            'error'=> 'Email Already Exits'
          ]);
        }
      else
      {
        $update_res=([
          "address"=>$request->address,
          "fname"=>$request->fname,
          "email"=>$request->email,
          "password"=>$request->password,
    ]);
      {
        $update_user=DB::table('users')
        ->where("user_id",'=',$request->user_id)
        ->update( $update_res);
    return response()->json([
            'status'=>200,
            'data'=>"Successfully Updated"]);
    }
        
     }}
     
    }
 /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
      'password',
      'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

/**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  public function user(){
      return $this->belongTo(User::class);
  }

  /**
   * The attributes that should be cast.
   *
   * @var array
   */

}

