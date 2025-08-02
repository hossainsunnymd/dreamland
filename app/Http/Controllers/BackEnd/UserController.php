<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserSaveRequest;
use Illuminate\Support\Facades\Storage;
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
        $user = User::findOrFail($id);

        
        if ($request->hasFile('profile_image')) {
           
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('public/profile_images');
            $imgUrl = Storage::url($imagePath);
        } else {
            $imgUrl = $user->profile_image;
        }
        
        $userData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'profile_image' => $imgUrl,
            'abroad_mobile' => $request->abroad_mobile,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        
        $currentRole = $user->getRoleNames()->first();
        if ($currentRole !== 'superadmin' && $request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->back()->with('success', 'User updated successfully');
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
