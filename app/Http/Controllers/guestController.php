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
class guestController extends Controller
{

  public function mcqInstruction(){
    Log::debug( __METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] ' );
    try {
      $curl['data'] = file_get_contents(\Config::get('constants.MCQ_TEST_QA_URL'));
      $curl_decode = json_decode($curl['data'],true);
      $correct_answer = array_values(array_unique(array_column($curl_decode['results'],'correct_answer')));
      Session::put('answers', $correct_answer);
      return view('mcq-test')->with('data',$curl_decode['results']);
    }catch(Exception $e){
      Log::error(__METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] '.' with error '.$e->message().' at line '.__LINE__);
    }
  }

  public function submitQuiz(Request $Request){
    Log::debug( __METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] ' );
    try {
      $input=$Request->all();
      $answers = Session::get('answers');
      $result=array_intersect($input,$answers);
      $id = Auth::user()->id;
      $score = count($result);
      $user = User::where('id','=',$id)->update(['score' => $score,'updated_at' => date('Y-m-d H:i:s')]);
      $msg = 'Your score is '.$score;
      return redirect()->back()->with('msg',$msg);
    }catch(Exception $e){
      Log::error(__METHOD__ .' Entered in ' .' ['. __FUNCTION__ .'] '.' with error '.$e->message().' at line '.__LINE__);
      return $e;
    }
  }
}
