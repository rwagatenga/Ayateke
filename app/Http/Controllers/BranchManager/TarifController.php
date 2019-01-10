<?php

namespace App\Http\Controllers\BranchManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TechnologyPrice;
use App\Technology_name;
class TarifController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $TechnologyPrices = TechnologyPrice::latest()->paginate(5);
        return view('admin.tarif.home',compact('TechnologyPrices'))
                                        ->with('i',(request()->input('page',1) -1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Technology_names = Technology_name::All();
        return view('admin.tarif.create',compact('Technology_names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request ->validate([
            'TechnologyName' => 'required',
            'TechnologyAmount' => 'required',
            'TechnologyDate' => 'required'
          ]);
          TechnologyPrice::create([
            'technologyId' =>$request['TechnologyName'],
            'amount' =>$request['TechnologyAmount'],
            'date' =>$request['TechnologyDate'],
            'Status' =>1,
          ]);
          return redirect()->route('tarif.index')
                          ->with('success','New Tarif Amount set!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Technology_name = TechnologyPrice::find($id);
        return view('admin.tarif.edit',compact('Technology_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request ->validate([
            // 'technologyId' =>$request['TechnologyName'],
            'TechnologyAmount' =>'required'
            // 'date' =>$request['TechnologyDate'],
            // 'Status' =>1,
          ]);
          $Technology_name = TechnologyPrice::find($id);
          $Technology_name->amount = $request->get('TechnologyAmount');
          $Technology_name->save();
          return redirect()->route('tarif.index')
                          ->with('success','New value Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
