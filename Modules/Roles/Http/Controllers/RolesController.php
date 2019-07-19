<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Roles\Entities\Roles;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::all();
        return view('roles::index', ['roles' => $roles]);
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
