<?php

namespace App\Http\Controllers\Web;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        $reviews = Comment::all();
        return view('pages.web.reviews.main', compact('reviews'));
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect('reviews')->with('success', 'Berhasil mengirim testimoni');
    }
}
