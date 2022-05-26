<div wire:ignore.self class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <form wire:submit.prevent="submit" class="modal-content rounded-5">
      <div class="modal-header">
        <h6 class="modal-title" id="createCategoryModalLabel">Create new category</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" wire:model.debounce.500ms="title" placeholder="Ex: Business" class="form-control @error('title') is-invalid @enderror">

        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary px-4 py-1">Save</button>
      </div>
    </form>
  </div>
</div>

@section('scripts')
<script>
    const createCategoryModal = document.querySelector('#createCategoryModal');

    window.addEventListener('close:modal', function() {
        let modal = bootstrap.Modal.getInstance(createCategoryModal);
        modal.hide();
    });
</script>
@endsection