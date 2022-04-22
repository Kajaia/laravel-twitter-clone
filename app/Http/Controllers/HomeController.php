<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class HomeController extends Controller
{
    public function index() {
        return view('index', [
            'tweets' => Tweet::with([
                'user',
                'replies',
                'likes'
            ])
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
