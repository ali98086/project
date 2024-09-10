<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unSeenComments= Comment::where('commentable_type','App\Models\Market\Product')->where('seen', 0)->get();
        foreach($unSeenComments as $unSeenComment){
            $unSeenComment->seen = 1;
            $unSeenComment->save();
        }
        $comments = Comment::orderBy('created_at', 'desc')->where('commentable_type','App\Models\Market\Product')->simplePaginate('15');
        return view('admin.market.comment.index', compact('comments'));
    }




    public function show(Comment $comment)
    {
        return view('admin.market.comment.show', compact('comment'));
    }




    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();

        if ($result) {
            if ($comment->status == 0) {

                return response()->json(['status' => true, 'checked' => false]);
            } else {

                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {

            return response()->json(['status' => false]);
        }
    }




    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 1 ? 0 : 1;
        $result = $comment->save();
        if ($result) {

            return redirect()->route('admin.market.comment.index')->with('swal-success', 'وضعیت نظر با موفقیت تغییر کرد');
        } else {

            return redirect()->route('admin.market.comment.index')->with('swal-error', 'تغییر وضعیت نظر با شکست مواجه شد');
        }
    }




    public function answer(CommentRequest $request, Comment $comment)
    {

        if ($comment->parent == null) {

            $inputs = $request->all();
            $inputs['parent_id'] = $comment->id;
            $inputs['author_id'] = 1;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return redirect()->route('admin.market.comment.index')->with('swal-success', 'پاسخ نظر با موفقیت درج شد');
        }
        else{

            return redirect()->route('admin.market.comment.index')->with('swal-error', 'درج پاسخ نظر با خطا مواجه شد');

        }
    }

}
