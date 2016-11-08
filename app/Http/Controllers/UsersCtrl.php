<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Auth;

class UsersCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index()
    {
        if (Auth::user()->can('user.list')) {

            $data["users"] = User::all();

            foreach ($data["users"] as $key => $value) {
                $data["users"][$key]->roles = $value->getRoles();
            }
            return view('modules/users/users')->with($data);

        }else{
            return view('permission');
        }
    }

    protected function create(request $request)
    {

        if (Auth::user()->can('user.add')) {

            $data['roles'] = Role::all();
            return view('modules/users/users-create')->with($data);

        }else{
            return view('permission');
        }

    }

    protected function edit($idUser)
    {
        if (Auth::user()->can('user.edit')) {

            $data["user"] = User::findOrFail($idUser);
            $data["user"]->roles = $data["user"]->getRoles();
            $data['roles'] = Role::all();

            return view('modules/users/users-edit')->with($data);

        }else{
            return view('permission');
        }
    }

    protected function store(request $request)
    {
        if (Auth::user()->can('user.add')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',

                ]
            );

            $user = User::create(
                [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                ]
            );

            return $this->assignOrRevoke($user->id, $request['role']);

        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }

    protected function update($idUser, request $request)
    {

        if (Auth::user()->can('user.edit')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',

                ]
            );

            if ($request['password'] != "") {
                if ($request['password'] != $request['password_confirmation']) {
                    return array(
                    'type' => 'alert-danger',
                    'msg' => 'contraseñas deben coincidir',
                    'data' => '',
                    );
                }
            }

            $users = User::findOrFail($idUser);

            $users->name = $request['name'];
            $users->email = $request['email'];
            if ($request['password'] != "") {
                    $users->password = bcrypt($request['password']);
            }


            $data = $users->save();
            if ($data) {
                $users->revokeAllRoles();
                foreach ($request['idRole'] as $id) {
                    $data = $this->assignOrRevoke($idUser, $id);
                }
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


    protected function remove($idUser)
    {

        if (Auth::user()->can('user.delete')) {

            $users = User::findOrFail($idUser);

            if ($users->delete()) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success borrando',
                'data' => $users,
                );
            }else{
                return array(
                'type' => 'alert-danger',
                'msg' => 'error borrando',
                'data' => $users,
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


    protected function assignUserRole($idUser, request $request)
    {
        if (Auth::user()->can('role.assign')) {

            foreach ($request['idRole'] as $id) {
                $data = $this->assignOrRevoke($idUser, $id);
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

    protected function revokeuserRole($idUser, $idRole)
    {
        if (Auth::user()->can('role.remove')) {

            return $this->assignOrRevoke($idUser, $idRole, false);
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }

    }

    protected function revokeAllRoles($idUser)
    {

        if (Auth::user()->can('role.remove')) {
            $user = User::find($idUser);
            $user->revokeAllRoles();
            $res = $user->save();

            if ($res) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success revoking all roles',
                'data' => $res
                  );
            }else{
                return array(
                'type' => 'alert-danger',
                'msg' => 'error revoking all roles',
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


    private function assignOrRevoke($idUser, $idRoles, $action=true)
    {
        if (Auth::user()->canAtLeast(['role.remove', 'role.add'])) {

            $user = User::findOrFail($idUser);
            $type = ($action) ? 'updating': 'removing';

            if ($action) {

                $user->assignRole($idRoles);
            }else{
                $user->revokeRole($idRoles);
            }
            $res = $user->save();
            if ($res) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success '.$type.' user',
                'data' => $res
                      );
            }else{
                return array(
                'type' => 'alert-danger',
                'msg' => 'error '.$type.' user',
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
