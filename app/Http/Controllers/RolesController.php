<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use Redirect;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::all();
        return view('master.roles.roles', ['roles' => $roles]);
    }

    public function save(Request $request)
    {
        $roles = new Roles();
        $roles->nama_roles = $request->nama_roles;
        $roles->save();

        return Redirect::to('roles');
    }

    public function update($id, Request $request)
    {
        $roles = Roles::find($id);
        $roles->nama_roles = $request->nama_roles;
        $roles->save();

        return Redirect::to('roles');
    }

    public function delete($id)
    {
        $roles = Roles::find($id);
        $roles->delete();
        return Redirect::to('roles');
    }
}
