<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        return response()->json($users);

    }
    public function show($id) {
        $authUser = auth()->user();
      /*  if(!$authUser->can('view_users'))
        {
            return response()->json(['error'=>true, 'message'=>'sin permisos']);
        }*/
        $user = User::with('roles', 'permissions')->where('id_user',$id)->firstOrFail();
        return response()->json($user);
    }
    public function store(Request $request) {
        dd($request->all());
    }
    public function update(Request $request, $id) {}
    public function destroy($id) {}
    public function switchStatus($id) {}
}
