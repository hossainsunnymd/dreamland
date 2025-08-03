<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSaveRequest;

class ProfileController extends Controller
{
    //update profile
    public function updateProfile(UserSaveRequest $request, $id)
    {

        User::find($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with(['status' => true, 'message' => 'Profile updated successfully']);
    }
}
