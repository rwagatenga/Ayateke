<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo\Laravel\Facade\Nexmo;

<<<<<<< HEAD
//Models
use App\User;
use App\Report;
use App\Rolove;
use App\WaterPipe;
=======
use App\User;
use App\Report;
use App\Rolove;
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e

use Validator;
use DB;
use Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
  private $apiToken;
  public function __construct()
  {
    // Unique Token
    $this->apiToken = uniqid(base64_encode(str_random(60)));
  }
  /**
   * Client Login
   */
  public function postLogin(Request $request)
  {
    // Validations
    $rules = [
      'email'=>'required|email',
<<<<<<< HEAD
      'password'=>'required|min:6'
=======
      'password'=>'required|min:8'
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      // Validation failed
      $message = $validator->messages();
      if ($message) {
      	return response()->json($message);
      }
      else{
      	return response()->json("Wrong");
      }
      
    } else {
      // Fetch User
      $user = User::where('email',$request->email)->first();
      if($user) {
        // Verify the password
        if( password_verify($request->password, $user->password) ) {
          // Update Token
        	$token = 'UTg0Y0NENE01OXZEdkFtckNmM0lFdzJJWjdoVUVBZmc3Y25Kc1hNNVJ0Z0liNFdlVlZMZkZPeVl5M0ls5b8d1235e4bd2';
          $postArray = ['api_token' => $token, ];
          $login = User::where('email',$request->email)->update($postArray);
          
          if($login) {
            return response()->json([//"Welcome" => $user->name,
            						// "user_id" => $user->id,
                        //'access_token' => $user->api_token,
            						'Hello' => ' '.$user->name. ' Welcome To AYATEKE',
                        
            ]);
          }
        } else {
          return response()->json([
            'message' => 'Invalid Password',
          ]);
        }
      } else {
        return response()->json([
          'message' => 'User not found',
        ]);
      }
    }
  }
  /**
   * Register
   */
  public function postRegister(Request $request)
<<<<<<< HEAD
    {
      // Validations
      $rules = [
        'name'     => 'required|min:3',
        'email'    => 'required|unique:users,email',
        'password' => 'required|min:8'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        // Validation failed
        return response()->json([
          'message' => $validator->messages(),
        ]);
      } else {
        $postArray = [
          'name'      => $request->name,
          'email'     => $request->email,
          'password'  => bcrypt($request->password),
          'roleId'  => $request->roleId,
          'api_token' => $this->apiToken
        ];
        // $user = User::GetInsertId($postArray);
        $user = User::insert($postArray);
    
        if($user) {
          return response()->json([
            'name'         => $request->name,
            'email'        => $request->email,
            'access_token' => $this->apiToken,
          ]);
        } else {
          return response()->json([
            'message' => 'Registration failed, please try again.',
          ]);
        }
      }
    }
=======
  {
    // Validations
    $rules = [
      'name'     => 'required|min:3',
      'email'    => 'required|unique:users,email',
      'password' => 'required|min:8'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      // Validation failed
      return response()->json([
        'message' => $validator->messages(),
      ]);
    } else {
      $postArray = [
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => bcrypt($request->password),
        'api_token' => $this->apiToken
      ];
      // $user = User::GetInsertId($postArray);
      $user = User::insert($postArray);
  
      if($user) {
        return response()->json([
          'name'         => $request->name,
          'email'        => $request->email,
          'access_token' => $this->apiToken,
        ]);
      } else {
        return response()->json([
          'message' => 'Registration failed, please try again.',
        ]);
      }
    }
  }
  /**
  	*Rolover
  */
  	public function reports(Request $request)
    {
     $token = $request->header('Authorization');
     $user = User::where('api_token',$token)->first();
        $wmeter = $request->water_meter;
        $newIndex = $request->index;
                 $cube = Rolove::where('water_meter', '=', $wmeter)->first();//->get();
         $answer = ($newIndex) - ($cube->index);
         //return response()->json(['messege' => $answer]);
         $total = $answer * 625;
         //return response()->json(['messege' => $total]);
        $update = Rolove::where('water_meter', '=', $request->water_meter)->update(array(
            'index' => $request->index,
            'm' => $answer,
            'amount' => $total,
            'user_id' => $user->id,
        ));
     //    //return response()->json(['messege' => $update]);
        $checks = Rolove::where('water_meter', '=', $request->water_meter)->first();
     //    $wmeter = $request->water_meter;
     //    $newIndex = $request->index;
         // $answers = ($request->index) - ($cube->index);
         // $amount = $answers * 625;
         // $debt = ($cube->index) - ($request->index);
         // $totals = $debt * 625;
         //return response()->json(['messege' => $totals]);

        $report = new Report();
        $report->full_names=$checks->full_names;
        $report->water_meter=$checks->water_meter;
        $report->index=$checks->index;
        $report->m=$checks->m;
        $report->amount=$checks->amount;
        $report->paid=0;
        $report->debt='-'.$checks->amount.'';
        $report->user_id=$user->id;
        $report->category=$checks->category;
        $report->tel=$checks->tel;
        $report->save();

        // Nexmo::message()->send([
        //   'to' => $checks->tel,
        //   'from' => 'AYATEKE Star',
        //   'text' => 'Hello '.$checks->full_names.'! Your Water mettr No: '.$checks->water_meter.' and Your current Index: '.$checks->index.', Your consuption: '.$checks->m.' M3, and You will pay '.$checks->amount.'on Ayatekestar Account',
        // ]);
        return response()->json([
              'Names' => $checks->full_names,
              'Water_Meter' => $checks->water_meter,
              'M3_Consumed' => $checks->m,
              'amount' => $checks->amount
            ]);
        // $report->full_names=$cube[0]->full_names;
        // $report->water_meter=$request->water_meter;
        // $report->index=$request->index;
        // $report->m=$answer;
        // $report->amount=$total;
        // $report->paid=0;
        // $report->debt='-'.$total.'';
        // $report->user_id=$user->id;
        // $report->category=$cate;
        //return response()->json(['messege' => $request->water_meter]);
        //  if ( $report) {
        // //     //$checks = Rolove::where('water_meter', '=', $wmeter)->get();
        //    return response()->json(['messege' => 'Successful Reported']);
        //  }
        // else {
        //     return redirect()->json(['messege' => 'Something went Wrong']);
        // }
    //}
        // }
        // else {
        // 	return response()->json("messege" => "Login First");
        // }

    }
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e

  /**
   * Logout
   */
   public function postLogout(Request $request)
  {
    $token = $request->header('Authorization');
    $user = User::where('api_token',$token)->first();
    if($user) {
      $postArray = ['api_token' => null, 'remember_token' => $this->apiToken];
      $logout = User::where('id',$user->id)->update($postArray);
      if($logout) {
        return response()->json([
          'message' => ''.$user->name.' Logout',
        ]);
      }
    } else {
    	$postArray = ['api_token' => $this->apiToken];
      return response()->json([
        'message' => 'User not found',
        'access_token' => $this->apiToken,
      ]);
    }
  }
<<<<<<< HEAD
   
=======
   public function add(Request $request) {
    $token = $request->header('Authorization');
     $user = User::where('api_token',$token)->first();
     $wmeter = $request->water_meter;
        $checks = Rolove::where('water_meter', '=', $request->water_meter)->first();//->orwhere('user_id', '=', $user->id)->get();
        if (!$checks) {
            return response()->json(['message' => 'Invalid Water Meter!']);
        }
        else {
            return response()->json([
            	'Names' => $checks->full_names,
            	'Water_Meter' => $checks->water_meter,
            	'M3_Consumed' => $checks->m,
            	'amount' => $checks->amount
            ]);
        }
        
    }
  public function adds(Request $request) {
    // $token = $request->header('Authorization');
    //  $user = User::where('api_token',$token)->first();
    // $checks = Rolove::where('water_meter', '=', $request->water_meter)->first()->where('user_id', '=', $user->id)->first();
    //     if (!$checks) {
    //         return response()->json(['message' => 'Invalid Water Meter!']);
    //     }
    //     else {
    //         return response()->json([
    //           'Names' => $checks->full_names,
    //           'Water_Meter' => $checks->water_meter,
    //           'M3_Consumed' => $checks->m,
    //           'amount' => $checks->amount
    //         ]);
    //       }
    }
    public function view()
    {
      $variable = Rolove::where('created_at', '>=', Carbon::now()->subweeks(1))->get();
      foreach ($variable as $key => $value) {
        return response()->json($value->full_names);
      }
    }
    public function confirm()
    {
        return redirect('/report');
    }
    public function cancel(Request $request, $id)
    {
        $find = Rolove::findOrFail($id);
        $find->id;
        $find->index;
        $checks = Rolove::where('id', '=', $find->id)->get();//->delete();
        Report::where('index', '=', $find->index)->delete();
        return view('pages.AddReport', compact('checks'));
    }
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
}
