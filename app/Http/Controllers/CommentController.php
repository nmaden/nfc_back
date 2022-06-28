<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\OfficeComments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
           
        
    }

    public function store(CommentRequest $request) {
        $office_comment = new OfficeComments();
        $office_comment->office_id = $request->office_id;
        $office_comment->comment = $request->comment;
        $office_comment->save();
        return response()->json([
            'message' => __("messages.saved_success")
        ]);
    }
}
