<?php

namespace App\Http\Controllers\BackEnd;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\CountryDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CountryDetailSaveRequest;
use App\Models\Country;

class CountryDetailController extends Controller
{
    //country detial list
    public function countryDetailList()
    {
        $countryDetails = CountryDetail::all();
        return Inertia::render('BackEnd/CountryDetails/CountryDetailListPage', ['countryDetails' => $countryDetails]);
    }

    //country detail save page
    public function countryDetailSavePage(Request $request)
    {
        $countryDetail = CountryDetail::find($request->country_detail_id);
         $countries = Country::all();
        return Inertia::render('BackEnd/CountryDetails/CountryDetailSavePage', ['countryDetail' => $countryDetail,'countries'=>$countries]);
    }

    //country detail save
    public function countryDetailSave(CountryDetailSaveRequest $request)
    {
        $data = [
            'country_id' => $request->country_id,
            'title' => $request->title,
            'key_points' => $request->key_points,
            'description' => $request->description,
        ];

        // Check if image exists in the request
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('countryDetail', $imageName, );

            $data['image'] = $imageName;
        }


        CountryDetail::create($data);

        return redirect()->back()->with(['status' => true, 'message' => 'Country Detail Saved Successfully']);
    }

    //update country detail
    public function countryDetailUpdate(CountryDetailSaveRequest $request, $country_detail_id)
    {
        $countryDetail = CountryDetail::findOrFail($country_detail_id);

        $data = [
            'country_id' => $request->country_id,
            'title' => $request->title,
            'key_points' => $request->key_points,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($countryDetail->image && Storage::disk('public')->exists('countryDetail/' . $countryDetail->image)) {
                Storage::disk('public')->delete('countryDetail/' . $countryDetail->image);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('countryDetail', $imageName);

            $data['image'] = $imageName;
        }

        $countryDetail->update($data);

        return redirect()->back()->with(['status' => true, 'message' => 'Country Detail Updated Successfully']);
    }


    //delete country detail
    public function countryDetailDelete($country_detail_id)
    {
        $countryDetail = CountryDetail::findOrFail($country_detail_id);
        if ($countryDetail->image && Storage::disk('public')->exists('countryDetail/' . $countryDetail->image)) {
            Storage::disk('public')->delete('countryDetail/' . $countryDetail->image);
        }
        $countryDetail->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'Country Detail Deleted Successfully']);
    }

}
