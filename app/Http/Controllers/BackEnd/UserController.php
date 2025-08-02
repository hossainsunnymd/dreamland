<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSaveRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user list
    public function listUser()
    {
        $users = User::where('user_type',  'admin')->with('roles')->get();
        return Inertia::render('BackEnd/Users/UserListPage', [
            'users' => $users
        ]);
    }

    //user save page
    public function userSavePage(Request $request)
    {
        $users = User::find($request->user_id);
        $roles=Role::all();
        if(!empty($users)){
            $users=User::with('roles')->find($request->user_id);
        }
        return Inertia::render('BackEnd/Users/UserSavePage', [
            'users' => $users
            ,'roles'=>$roles
        ]);
    }

    //user create
    public function createUser(UserSaveRequest $request)
    {

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'user_type' => 'admin'
        ]);

        $user->assignRole($request->role);
        return redirect()->back()->with([
            'status' => true,
            'message' => 'User created successfully',
            'errors' => ''
        ]);
    }

    //user update
    public function updateUser(UserSaveRequest $request,$id)
    {

        $user=User::with('roles')->find($id);
        $user->update([
            'name' => $request->name,
            'password' => $request->password,
            'phone' => $request->phone
        ]);

        $role=count($user->roles)!=0?$user->roles[0]->name:'';
        if($role!='superadmin' || $role==null){
            $user->syncRoles($request->role);
        }

        return redirect()->back()->with([
            'status' => true,
            'message' => 'User updated successfully',
            'errors' => ''
        ]);
    }

    //user delete
    public function deleteUser(Request $request,$id)
    {

        $user=User::with('roles')->find($id);
        $role=count($user->roles)!=0?$user->roles[0]->name:'';
        if($role=='superadmin'){
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Superadmin cannot be deleted',
                'errors' => ''
            ]);
        }else{
            $user->delete();
        }
        return redirect()->back()->with([
            'status' => true,
            'message' => 'User deleted successfully',
            'errors' => ''
        ]);
    }
}
