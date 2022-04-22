<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class FollowUsers extends Component
{
    public $limit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.follow-users', [
            'users' => User::inRandomOrder()
                ->limit($this->limit)
                ->get()
        ]);
    }
}
