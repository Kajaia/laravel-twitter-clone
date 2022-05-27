@if($this->users->count())
<div class="card border-0 shadow-sm rounded-5">
    <div class="card-header bg-white border-light rounded-top-5">Who to follow</div>
    <div class="card-body pt-0 pb-1">
        @foreach($this->users as $user)
            <livewire:users-list :user="$user" :wire:key="$user->id" />
        @endforeach
    </div>
</div>
@endif