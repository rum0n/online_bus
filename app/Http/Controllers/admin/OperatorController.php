<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Operator;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $all_operator = Operator::all();
        return view('admin.operators.add-operator',compact('all_operator'));
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
            'operator_name' => 'required',
            'operator_email' => 'required',
            'operator_phone' => 'required|numeric',
            'operator_address' => 'required',

        ]);

        Operator::insert([
            'operator_name' => $request-> operator_name,
            'operator_email' => $request-> operator_email,
            'operator_phone' => $request-> operator_phone,
            'operator_address' => $request-> operator_address,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Successfully Added !' ,'Operator');
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
        Operator::find($id)->delete();

        Toastr::success('Successfully Deleted !' ,'Operator');
        return back();
    }
}
