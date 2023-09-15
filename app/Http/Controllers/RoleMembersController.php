<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleMembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:permissions-update');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $user = User::findOrFail(request('user_id'));
        $user->assignRole($role);
        return back()->with('alert-message', $user->name .' har nu rollen '. $role->label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, User $user)
    {
        $user->removeRole($role);
        return back()->with('alert-message', $user->name .' har inte längre rollen '. $role->label);
    }
}
