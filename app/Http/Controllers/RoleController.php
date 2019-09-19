<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Crypt;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    	// $this->middleware('auth');
    	// $this->middleware('permission:role-list');
    	// $this->middleware('permission:role-create', ['only' => ['create','store']]);
    	// $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    	// $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$roles = Role::orderBy('id','DESC')->paginate(5);
    	return view('roles.index',compact('roles'))
    	->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permission'] = Permission::groupBy('group')->orderBy('group', 'asc')->orderBy('name', 'asc')->orderBy('id', 'asc')->get();
        $data['segment'] = Permission::selectRaw("REPLACE(`name`, CONCAT(`group`,'-'), '') AS `segment`")->groupBy('segment')->orderBy('segment', 'desc')->get();
        foreach ($data['permission'] as $key => $value) {
            foreach ($data['segment'] as $key => $value2) {
                if(Permission::whereRaw("`group` = '".$value->group."' AND REPLACE(`name`, CONCAT(`group`,'-'), '') = '".$value2->segment."'")->exists())
                {
                    $toog = 1;
                    $data['perment'][$value->group][$value2->segment]['id'] = Permission::whereRaw("`group` = '".$value->group."' AND REPLACE(`name`, CONCAT(`group`,'-'), '') = '".$value2->segment."'")->value('id');
                }
                else {
                    $toog = 0;
                }
                $data['perment'][$value->group][$value2->segment]['check'] = $toog;
            }
        }
        return view('roles.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|unique:roles,name',
    		'permission' => 'required',
    	]);


    	$role = Role::create(['name' => $request->input('name')]);
    	$role->syncPermissions($request->input('permission'));


    	return redirect()->route('roles.index')
    	->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('roles.index');
    	// $role = Role::find($id);
    	// $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    	// ->where("role_has_permissions.role_id",$id)
    	// ->get();


    	// return view('roles.show',compact('role','rolePermissions'));
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
    	$data['role'] = Role::find($id);
    	$data['permission'] = Permission::groupBy('group')->orderBy('group', 'asc')->orderBy('name', 'asc')->orderBy('id', 'asc')->get();
        $data['segment'] = Permission::selectRaw("`id`, REPLACE(`name`, CONCAT(`group`,'-'), '') AS `segment`")->groupBy('segment')->orderBy('segment', 'desc')->get();
        foreach ($data['permission'] as $key => $value) {
            foreach ($data['segment'] as $key => $value2) {
                if(Permission::whereRaw("`group` = '".$value->group."' AND REPLACE(`name`, CONCAT(`group`,'-'), '') = '".$value2->segment."'")->exists())
                {
                    $toog = 1;
                    $data['perment'][$value->group][$value2->segment]['id'] = Permission::whereRaw("`group` = '".$value->group."' AND REPLACE(`name`, CONCAT(`group`,'-'), '') = '".$value2->segment."'")->value('id');
                }
                else {
                    $toog = 0;
                }
                $data['perment'][$value->group][$value2->segment]['check'] = $toog;
            }
        }
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        return view('roles.edit')->with($data);
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
    	$this->validate($request, [
    		'name' => 'required',
    		'permission' => 'required',
    	]);


    	$role = Role::find($id);
    	$role->name = $request->input('name');
    	$role->save();


    	$role->syncPermissions($request->input('permission'));


    	return redirect()->route('roles.index')->with('success','Role updated successfully');
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
    	DB::table("roles")->where('id',$id)->delete();
    	return redirect()->route('roles.index')
    	->with('success','Role deleted successfully');
    }
}
