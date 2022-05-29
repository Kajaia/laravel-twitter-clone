<div class="card border-0 shadow-sm rounded-5 mt-3">
    <form action="{{ route('update.profile', $user->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-header bg-white border-light rounded-top-5">
            <h6 class="card-title mb-0">Edit <strong>{{ $user->name . "'s" }}</strong> profile details</h6>
        </div>
        <div class="card-body row">
            <input type="hidden" name="user_id" value="$user->id">
            <div class="col-md-6 form-group mt-2 mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ex: Lasha Kajaia" value="{{ $user->name }}">

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2 mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ex: lashakajaia@mail.com" value="{{ $user->email }}">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2 mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ex: Passw@rd123">

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2 mb-3">
                <label class="form-label" for="password_confirmation">Repeat password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ex: Passw@rd123">

                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2 mb-3">
                <label class="form-label" for="slug">Username</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Ex: lasha-kajaia-123112" value="{{ $user->slug }}">

                @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6 form-group mt-2 mb-3">
                <label class="form-label" for="pic">Profile pic <small class="text-secondary">(Max: 100kb.)</small></label>
                <input type="file" id="pic" name="pic" class="form-control @error('pic') is-invalid @enderror">

                @error('pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-12 form-group mt-2 mb-3">
                <label class="form-label" for="bio">Bio</label>
                <textarea cols="10" rows="3" type="text" id="bio" name="bio" class="form-control @error('bio') is-invalid @enderror" placeholder="Ex: Lorem ipsum dolor, sit amet...">{{ $user->bio }}</textarea>

                @error('bio')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-12 form-group mt-2 mb-3">
                <label class="form-label" for="visibility">Profile visibility</label>
                <select id="visibility" name="visibility" class="form-select @error('visibility') is-invalid @enderror">
                    <option value="1" {{ $user->visibility ? 'selected' : '' }}>Public</option>
                    <option value="0" {{ $user->visibility ? '' : 'selected' }}>Private</option>
                </select>

                @error('visibility')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="card-footer bg-white border-0 rounded-bottom-5 text-center">
            <button type="submit" class="btn btn-primary py-1 px-4 mb-3">Save</button>
        </div>
    </form>
</div>