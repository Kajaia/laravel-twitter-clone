<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Reply;
use Livewire\Component;

class TweetList extends Component
{
    public $content;

    public $tweet;

    protected $listeners = [
        'storeReply' => 'render'
    ];

    protected $rules = [
        'content' => 'required|max:280'
    ];

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function storeReply() {
        $this->validate();

        Reply::create([
            'content' => $this->content,
            'tweet_id' => $this->tweet->id,
            'user_id' => auth()->user()->id
        ]);
    }

    public function likeTweet() {
        if(!in_array(auth()->user()->id, $this->tweet->likes->pluck('user_id')->toArray())) {
            Like::create([
                'tweet_id' => $this->tweet->id,
                'user_id' => auth()->user()->id
            ]);
        } else {
            Like::where('tweet_id', $this->tweet->id)
                ->where('user_id', auth()->user()->id)
                ->delete();
        }
    }

    public function render()
    {
        return view('livewire.tweet-list', [
            'likes' => Like::where('tweet_id', $this->tweet->id),
            'replies' => Reply::where('tweet_id', $this->tweet->id)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get(),
            'repliesCount' => Reply::where('tweet_id', $this->tweet->id)
                ->count()
        ]);
    }
}
