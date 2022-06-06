<?php

namespace Modules\Tweets\app\Http\Controllers;

use Modules\Tweets\app\Models\Tweet;
use Illuminate\Routing\Controller as BaseController;

class TweetController extends BaseController
{
    // Get tweet by id
    public function __invoke($id)
    {
        return view('tweet::tweet', ['tweet' => Tweet::findOrFail($id)]);
    }
}