<?php

namespace App\Http\Controllers;

use App\Models\web_lara1;
use Illuminate\Http\Request;
use Session;

class ATGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{
            $request->validate([
            'name'=>['required','unique:web_lara1s'],
            'email'=>['required','unique:web_lara1s','regex:/(^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$)/u'],
            'pincode'=>['required','regex:/(^[1-9]{1}[0-9]{2}\s{0,1}[0-9]{3}$)/u']

            ]);
            $res=new web_lara1;
            $res->name=$request->name;
            $res->email=$request->email;
            $res->pincode=$request->pincode;
            $res->save();
            $ghj=[$request->name,$request->email,$request->pincode];
            $request->session()->put('LoggedUser',$ghj);
            return redirect('dash');

        }catch(Exception $e){
            
            return back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\web_lara1  $web_lara1
     * @return \Illuminate\Http\Response
     */
    public function show(web_lara1 $web_lara1)
    {
        return view()->with('weblara',web_lara1::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\web_lara1  $web_lara1
     * @return \Illuminate\Http\Response
     */
    public function edit(web_lara1 $web_lara1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\web_lara1  $web_lara1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, web_lara1 $web_lara1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\web_lara1  $web_lara1
     * @return \Illuminate\Http\Response
     */
    public function destroy(web_lara1 $web_lara1)
    {
        //
    }
}
