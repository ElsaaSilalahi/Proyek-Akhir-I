<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Routing\Controller;

class CommentController extends Controller
{
    public function index()
    {
        $reviews = Comment::latest()->get();
        return view('pages.admin.reviews.main', compact('reviews'));
    }
}
