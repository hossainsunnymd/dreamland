<?php

namespace App\Http\Controllers\BackEnd;


use App\Models\Page;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PageContentSaveRequest;

class PageContentController extends Controller
{
    //page content list
    public function pageContentList()
    {
        $pageContents = Page::all();
        return Inertia::render('BackEnd/Content/PageContentListPage', ['pageContents' => $pageContents]);
    }

    //page content save page
    public function pageContentSavePage(Request $request)
    {
        $pageContent = Page::find($request->page_content_id);
        return Inertia::render('BackEnd/Content/PageContentSavePage', ['pageContent' => $pageContent]);
    }

    //page content save
    public function pageContentSave(PageContentSaveRequest $request)
    {
        $data = [
            'page_name' => $request->page_name,
            'title' => $request->title,
            'description' => $request->description,
            'rank' => $request->rank,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];

        // Image handle
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('pageContent', $imageName, );
            $data['image'] = $imageName;
        }

        Page::create($data);

        return redirect()->back()->with([
            'status' => true,
            'message' => 'Page Content Created Successfully',
        ]);
    }

    //page content update

    public function pageContentUpdate(PageContentSaveRequest $request, $id)
    {
        $page = Page::findOrFail($id);

        $data = [
            'page_name' => $request->page_name,
            'title' => $request->title,
            'description' => $request->description,
            'rank' => $request->rank,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];

        //  Image handle with old image delete
        if ($request->hasFile('image')) {
            // Delete old image
            if ($page->image && Storage::disk('public')->exists('pageContent/' . $page->image)) {
                Storage::disk('public')->delete('pageContent/' . $page->image);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('pageContent', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Update the page content
        $page->update($data);

        return redirect()->back()->with([
            'status' => true,
            'message' => 'Page Content Updated Successfully',
        ]);
    }

    //delete page content
    public function pageContentDelete($id)
    {
        $page = Page::findOrFail($id);
        if ($page->image && Storage::disk('public')->exists('pageContent/' . $page->image)) {
            Storage::disk('public')->delete('pageContent/' . $page->image);
        }
        $page->delete();
        return redirect()->back()->with([
            'status' => true,
            'message' => 'Page Content Deleted Successfully',
        ]);
    }

}
