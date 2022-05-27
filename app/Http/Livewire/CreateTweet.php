<?php

namespace App\Http\Livewire;

use App\Http\Requests\TweetRequest;
use App\Models\Category;
use App\Models\Tweet;
use App\Services\UserService;
use Livewire\Component;

class CreateTweet extends Component
{
    public $content;
    public $category_id;

    protected $listeners = [
        'submitCategory' => '$refresh',
        'deleteCategory' => '$refresh',
        'createTweet' => '$refresh'
    ];

    public function mount() 
    {
        $this->category_id = Category::where('user_id', auth()->user()->id)
            ->first()->id ?? null;
    }

    public function rules(): array
    {
        return (new TweetRequest)->rules();
    }

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    public function submit(UserService $service) 
    {
        $this->validate();

        $tweet = Tweet::create([
            'content' => $this->content,
            'user_id' => auth()->user()->id,
            'category_id' => $this->category_id
        ]);

        $service->userTweetedNotification($tweet);

        $this->reset();

        $this->emit('createTweet');
    }

    public function removeCategory($id) 
    {
        Category::findOrFail($id)->delete();

        $this->emit('deleteCategory');
    }

    public function getCategoriesProperty()
    {
        return Category::where('user_id', auth()->user()->id)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.create-tweet');
    }
}
