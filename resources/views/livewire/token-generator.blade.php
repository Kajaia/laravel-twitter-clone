<div class="card border-0 shadow-sm rounded-5 mb-3">
    <div class="card-header bg-white border-light rounded-top-5">User token</div>
    <div class="card-body pt-0 pb-1 text-center">
        <code>{{ $token }}</code>
        <button wire:click="generate" class="btn btn-sm btn-primary py-1 px-4 mt-2 mb-2">Generate</button>
    </div>
</div>