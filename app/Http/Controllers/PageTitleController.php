<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageTitleRequest;
use App\Http\Requests\UpdatePageTitleRequest;
use App\Models\PageTitle;
use Illuminate\Http\Request;

class PageTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPageTitles = PageTitle::all();
        return $allPageTitles;
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageTitleRequest $request)
    {
        $data = $request->validated();
        $pageTitle = PageTitle::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Page Title Created Successfully',
            'data' => $pageTitle
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageTitle $pageTitle)
    {
        $pageTitle = PageTitle::findOrFail($pageTitle->id);
        return response()->json([
            'status' => true,
            'data' => $pageTitle
        ]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(PageTitle $pageTitle)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageTitleRequest $request, PageTitle $pageTitle)
    {
        $data = $request->validated();
        $pageTitle->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Page Title Updated Successfully',
            'data' => $pageTitle
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageTitle $pageTitle)
    {
        $pageTitle->delete();

        return response()->json([
            'status' => true,
            'message' => 'Page Title Deleted Successfully'
        ]);
    }
}
