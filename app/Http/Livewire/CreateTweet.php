<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\UserService;
use Modules\Categories\app\Services\CategoryService;
use Modules\Tweets\app\Models\Tweet;
use Modules\Tweets\app\Http\Requests\TweetRequest;

class CreateTweet extends Component
{
    public $content;
    public $category_id;

    protected $listeners = [
        'submitCategory' => '$refresh',
        'deleteCategory' => '$refresh',
        'createTweet' => '$refresh'
    ];

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

    public function removeCategory(CategoryService $category, $id) 
    {
        $category->getCategoryById($id)->delete();

        $this->emit('deleteCategory');
    }

    public function getCategoriesProperty(CategoryService $category)
    {
        return $category->getCategoriesByUser(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.create-tweet');
    }
}