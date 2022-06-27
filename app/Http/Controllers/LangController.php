<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index() {
        return 
        response()->json([
            "content"   => __("content"),
        ], 200);
    }
}
