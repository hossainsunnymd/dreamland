<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSaveRequest;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //student list
    public function studentList(){
        $student=User::where('user_type','student')->get();
        return Inertia::render('BackEnd/Student/StudentListPage',['students'=>$student]);
    }

    //student save page
    public function studentSavePage(Request $request){
        $student=User::find($request->student_id);
        return Inertia::render('BackEnd/Student/StudentSavePage',['student'=>$student]);
    }

    //student save
    public function studentSave(UserSaveRequest $request){

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        return redirect()->back()->with(['status'=>true,'message'=>'Student Created Successfully']);
    }

    //update student
    public function studentUpdate(UserSaveRequest $request,$id){
        $student=User::find($id);
        $student->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'is_active' => $request->activity
        ]);
        return redirect()->back()->with(['status'=>true,'message'=>'Student Updated Successfully']);
    }

    //delete student
    public function studentDelete(Request $request,$id){
        User::where('id',$id)->delete();
        return redirect()->back()->with(['status'=>true,'message'=>'Student Deleted Successfully']);
    }
}
