<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo\Laravel\Facade\Nexmo;

//Models
use App\User;
use App\Blach;
use App\BlanchUser;
use App\Cell;
use App\Client;
use App\ClientType;
use App\Debit;
use App\District;
use App\Line;
use App\Orgnanization;
use App\Report;
use App\Role;
use App\Rolover;
use App\Sector;
use App\Technology_name;
use App\TechnologyPrice;
use App\Village;

//Packages
use Validator;
use DB;
use Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
	  private $apiToken;
	  public function __construct()
	  {
	    // Unique Token
	    $this->apiToken = uniqid(base64_encode(str_random(60)));
	  }
	  /*
	  Check if he match with input Data
	  */
	  public function check(Request $request) {
	  	// $token = 'UTg0Y0NENE01OXZEdkFtckNmM0lFdzJJWjdoVUVBZmc3Y25Kc1hNNVJ0Z0liNFdlVlZMZkZPeVl5M0ls5b8d1235e4bd2';

	    $token = $request->header('Authorization');
	     $user = User::where('api_token',$token)->first();
	     $wmeter = $request->water_meter;
	        $checks = Client::where('counterNumber', '=', $request->counterNumber)->first();
	        if (!$checks) {
	            return response()->json(['message' => 'Invalid Water Meter!']);
	        }
	        else {
	        	$count = Rolover::where('cId', '=', $checks->id)->first();
	        	if (!$count) {
	        		return response()->json([
	        			'messege' => 'Empty Data',
	        			'Names' => $checks->firsname,
	        			'Water_Meter' => $checks->counterNumber,
	        			'M3_Consumed' => 0,
	        			'Total_Amount' => 0
	        		]);
	        	}
	        	else {
	        		return response()->json([
	            	'Names' => $checks->firsname,
	            	'Water_Meter' => $checks->counterNumber,
	            	'M3_Consumed' => $count->m3,
	            	'Total_Amount' => -1 * $count->amount
	            ]);
	        	}
	        
	        }
	        
	    }

	  /*
	  Rolove and Make Report
	  */

  	public function reports(Request $request)
    {
     $token = $request->header('Authorization');
     $user = User::where('api_token',$token)->first();
        $wmeter = $request->counterNumber;
        $newIndex = $request->index;
        $cube = Client::where('counterNumber', '=', $wmeter)->first();
        $count = Rolover::where('cId', '=', $cube->id)->first();
        if (!$count) {

        	$cube = Client::where('counterNumber', '=', $wmeter)->first();
        	$count = Rolover::where('cId', '=', $cube->id)->first();
        	$wp = Line::where('id', '=', $cube->lineId)->first();
        	if($cube->clientTypeId == 1)
        	{
        		//Save in Rolove Table
        		$save = new Rolover();
	        	$save->cId=$cube->id;
	        	$save->index=$newIndex;
	        	$save->m3=$newIndex;
	        	$save->amount=-1 * ($newIndex * $wp->public_price);
	        	$save->userId=$user->id;
	        	$save->save();

	        	//Save in Report Table
	        	$report = new Report();
	        	$report->cId=$cube->id;
	        	$report->index=$newIndex;
	        	$report->m3=$newIndex;
	        	$report->amount=-1 * ($newIndex * $wp->public_price);
	        	$report->userId=$user->id;
	        	$report->save();

	        	//Save in Debits Table
	        	$debt = new Debit();
	        	$debt->cId=$cube->id;
	        	$debt->debtAmount=-1 * ($newIndex * $wp->public_price);
	        	$debt->save();

	        	$count = Rolover::where('cId', '=', $cube->id)->first();
	        	//Send an SMS
	        	// Nexmo::message()->send([

		        //   'to' => $cube->tel,
		        //   'from' => 'AYATEKE Star',
		        //   'text' => 'Hello '.$cube->full_names.'! Your Water mettr No: '.$cube->water_meter.' and Your current Index: '.$count->index.', Your consuption: '.$count->m.' M3, and You will pay '.-1 * $count->amount.'on Ayatekestar Account',
		        // ]);
		        return response()->json([
		              'Names' => $cube->firsname,
		              'Water_Meter' => $cube->counterNumber,
		              'M3_Consumed' => $count->m3,
		              'amount' => -1 *$count->amount
		            ]);
        	}
        	else {
        		//Save in Rolove Table
        		$save = new Rolover();
	        	$save->cId=$cube->id;
	        	$save->index=$newIndex;
	        	$save->m3=$newIndex;
	        	$save->amount=-1 * ($newIndex * $wp->line_price);
	        	$save->userId=$user->id;
	        	$save->save();

	        	//Save in Report Table
	        	$report = new Report();
	        	$report->cId=$cube->id;
	        	$report->index=$newIndex;
	        	$report->m3=$newIndex-0;
	        	$report->amount=0 - ($newIndex * $wp->line_price);
	        	$report->userId=$user->id;
	        	$report->save();

	        	//Save in Debits Table
	        	$debt = new Debit();
	        	$debt->cId=$cube->id;
	        	$debt->debtAmount=0 - ($newIndex * $wp->line_price);
	        	$debt->save();

	        	$count = Rolover::where('cId', '=', $cube->id)->first();
	        	//Send an SMS
	        	// Nexmo::message()->send([

		        //   'to' => $cube->phoneNumber1,
		        //   'from' => 'AYATEKE Star',
		        //   'text' => 'Hello '.$cube->firsnames.'! Your Water meter No: '.$cube->counterNumber.' and Your current Index: '.$count->index.', Your consuption: '.$count->m.' M3, and You will pay '.-1 * $count->amount.'on Ayatekestar Account',
		        // ]);
		        return response()->json([
		              'Names' => $cube->firsname,
		              'Water_Meter' => $cube->counterNumber,
		              'M3_Consumed' => $count->m3,
		              'amount' => -1 * $count->amount
		            ]);
        	}
        }
        else 
        {
        	$wp = Line::where('id', '=', $cube->lineId)->first();
        	if ($cube->clientTypeId == 1) {
        		$wmeter = $request->counterNumber;
        		$newIndex = $request->index;
        		$cube = Client::where('counterNumber', '=', $wmeter)->first();

        		$count = Rolover::where('cId', '=', $cube->id)->first();
        		$answer = ($newIndex) - ($count->index);
        		$total = $answer * $wp->public_price;

        		//Update Rolove Table
        		$update = Rolover::where('cId', '=', $cube->id)->update(array(
	            'index' => $request->index,
	            'm3' => $answer,
	            'amount' => -1 * $total,
	            'userId' => $user->id,
	        ));
        		$updated = Rolover::where('cId', '=', $cube->id)->first();
        		//Save in Report Table
	        	$report = new Report();
	        	$report->cId=$cube->id;
	        	$report->index=$newIndex;
	        	$report->m3=$newIndex - $updated->index;
	        	$report->amount= $updated->amount;
	        	$report->userId=$user->id;
	        	$report->save();

	        	//Save in Debits Table
	        	$roloved = Rolover::where('cId', '=', $cube->id)->first();
	        	$last = Debit::where('cId', '=', $roloved->cId)->first();
	        	$debt = Debit::where('cId', '=', $roloved->cId)->update(array(
	        		'debtAmount' => $last->debtAmount + $roloved->amount
	        	));

	        	$count = Rolover::where('cId', '=', $cube->id)->first();
	        	//Send an SMS
	        	// Nexmo::message()->send([

		        //   'to' => $cube->phoneNumber1,
		        //   'from' => 'AYATEKE Star',
		        //   'text' => 'Hello '.$cube->firsname.'! Your Water meter No: '.$cube->counterNumber.' and Your current Index: '.$count->index.', Your consuption: '.$count->m.' M3, and You will pay '.-1 * $count->amount.'on Ayatekestar Account',
		        // ]);
		        return response()->json([
		              'Names' => $cube->firsname,
		              'Water_Meter' => $cube->counterNumber,
		              'M3_Consumed' => $count->m3,
		              'amount' => -1 * $count->amount
		            ]);
	        $checks = Rolover::where('cId', '=', $cube->id)->first();
        	}
        	else
        	{
        		$wmeter = $request->counterNumber;
        		$newIndex = $request->index;
        		$cube = Client::where('counterNumber', '=', $wmeter)->first();

        		$count = Rolover::where('cId', '=', $cube->id)->first();
        		$answer = ($newIndex) - ($count->index);
        		$total = $answer * $wp->line_price;

        		//Update Rolove Table
        		$update = Rolover::where('cId', '=', $cube->id)->update(array(
	            'index' => $request->index,
	            'm3' => $answer,
	            'amount' => -1 * $total,
	            'userId' => $user->id,
	        ));
        		$updated = Rolover::where('cId', '=', $cube->id)->first();
        		//Save in Report Table
	        	$report = new Report();
	        	$report->cId=$cube->id;
	        	$report->index=$newIndex;
	        	$report->m3=$newIndex - $updated->index;
	        	$report->amount=$updated->amount;
	        	$report->userId=$user->id;
	        	$report->save();

	        	//Save in Debits Table
	        	$roloved = Rolover::where('cId', '=', $cube->id)->first();
	        	$last = Debit::where('cId', '=', $roloved->cId)->first();
	        	$debt = Debit::where('cId', '=', $roloved->cId)->update(array(
	        		'debtAmount' => $last->debtAmount + $roloved->amount
	        	));

	        	$count = Rolover::where('cId', '=', $cube->id)->first();
	        	//Send an SMS
	        	// Nexmo::message()->send([

		        //   'to' => $cube->phoneNumber1,
		        //   'from' => 'AYATEKE Star',
		        //   'text' => 'Hello '.$cube->firsname.'! Your Water meter No: '.$cube->counterNumber.' and Your current Index: '.$count->index.', Your consuption: '.$count->m.' M3, and You will pay '.-1 * $count->amount.'on Ayatekestar Account',
		        // ]);
		        return response()->json([
		              'Names' => $cube->firsname,
		              'Water_Meter' => $cube->counterNumber,
		              'M3_Consumed' => $count->m3,
		              'amount' => -1 * $count->amount
		            ]);
	   
        	}
        	
        }

    }

    /*
    Rolovers Report
    */

    public function roloreport(Request $request)
    {

    	$token = $request->header('Authorization');
     	$user = User::where('api_token',$token)->first();
     	$views = DB::table('reports')
            ->join('users', 'reports.userId', '=', 'users.id')
            ->join('clients', 'reports.cId', 'clients.id')
            ->select('users.*', 'reports.*', 'clients.*')
            ->where('reports.userId', '=', $user->id)
            ->where('reports.created_at', '>=', Carbon::now()->subDays(8))
            //->where('reports.cId', '=', 'clients.id')
            ->orderBy('reports.id', 'DESC')
            ->get();
            foreach ($views as $key => $value) {
            	echo json_encode([
            		'Names' => $value->firsname,
            		'cId' => $value->cId
            	]);
            }
    }
}
git status;
git add .
git commit -m "message"
git push 