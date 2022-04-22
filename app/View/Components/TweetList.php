<?php

namespace App\View\Components;

use App\Models\Reply;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class TweetList extends Component
{
    public $tweet;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function storeReply(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);

        Reply::create([
            'content' => $request->content,
            'tweet_id' => $request->tweet_id,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tweet-list');
    }
}
