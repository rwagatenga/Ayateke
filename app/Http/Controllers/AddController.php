<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PersTap;
use App\PrivTap;
use App\PubTap;
use App\Report;
use App\Rolove;
<<<<<<< HEAD

use Carbon\Carbon;
=======
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
use Auth;
use DB;
use Validator;

class AddController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPubTap()
    {
    	return view('pages.AddPubTap');
    }

    public function postPubTap(Request $request)
    {
    	$rules = [
    		'fname' => 'required|min:3|max:255',
    		'notap' => 'required',
    		'nid' => 'required|digits:16|numeric',
    		'tel' => 'required|digits:12|numeric',
    		'sector' => 'required',
    		'cell' => 'required',
    		'village' => 'required',
    		'wmeter' => 'required',
    	];

    	$validate = \Validator::make($request->all(), $rules);
    	if ($validate->fails()) {
    		return redirect()->back()->withErrors($validate->errors())->withInputs();
    	}

    	 else {
    		$PubTap = new PubTap();
    		$PubTap->full_names=$request->input('fname');
    		$PubTap->no_of_tap=$request->input('notap');
    		$PubTap->nid=$request->input('nid');
    		$PubTap->tel=$request->input('tel');
    		$PubTap->sector=$request->input('sector');
    		$PubTap->cell=$request->input('cell');
    		$PubTap->village=$request->input('village');
    		$PubTap->water_meter=$request->input('wmeter');
    		$PubTap->category='Public';
    		// $PubTap->save();

    		// $report = new Report();
    		// $report->water_meter=$request->input('wmeter');
    		// $report->category='Public';
    		// $report->save();

    		$rolove = new Rolove();
    		$rolove->full_names=$request->input('fname');
            $rolove->tel=$request->input('tel');
    		$rolove->water_meter=$request->input('wmeter');
    		$rolove->category='Public';

    		if($PubTap->save() && $rolove->save()){
    			return redirect()->back()->with('status', 'Successfully Added');
    		}
    		else {
    			return redirect()->back()->with('errors', 'Something went Wrong');
    		}
    	}

    }

    public function getPrivTap()
    {
    	return view('pages.AddPrivTap');
    }

    public function postPrivTap(Request $request)
    {
    	$rules = [
    		'compname' => 'required',
    		'fname' => 'required|min:3|max:255',
    		'tel' => 'required|digits:12|numeric',
    		'sector' => 'required',
    		'cell' => 'required',
    		'village' => 'required',
    		'wmeter' => 'required',
    	];

    	$validate = \Validator::make($request->all(), $rules);
    	if ($validate->fails()) {
    		return redirect()->back()->withErrors($validate->errors())->withInputs();
    	}

    	 else {
    		$PrivTap = new PrivTap();
    		$PrivTap->comp_name=$request->input('compname');
    		$PrivTap->full_names=$request->input('fname'); 
    		$PrivTap->tel=$request->input('tel');
    		$PrivTap->sector=$request->input('sector');
    		$PrivTap->cell=$request->input('cell');
    		$PrivTap->village=$request->input('village');
    		$PrivTap->water_meter=$request->input('wmeter');
    		$PrivTap->when=$request->input('when');
    		$PrivTap->category='Private';
    		// $PrivTap->save();

    		// $report = new Report();
    		// $report->water_meter=$request->input('wmeter');
    		// $report->category='Private';
    		// $report->save();

    		$rolove = new Rolove();
    		$rolove->full_names=$request->input('fname');
            $rolove->tel=$request->input('tel');
    		$rolove->water_meter=$request->input('wmeter');
    		$rolove->category='Private';

    		if($PrivTap->save() && $rolove->save()){
    		return redirect()->back()->with('status', 'Successfully Added');
    		}
    		else {
    			return redirect()->back()->with('errors', 'Something went Wrong');
    		}
    	}
    }

    public function getPersTap()
    {
    	return view('pages.AddPersTap');
    }

    public function postPersTap(Request $request)
    {
    	$rules = [
    		 'fname' => 'required|min:3|max:255',
    		'nid' => 'required|digits:16|numeric',
    		'tel' => 'required|digits:12|numeric',
    		'sector' => 'required',
    		'cell' => 'required',
    		'village' => 'required',
    		'wmeter' => 'required',
    	];

    	$validate = \Validator::make($request->all(), $rules);
    	if ($validate->fails()) {
    		return redirect()->back()->withErrors($validate->errors())->withInputs();
    	}

    	else {
    		$wmeter = $request->input('wmeter');
    		$PersTap = new PersTap();
    		$PersTap->full_names=$request->input('fname'); 
    		$PersTap->nid=$request->input('nid');
    		$PersTap->tel=$request->input('tel');
    		$PersTap->sector=$request->input('sector');
    		$PersTap->cell=$request->input('cell');
    		$PersTap->village=$request->input('village');
    		$PersTap->water_meter=$request->input('wmeter');
    		$PersTap->when=$request->input('when');
    		$PersTap->category='Personal';
    		//$PersTap->save();

    		// $report = new Report();
    		// $report->water_meter=$request->input('wmeter');
    		// $report->category='Personal';
    		//$report->save();

    		$rolove = new Rolove();
    		$rolove->full_names=$request->input('fname');
            $rolove->tel=$request->input('tel');
    		$rolove->water_meter=$request->input('wmeter');
    		$rolove->category='Personal';

    		if($PersTap->save() && $rolove->save()){
    			return redirect()->back()->with('status', 'Successfully Added');
    		}
    		else {
    			return redirect()->back()->withInputs()->with('errors', 'Something went Wrong');
    		}
    	}
    }
    public function addFunction($id) {
    	$find = Rolove::findOrFail($id);
<<<<<<< HEAD
        //  Nexmo::message()->send([
        //   'to' => $checks->tel,
        //   'from' => 'AYATEKE',
        //   'text' => 'Hello '.$checks->full_names.' You have '.$checks->wmeter.' and Your Index Number is '.$checks->index.' You have consumed '.$checks->m.' and You will pay '.$checks->amount.'',
        // ]);
    	return $find;
    }
    public function view()
    {
        // $view = Rolove::where('created_at', '>=', Carbon::now()->subWeeks(2))->get();
      $variable = Rolove::where('created_at', '>=', Carbon::toDay()->subDays(21))->get();
      foreach ($variable as $value) {
        return response()->json($value);
      }
    }
=======
         Nexmo::message()->send([
          'to' => $checks->tel,
          'from' => 'AYATEKE',
          'text' => 'Hello '.$checks->full_names.' You have '.$checks->wmeter.' and Your Index Number is '.$checks->index.' You have consumed '.$checks->m.' and You will pay '.$checks->amount.'',
        ]);
    	return $find;
    }
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
}
