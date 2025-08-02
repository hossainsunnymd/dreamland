<?php

namespace App\Http\Controllers\BackEnd;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceCategorySaveRequest;

class ServiceCategoryController extends Controller
{
    //service category list
    public function ServiceCategoryList()
    {
        $serviceCategories = ServiceCategory::all();
        return Inertia::render('BackEnd/ServiceCategory/ServiceCategoryListPage', ['serviceCategories' => $serviceCategories]);
    }

    //service category save page
    public function serviceCategorySavePage(Request $request)
    {
        $serviceCategory = ServiceCategory::find($request->service_category_id);
        return Inertia::render('BackEnd/ServiceCategory/ServiceCategorySavePage', ['serviceCategory' => $serviceCategory]);
    }

    //save service category
    public function saveServiceCategory(ServiceCategorySaveRequest $request)
    {
        $data = [
            'service_name' => $request->service_name,
            'service_title' => $request->service_title,
        ];

        // Check if image file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the image in storage/app/public/service-category/
            $image->storeAs('serviceCategory', $imageName, 'public');

            $data['image'] = $imageName;
        }

        ServiceCategory::create($data);

        return redirect()->back()->with([
            'status' => true,
            'message' => 'Service Category Saved Successfully',
        ]);
    }


    //update service category
    public function updateServiceCategory(ServiceCategorySaveRequest $request, $id)
    {
        $serviceCategory = ServiceCategory::findOrFail($id);

        $data = [
            'service_name' => $request->service_name,
            'service_title' => $request->service_title,
        ];

        // Check if image file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new image
            $image->storeAs('serviceCategory', $imageName, 'public');
            $data['image'] = $imageName;

            // Delete the old image if exists
            if ($serviceCategory->image && Storage::disk('public')->exists('serviceCategory/' . $serviceCategory->image)) {
                Storage::disk('public')->delete('serviceCategory/' . $serviceCategory->image);
            }
        }

        $serviceCategory->update($data);

        return redirect()->back()->with([
            'status' => true,
            'message' => 'Service Category Updated Successfully'
        ]);
    }


    //delete service category
    public function deleteServiceCategory($id)
    {
        $serviceCategory = ServiceCategory::findOrFail($id);

        // Delete image from storage if exists
        if ($serviceCategory->image && Storage::disk('public')->exists('serviceCategory/' . $serviceCategory->image)) {
            Storage::disk('public')->delete('serviceCategory/' . $serviceCategory->image);
        }

        $serviceCategory->delete();

        return redirect()->back()->with([
            'status' => true,
            'message' => 'Service Category Deleted Successfully'
        ]);
    }

}
