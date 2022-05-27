<?php

namespace App\Http\Livewire;

use App\Models\Favourite;
use App\Models\Like;
use App\Models\Reply;
use App\Models\Tweet;
use App\Services\TweetService;
use Livewire\Component;

class TweetList extends Component
{
    public $content;
    public $tweet;
    public $perPageReplies = 3;

    protected $listeners = [
        'storeReply' => '$refresh',
        'perPageRepliesIncrease' => '$refresh'
    ];

    protected $rules = [
        'content' => 'required|max:280'
    ];

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    public function deleteTweet() 
    {
        Tweet::findOrFail($this->tweet->id)->delete();

        $this->emit('deleteTweet');
    }

    public function deleteReply($replyId) 
    {
        Reply::findOrFail($replyId)->delete();

        $this->emit('deleteReply');
    }

    public function storeReply(TweetService $service) 
    {
        $this->validate();

        Reply::create([
            'content' => $this->content,
            'tweet_id' => $this->tweet->id,
            'user_id' => auth()->user()->id
        ]);

        if(!$service->isAuthor($this->tweet->user->id)) {
            $service->replyOnTweetNotification($this->tweet);
        }

        $this->reset('content');
    }

    public function likeTweet(TweetService $service) 
    {
        $service->likeUnlikeTweet($this->tweet);

        $this->emit('likeTweet');
    }

    public function addToFavourites(TweetService $service) 
    {
        $service->addFavourites($this->tweet);

        $this->emit('addToFavourites');
    }

    public function perPageRepliesIncrease() 
    {
        $this->perPageReplies += 3;
    }

    public function getLikesProperty()
    {
        return Like::where('tweet_id', $this->tweet->id);
    }

    public function getFavouritesProperty()
    {
        return Favourite::where('tweet_id', $this->tweet->id);
    }

    public function getRepliesProperty()
    {
        return Reply::where('tweet_id', $this->tweet->id)
            ->orderBy('created_at', 'desc')
            ->cursorPaginate($this->perPageReplies);
    }

    public function getRepliesCountProperty()
    {
        return Reply::where('tweet_id', $this->tweet->id)->count();
    }

    public function render()
    {
        return view('livewire.tweet-list');
    }
}
