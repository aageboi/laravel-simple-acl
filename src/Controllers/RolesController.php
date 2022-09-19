<?php

namespace Aageboi\Acl\Controllers;

use Gate;
use Aageboi\Acl\Entities\Permission;
use Aageboi\Acl\Entities\Role;
use Aageboi\Acl\Requests\MassDestroyRoleRequest;
use Aageboi\Acl\Requests\StoreRoleRequest;
use Aageboi\Acl\Requests\UpdateRoleRequest;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (auth()->user()->id > 1)
            $roles = Role::where('id', '<>', 1)->get();
        else 
            $roles = Role::all();
        $permissions = Permission::all();

        return view(config('view').'roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all()->pluck('title', 'id');

        return view(config('view').'roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route(config('acl.route.as') . 'roles.index')->with('message', 'Success');

    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all()->pluck('title', 'id');

        $role->load('permissions');

        return view(config('view').'roles.edit', compact('permissions', 'role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route(config('acl.route.as') . 'roles.index')->with('message', 'Success');

    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view(config('view').'roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return back()->with('message', 'Success');

    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
