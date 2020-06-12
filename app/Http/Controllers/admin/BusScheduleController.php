<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\BusSchedule;
use App\Bus;
use App\Operator;
use DB;


class BusScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $countries = DB::table("countries")->pluck("name","id");
//        return view('index',compact('countries'));

        $bus_schedules = BusSchedule::all();
        $all_operators = DB::table("operators")->pluck("operator_name","id");

        return view('admin.time_schedule.add-time',compact('bus_schedules','all_operators'));
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
//        dd($request->all());
        
        $this->validate($request,[
            'operator_id' => 'required',
            'bus_id' => 'required',
            'time_schedule' => 'required',
            'from' => 'required',
            'destination' => 'required',
        ]);

        
        BusSchedule::insert([
            'operator_id' => $request-> operator_id,
            'bus_id' => $request-> bus_id,
            'status' => 0,
            'time_schedule' => $request-> time_schedule,
            'from' => $request->from,
            'destination' => $request->destination,
            'created_at' => Carbon::now(),
        ]);

        Toastr::success('Successfully Added !' ,'Time');
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
        //
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

    public function getBus(Request $request)
    {
        $states = DB::table("buses")
            ->where("operator_id",$request->operator_id)
            ->pluck("bus_code","id");
        return response()->json($states);
    }

    public function busStatus($id)
    {
        $bus_schedule = BusSchedule::findOrFail($id);

        $status =(($bus_schedule->status == 1)? 0:1);

        $bus_schedule->status = $status;
        $bus_schedule->save();

        if($status == 1){
            Toastr::success('Successfully Activated !' ,'Bus');
        }
        else{
            Toastr::success('Successfully Inactivated !' ,'Bus');
        }
        return redirect()->back();
    }


}
