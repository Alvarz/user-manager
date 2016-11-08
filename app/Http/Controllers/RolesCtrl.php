<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Auth;

class RolesCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index()
    {
        if (Auth::user()->can('role.list')) {

            $data["roles"] = Role::all();
            return view('modules/roles/roles')->with($data);

        }else{
            return view('permission');
        }
    }

    protected function create(request $request)
    {
        if (Auth::user()->can('role.add')) {

            return view('modules/roles/roles-create');

        }else{
            return view('permission');
        }
    }

    protected function edit($idRole)
    {
        if (Auth::user()->can('role.edit')) {

            $data["roles"] = Role::findOrFail($idRole);
            return view('modules/roles/roles-edit')->with($data);

        }else{
            return view('permission');
        }
    }

    protected function store(request $request)
    {
        if (Auth::user()->can('role.add')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'slug' => 'required|unique:roles|max:100',
                'description' => 'max:500'

                ]
            );

            $data = Role::create(
                [
                'name' => $request['name'],
                'slug' => $request['slug'],
                'description' => $request['description'],
                ]
            );
            if ($data) {
                    return array(
                    'type' => 'alert-success',
                    'msg' => 'success',
                    'data' => $data
                    );
            }else{
                    return array(
                    'type' => 'alert-danger',
                    'msg' => 'error',
                    'data' => $data,
                    );
            }
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }

    protected function update($idRole, request $request)
    {

        if (Auth::user()->can('role.edit')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'slug' => 'required|max:100',
                'description' => 'max:500'

                ]
            );

            $Roles = Role::findOrFail($idRole);

            $Roles->name = $request['name'];
            $Roles->slug = $request['slug'];
            $Roles->description = $request['description'];

            if ($Roles->save()) {
                    return array(
                    'type' => 'alert-success',
                    'msg' => 'success',
                    'data' => $Roles,
                    );
            }else{
                    return array(
                    'type' => 'alert-danger',
                    'msg' => 'error',
                    'data' => $Roles,
                    );
            }
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }


    protected function remove($idRole)
    {

        if (Auth::user()->can('role.remove')) {

            $Roles = Role::findOrFail($idRole);

            if ($Roles->delete()) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success borrando',
                'data' => $Roles,
                );
            }else{
                return array(
                'type' => 'alert-danger',
                'msg' => 'error borrando',
                'data' => $Roles,
                );
            }
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }

    protected function rolePermissions($idRole)
    {
        if (Auth::user()->can('permission.assign')) {

            $data["role"] = Role::findOrFail($idRole);
            $data['permissionsList'] = $permissions = Permission::all();
            $permissions = $data["role"]->getPermissions();
            // dd($permissions);
            $data['permissions'] = array();

            foreach ($permissions as $key => $value) {
                array_push($data['permissions'], Permission::where('slug', $value)->firstOrFail());
            }

            return view('modules/roles/role-permission')->with($data);
        }else{
            return view('permission');
        }
    }

    protected function assignRolePermissions($idRole, request $request)
    {
        if (Auth::user()->can('permission.assign')) {

            foreach ($request['idPermission'] as $id) {
                $data = $this->assignOrRevoke($idRole, $id);
            }

            return $data;
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }

    }

    protected function revokeRolePermissions($idrole, $idpermission)
    {
        if (Auth::user()->can('permission.revoke')) {

            return $this->assignOrRevoke($idrole, $idpermission, false);
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }

    protected function revokeAllPermissions($idRole)
    {
        if (Auth::user()->can('permission.revoke')) {
            $role = Role::find($idRole);
            $role->revokeAllPermissions();
            $res = $role->save();

            if ($res) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success revoking all permission',
                'data' => $res
                  );
            }else{
                  return array(
                  'type' => 'alert-danger',
                  'msg' => 'error revoking all permission',
                  'data' => $res
                  );
            }
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }


    private function assignOrRevoke($idRole, $idPermission, $action=true)
    {
        if (Auth::user()->canAtLeast(['permission.revoke', 'permission.asign'])) {

            $role = Role::findOrFail($idRole);
            $type = ($action) ? 'assigning': 'removing';

            if ($action) {
                $role->assignPermission($idPermission);
            }else{
                $role->revokePermission($idPermission);
            }
            $res = $role->save();
            if ($res) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success '.$type.' permission',
                'data' => $res
                  );
            }else{
                  return array(
                  'type' => 'alert-danger',
                  'msg' => 'error '.$type.' permission',
                  'data' => $res
                  );
            }
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }


}
