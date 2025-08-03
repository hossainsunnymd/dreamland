<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Logo;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogoSaveRequest;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    //logo list
    public function logoList()
    {
        $logos = Logo::all();
        return Inertia::render('BackEnd/Logo/LogolistPage', ['logos' => $logos]);
    }

    //logo save page
    public function logoSavePage(Request $request)
    {
        $logo = Logo::find($request->logo_id);
        return Inertia::render('BackEnd/Logo/LogoSavePage', ['logo' => $logo]);
    }

    //logo save
    public function logoSave(LogoSaveRequest $request)
    {
        $data=[
            'content_name'=>$request->content_name,
            'title'=>$request->title
        ];
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('logo', $imageName);
            $data['image'] = $imageName;
        }
        Logo::create($data);
        return redirect()->back()->with(['status' => true, 'message' => 'Logo Saved Successfully']);
    }

    //update logo
    public function logoUpdate(LogoSaveRequest $request, $logo_id)
    {
        $logo = Logo::findOrFail($logo_id);
        $data=[
            'content_name'=>$request->content_name,
            'title'=>$request->title
        ];
        if($request->hasFile('image')){
            if($logo->image && Storage::disk('public')->exists('logo/' . $logo->image)){
                Storage::disk('public')->delete('logo/' . $logo->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('logo', $imageName);
            $data['image'] = $imageName;
        }
        $logo->update($data);
        return redirect()->back()->with(['status' => true, 'message' => 'Logo Updated Successfully']);
    }

    //delete logo
    public function deleteLogo(Request $request)
    {
        $logo = Logo::findOrFail($request->logo_id);
        if($logo->image && Storage::disk('public')->exists('logo/' . $logo->image)){
            Storage::disk('public')->delete('logo/' . $logo->image);
        }
        $logo->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'Logo Deleted Successfully']);
    }


}
