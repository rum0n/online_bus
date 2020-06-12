<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Bus;
use App\Operator;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_bus = Bus::with('operator')->get();
        $all_operator = Operator::all();
        return view('admin.buses.add-bus',compact('all_bus','all_operator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'bus_type' => 'required',
            'bus_code' => 'required',
            'operator_id' => 'required',
            'total_seats' => 'required',
          
            'created_at' => Carbon::now()
        ]);

        
        Bus::insert([
            'bus_type' => $request-> bus_type,
            'bus_code' => $request-> bus_code,
            'operator_id' => $request-> operator_id,
            'total_seats' => $request-> total_seats,

        ]);

        Toastr::success('Successfully Added !' ,'Bus');
        return back();
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
        echo $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bus::find($id)->delete();
        Toastr::success('Successfully Deleted !' ,'Bus');
        return back();
    }
}
