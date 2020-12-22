<?php

namespace App\Http\Controllers;
use Log;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\User;
use Redirect;
use Session;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{

    public function getLogin(){
      Log::debug( __METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] ' );
      try {
        return view('login');
      }catch(Exception $e){
        Log::error(__METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] '.' with error '.$e->message().' at line '.__LINE__);
      }
    }

    public function postLogin(Request $Request){
    Log::debug( __METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] ' );
    try {
      $input=$Request->all();
      $name = $input['name'];
      if($input['login_flag'] == 'admin'){
        $validatedData = $Request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $password = $input['password'];
        $user =User::where('name', '=', $name)->first();
        if(isset($user) && !empty($user)){
          if(Hash::check($password, $user->password)) {
            \Auth::loginUsingId($user->id, true);
            $fetch_data = User::where('role','guest')->get()->toArray();
            return view('dashboard')->with('data',$fetch_data);
          } else {
            return Redirect::back()->withErrors([ \Config::get('constants.INVALID_PASSWORD')]);
          }
        }else{
          return Redirect::back()->withErrors([\Config::get('constants.CREDENTIAL_MISMATCH')]);
        }
      }else{
        $role = $input['login_flag'];
        $user =User::insert(['name' => $name,'role'=> $role,'created_at' => date('Y-m-d H:i:s')]);
        if($user ==1 ){
          $user =User::where('name', '=', $name)->orderBy('id', 'DESC')->first();
          \Auth::loginUsingId($user->id, true);
          $status = 1;
          $msg =  'Quiz Started.';
      }else{
        $status = 0;
        $msg =  'Unable to start quiz.please try again later...';
      }
      return response()->json([
          'status' => $status,
          'msg' => $msg
        ]);
      }
    }catch(Exception $e){
      Log::error(__METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] '.' with error '.$e->message().' at line '.__LINE__);
    }
  }



  public function logoutAdmin(){
      Log::debug( __METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] ' );
      try {
        Auth::logout();
        return redirect('/');
      }catch(Exception $e){
        Log::error(__METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] '.' with error '.$e->message().' at line '.__LINE__);
      }
    }
}
