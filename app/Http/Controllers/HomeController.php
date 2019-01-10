<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Auth;

use Session;
use DB;
=======

use App\User;
use App\PersTap;
use App\PrivTap;
use App\PubTap;
use App\Report;
use App\Rolove;

use DB;
use Redirect;
use Auth;
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $roleId = Auth::user()->roleId;
        // $roleId = Auth::user()->roleID;
        $roles = DB::select("SELECT * FROM role WHERE id=?", array($roleId));

        // var_dump($roles, $roleId); return;
        if(count($roles) == 0){
            // Redirect to the error page
            return view("welcome");
        }
        Session::put("role", $roles[0]->name);
        Session::put("userId", Auth::user()->id);
        Session::put("email", Auth::user()->email);
        Session::put("name", Auth::user()->name);

        if(in_array($roleId, [1,5])){
            $branch = DB::select("SELECT    a.id AS branchId,
                                            a.name AS branchName
                                            FROM blanches AS a
                                            INNER JOIN blanche_users AS b
                                            ON a.id = b.blancheId
                                            WHERE b.userId = ?
                                            ", [Auth::user()->id]);
            if(count($branch) == 0){
                // Redirect to the error page
                return view("welcome");
            }
            Session::put("branchId", $branch[0]->branchId);
            Session::put("branchName", $branch[0]->branchName);
        }
        if($roleId == 1){

            return redirect('pricing');
        }
        if($roleId == 2){
            return redirect('managerhome');
        }
        if($roleId == 3){
            return redirect('acchome');
        }
        if($roleId == 4){
            return redirect('dmhome');
        }
        if($roleId == 5){
            return redirect('smhome');
        }
        if($roleId == 6){
            return redirect('hrhome');
        }
        return view('home');
=======
        return view('home');
    }
    public function store(Request $request)
    {
        $coins = new Coin();
        $coins->name=$request->input('name');
        $coins->price=$request->input('price');
        $coins->save();
        return response()->json('Success Added');
    }
    public function report()
    {
        $results = Rolove::all();
        return view('pages.find');//, compact('results'));
    }
    public function reports(Request $request)
    {
        $wmeter = $request->input('wmeter');
        $newIndex = $request->input('indexno');
        $cube = Rolove::where('water_meter', '=', $wmeter)->get();
        $fnames = $cube[0]->full_names;
        $oldIndex = $cube[0]->index;
        $cate = $cube[0]->category;
        $answer = $newIndex - $oldIndex;
        $total = $answer * 625;
        $debts = $oldIndex - $newIndex;
        $debt = $debts * 625;
        $update = Rolove::where('water_meter', '=', $wmeter)->update(array(
            'index' => $newIndex,
            'm' => $answer,
            'amount' => $total,
            'user_id' => Auth::user()->id,
        ));
        //$checks = Rolove::where('water_meter', '=', $wmeter)->get();

        $report = new Report();
        $report->full_names=$fnames;
        $report->water_meter=$wmeter;
        $report->index=$newIndex;
        $report->m=$answer;
        $report->amount=$total;
        $report->paid=0;
        $report->debt=$debt;
        $report->user_id=Auth::user()->id;
        $report->category=$cate;
        if ($update && $report->save()) {
            $checks = Rolove::where('water_meter', '=', $wmeter)->get();
            //$reports = Report::where('water_meter', '=', $wmeter)->get();
            return view('pages.Report', compact('checks', 'reports'))->with('status', 'Successfully Reported');;
        }
        else {
            return redirect()->back()->withInputs();
        }
    }
    public function add(Request $request) {
        $checks = Rolove::where('water_meter', '=', $request->input('wmeter'))->get();
        if (!$checks) {
            return "Invalid Water Meter";
        }
        else {
            return view('pages.AddReport', compact('checks'));
        }
        
    }
    public function adds(Request $request, $id) {
             //$add = Rolove::findOrFail($id);
            // $adds = Rolove::where('water_meter', '=', $add)->get();
            // return $adds;
            return "Hello Word";
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
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
    }
}
