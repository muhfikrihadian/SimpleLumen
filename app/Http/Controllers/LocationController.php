<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use Merchant;
use Auth;
use Illuminate\Support\Facades\Crypt;

class locationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['locations'] = Location::all();
        return view('location.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['merchants'] = Merchant::all();
        return view('location.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new location;
        $table->merchant_id = $request->merchant_id;
        $table->name = $request->name;
        $table->address = $request->address;
        $table->city = $request->city;
        $table->country = $request->country;
        $table->latitude = $request->latitude;
        $table->longtitude = $request->longtitude;
        $table->save();

        return redirect()->route('location');
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
        $id = Crypt::decryptString($id);
        $data['merchants'] = Merchant::all();
        $data['location'] = Location::find($id);
        return view('location.edit')->with($data);
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
        $id = Crypt::decryptString($id);
        $table = Location::find($id);
        $table->merchant_id = $request->merchant_id;
        $table->name = $request->name;
        $table->address = $request->address;
        $table->city = $request->city;
        $table->country = $request->country;
        $table->latitude = $request->latitude;
        $table->longtitude = $request->longtitude;
        $table->save();

        return redirect()->route('location');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decryptString($id);
        $table = Location::find($id);
        $table->delete();

        return redirect()->route('location');
    }
}
