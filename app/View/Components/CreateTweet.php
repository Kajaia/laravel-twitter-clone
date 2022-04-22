<?php

namespace App\View\Components;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class CreateTweet extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    public function store(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);

        Tweet::create([
            'content' => $request->content,
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
        return view('components.create-tweet');
    }
}
