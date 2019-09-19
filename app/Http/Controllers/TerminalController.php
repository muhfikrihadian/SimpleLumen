<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Terminal;
use Merchant;
use Location;
use Auth;
use Illuminate\Support\Facades\Crypt;

class terminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['terminals'] = Terminal::all();
        return view('terminal.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['merchants'] = Merchant::all();
        $data['locations'] = Location::all();
        return view('terminal.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Terminal;
        $table->merchant_id = $request->merchant_id;
        $table->name = $request->name;
        $table->remarks = $request->remarks;
        $table->terminal_limit = $request->terminal_limit;
        $table->latitude = Location::where('id', $request->location_id)->value('latitude');
        $table->longtitude = Location::where('id', $request->location_id)->value('longtitude');
        $table->created_by = Auth::user()->id;
        $table->location_id = $request->location_id;
        $table->save();

        return redirect()->route('terminal');
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
        $data['locations'] = Location::all();
        $data['terminal'] = Terminal::find($id);
        return view('terminal.edit')->with($data);
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
        $table = Terminal::find($id);
        $table->merchant_id = $request->merchant_id;
        $table->name = $request->name;
        $table->remarks = $request->remarks;
        $table->terminal_limit = $request->terminal_limit;
        $table->latitude = Location::where('id', $request->location_id)->value('latitude');
        $table->longtitude = Location::where('id', $request->location_id)->value('longtitude');
        $table->location_id = $request->location_id;
        $table->save();

        return redirect()->route('terminal');
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
        $table = Terminal::find($id);
        $table->delete();

        return redirect()->route('terminal');
    }
}
