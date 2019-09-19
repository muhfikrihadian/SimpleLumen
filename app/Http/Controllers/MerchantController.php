<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Merchant;
use Auth;
use DB;
use Illuminate\Support\Facades\Crypt;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['merchants'] = Merchant::all();
        return view('merchant.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['groups'] = DB::table('roles')->all();
        return view('merchant.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Merchant;
        $table->group_id = $request->group_id;
        $table->name = $request->name;
        $table->address = $request->address;
        $table->pic = $request->pic;
        $table->phone = $request->phone;
        $table->created_by = Auth::user()->id();
        $table->pic_email = $request->pic_email;
        $table->save();

        return redirect()->route('merchant');
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
        $data['merchant'] = Merchant::find($id);
        return view('merchant.edit')->with($data);
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
        $table = Merchant::find($id);
        $table->group_id = $request->group_id;
        $table->name = $request->name;
        $table->address = $request->address;
        $table->pic = $request->pic;
        $table->phone = $request->phone;
        $table->pic_email = $request->pic_email;
        $table->save();

        return redirect()->route('merchant');
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
        $table = Merchant::find($id);
        $table->delete();

        return redirect()->route('merchant');
    }
}
