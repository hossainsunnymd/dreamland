<?php

namespace App\Http\Controllers\BackEnd;

use Service;
use Inertia\Inertia;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceSaveRequest;

class ServiceController extends Controller
{
    //service list
    public function serviceList()
    {
        $services = Services::with('serviceCategory')->get();
        return Inertia::render('BackEnd/Service/ServiceListPage', ['services' => $services]);
    }

    //service save page
    public function serviceSavePage(Request $request)
    {
        $service_id = $request->service_id;
        $serviceCategory = ServiceCategory::all();
        $service = Services::find($service_id);
        return Inertia::render('BackEnd/Service/ServiceSavePage', ['service' => $service, 'serviceCategory' => $serviceCategory]);
    }

    //save service
    public function saveService(ServiceSaveRequest $request)
    {
        $data = [
            'service_category_id' => $request->service_category_id,
            'service_description' => $request->service_description,
            'rank' => $request->rank
        ];

        // Check if image file is uploaded
        if ($request->hasFile('service_image')) {
            $image = $request->file('service_image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the image in storage/app/public/service/
            $image->storeAs('service', $imageName);

            $data['service_image'] = $imageName;
        }

        Services::create($data);

        return redirect()->back()->with([
            'status' => true,
            'message' => 'Service Saved Successfully',
        ]);
    }

    //update service
    public function updateService(ServiceSaveRequest $request, $id)
    {
        $service = Services::findOrFail($id);

        $data = [
            'service_category_id' => $request->service_category_id,
            'service_description' => $request->service_description,
            'rank' => $request->rank
        ];

        // Check if image file is uploaded
        if ($request->hasFile('service_image')) {

            // Delete old image if exists
            if ($service->service_image && Storage::disk('public')->exists('service/' . $service->service_image)) {
                Storage::disk('public')->delete('service/' . $service->service_image);
            }

            // Store new image
            $image = $request->file('service_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('service', $imageName);

            $data['service_image'] = $imageName;
        }

        $service->update($data);

        return redirect()->back()->with(['status' => true, 'message' => 'Service Updated Successfully']);
    }

    //delete service

    public function deleteService($id)
    {
        $service = Services::findOrFail($id);

        // Delete image from storage if it exists
        if ($service->image && Storage::disk('public')->exists('service/' . $service->service_image)) {
            Storage::disk('public')->delete('service/' . $service->service_image);
        }
        $service->delete();

        return redirect()->back()->with(['status' => true, 'message' => 'Service Deleted Successfully']);
    }

}
