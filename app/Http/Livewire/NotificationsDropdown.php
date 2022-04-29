<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class NotificationsDropdown extends Component
{
    public function markAsRead($id) {
        User::find(auth()->user()->id)
            ->unreadNotifications
            ->where('id', $id)
            ->markAsRead();
    }

    public function markAllAsRead() {
        User::find(auth()->user()->id)
            ->unreadNotifications
            ->markAsRead();
    }

    public function render()
    {
        return view('livewire.notifications-dropdown');
    }
}
