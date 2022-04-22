<!-- Create tweet component -->
<form action="{{ route('create.tweet') }}" method="post" class="card border-0 rounded-5 shadow-sm">
    @csrf
    <div class="card-header border-light rounded-top-5 bg-white">Tweet something</div>
    <div class="card-body d-flex align-items-start gap-2">
        <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
        <div class="w-100">
            <textarea class="form-control bg-light @error('content') is-invalid @enderror" name="content" cols="30" rows="3" placeholder="What's happening?"></textarea>

            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="card-footer rounded-bottom-5 bg-white border-0 text-end">
        <button type="submit" class="btn btn-primary px-4 py-1">Tweet</button>
    </div>
</form>
<!-- /Create tweet component -->