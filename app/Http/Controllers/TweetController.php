<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class TweetController extends Controller
{
    public function __invoke($id)
    {
        return view('tweet', [
            'tweet' => Tweet::findOrFail($id)
        ]);
    }
}
