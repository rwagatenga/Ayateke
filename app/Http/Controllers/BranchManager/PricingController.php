<?php

namespace App\Http\Controllers\BranchManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Technology_name;
class PricingController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Technology_names = Technology_name::latest()->paginate(5);
        return view('admin.pricing.home',compact('Technology_names'))
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
        return view('admin.pricing.create');
       // dd($request->all());

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
          'TechnologyName' => 'required'
        ]);
        Technology_name::create([
          'name' =>$request['TechnologyName']
        ]);
        return redirect()->route('pricing.index')
                        ->with('success','New Technology Add successfully!');
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
        $Technology_name = Technology_name::find($id);
        return view('admin.pricing.detail',compact('Technology_name'));
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
        $Technology_name = Technology_name::find($id);
        return view('admin.pricing.edit',compact('Technology_name'));
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
          'TechnologyName' => 'required'
        ]);
        $Technology_name = Technology_name::find($id);
        $Technology_name->name = $request->get('TechnologyName');
        $Technology_name->save();
        return redirect()->route('pricing.index')
                        ->with('success','New Technology Update successfully!');

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
        $Technology_name = Technology_name::find($id);
        $Technology_name->delete();
        return redirect()->route('pricing.index')
                        ->with('success','Deleted successfully!');
    }
}
