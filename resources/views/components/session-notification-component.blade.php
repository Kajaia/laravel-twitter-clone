@if(session('message'))
<div class="alert alert-success alert-dismissible rounded-5 border-0 fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif