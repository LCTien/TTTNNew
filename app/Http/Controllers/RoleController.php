<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 1;
        $itemSet = 0;
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $itemSet = 6 * ($page - 1); 
        }
        $allRole = DB::select('select roles.name,roles.description,COUNT(roles.id) as tong
        from roles ,accounts
        where accounts.role_id = roles.id 
        and  EXISTS (select role_id from accounts) 
        group by roles.name,roles.description
        ');
        $roles = DB::select('select roles.name,roles.description,COUNT(roles.id) as tong
        from roles ,accounts
        where accounts.role_id = roles.id 
        and  EXISTS (select role_id from accounts) 
        group by roles.name,roles.description
        limit 6
        offset ?
        ',[$itemSet]);
        $quantity_page = ceil(count($allRole) / 6);
        return view('rule',['page' => $page,'maxPage' => $quantity_page,'listRoles' => $roles,'isInstall'=> true,'isRule' => true]);
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
     * @param  \App\Http\Requests\StoreroleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreroleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateroleRequest  $request
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateroleRequest $request, role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        //
    }
}
