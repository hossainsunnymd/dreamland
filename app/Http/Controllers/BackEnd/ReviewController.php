<?php

namespace App\Http\Controllers\BackEnd;



use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\StudentReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReviewSaveRequest;

class ReviewController extends Controller
{
    //review list
    public function reviewList()
    {
        $reviews = StudentReview::all();
        return Inertia::render('BackEnd/StudentReview/StudentReviewListPage', ['reviews' => $reviews]);
    }

    //review save page
    public function reviewSavePage(Request $request)
    {
        $review = StudentReview::find($request->review_id);
        return Inertia::render('BackEnd/StudentReview/StudentReviewSavePage', ['review' => $review]);
    }

    //review save

    public function reviewSave(ReviewSaveRequest $request)
    {
        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'rating' => $request->rating,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('review', $imageName);
            $data['image'] = $imageName;
        }

        StudentReview::create($data);

        return redirect()->back()->with(['status' => true, 'message' => 'Review saved successfully']);
    }

    public function reviewUpdate(ReviewSaveRequest $request, $id)
    {
        $review = StudentReview::findOrFail($id);

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'rating' => $request->rating,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($review->image && Storage::disk('public')->exists('review/' . $review->image)) {
                Storage::disk('public')->delete('review/' . $review->image);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('review', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $review->update($data);

        return redirect()->back()->with(['status' => true, 'message' => 'Review updated successfully']);
    }


    //delete review
    public function reviewDelete($id)
    {
        $review = StudentReview::findOrFail($id);

        // Delete image from storage if exists
        if ($review->image && Storage::disk('public')->exists('review/' . $review->image)) {
            Storage::disk('public')->delete('review/' . $review->image);
        }

        // Delete review from database
        $review->delete();

        return redirect()->back()->with(['status' => true, 'message' => 'Review deleted successfully']);
    }


}
