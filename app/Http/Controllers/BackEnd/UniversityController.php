<?php

namespace App\Http\Controllers\BackEnd;

use Inertia\Inertia;
use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UniversitySaveRequest;

class UniversityController extends Controller
{
    //university list
    public function universityList()
    {

        $universities = University::all();
        return Inertia::render('BackEnd/University/UniversityListPage', ['universities' => $universities]);
    }

    //university save page
    public function universitySavePage(Request $request)
    {

        $univeristy = University::find($request->university_id);
        $countries = Country::all();
        return Inertia::render('BackEnd/University/UniversitySavePage', ['university' => $univeristy,'countries'=>$countries]);
    }

    //univeristy save
    public function universitySave(UniversitySaveRequest $request)
    {

        $data = [
            'country_id' => $request->country_id,
            'name' => $request->name,
            'title' => $request->title,
            'rank' => $request->rank
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('university', $imageName);
            $data['image'] = $imageName;
        }

        University::create($data);
        return redirect()->back()->with(['status' => true, 'message' => 'University Saved Successfully']);
    }

    //university update
    public function universityUpdate(UniversitySaveRequest $request)
    {
        $university = University::findOrFail($request->university_id);

        $data = [
            'country_id' => $request->country_id,
            'name' => $request->name,
            'title' => $request->title,
            'rank' => $request->rank
        ];

        if ($request->hasFile('image')) {

            if ($university->image && Storage::disk('public')->exists('university/' . $university->image)) {
                Storage::disk('public')->delete('university/' . $university->image);
            }


            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('university', $imageName, 'public');

            $data['image'] = $imageName;
        }


        $university->update($data);

        return redirect()->back()->with(['status' => true, 'message' => 'University Updated Successfully']);
    }

    //delete university
    public function universityDelete($university_id)
    {
        $university = University::findOrFail($university_id);
        if ($university->image && Storage::disk('public')->exists('university/' . $university->image)) {
            Storage::disk('public')->delete('university/' . $university->image);
        }
        $university->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'University Deleted Successfully']);
    }
}
