<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Auth;

class PermissionsCtrl extends Controller
{

  /**
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     * @return Illuminate\View
     */
    protected function index()
    {
        if (Auth::user()->can('permission.list')) {

            $data["permissions"] = Permission::paginate(10);
            return view('modules/permissions/permissions')->with($data);

        }else{
            return view('permission');
        }
    }

    /**
     * 
     * @return Illuminate\View
     */
    protected function create()
    {
        if (Auth::user()->can('permission.add')) {

            return view('modules/permissions/permissions-create');
        }else{
            return view('permission');
        }
    }

    /**
     * @param int
     * @return Illuminate\View
     */
    protected function edit($idPermission)
    {
        if (Auth::user()->can('permission.edit')) {

            $data["permission"] = Permission::findOrFail($idPermission);
            return view('modules/permissions/permissions-edit')->with($data);

        }else{
            return view('permission');
        }
    }

    /**
     * @param request
     * @return array
     */
    protected function store(request $request)
    {
        if (Auth::user()->can('permission.add')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'slug' => 'required|unique:permissions|max:100',
                'description' => 'max:500'

                ]
            );

            $data = Permission::create(
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

    /**
     * @param int, request
     * @return array
     */
    protected function update($idPermission, request $request)
    {
        if (Auth::user()->can('permission.edit')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'slug' => 'required|max:100',
                'description' => 'max:500'

                ]
            );

            $permission = Permission::findOrFail($idPermission);

            $permission->name = $request['name'];
            $permission->slug = $request['slug'];
            $permission->description = $request['description'];

            if ($permission->save()) {
                    return array(
                    'type' => 'alert-success',
                    'msg' => 'success',
                    'data' => $permission,
                    );
            }else{
                    return array(
                    'type' => 'alert-danger',
                    'msg' => 'error',
                    'data' => $permission,
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


    /**
     * @param int
     * @return array
     */
    protected function remove($IdPermission)
    {
        if (Auth::user()->can('permission.delete')) {

            $permission = Permission::findOrFail($IdPermission);

            if ($permission->delete()) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success borrando',
                'data' => $permission,
                );
            }else{
                return array(
                'type' => 'alert-danger',
                'msg' => 'error borrando',
                'data' => $permission,
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
