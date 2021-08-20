@extends('layouts.auth')

@section('content')
<div class="card card-primary">
    <div class="card-header"><h4>Setup Organization</h4></div>

    <div class="card-body">
      <form method="POST" action="{{ route('setup.store')}}" class="needs-validation" novalidate="">
        @csrf
        <div class="form-group">
          <div class="d-block">
              <label for="organization" class="control-label">Organization Code</label>
              <input id="organization" type="text" class="form-control" name="organization" autofocus="">
          </div>
          
          @error('organization')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          <div class="invalid-feedback">
            please fill in your password
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
            Setup
          </button>

        </div>
      </form>
    </div>
</div>
@endsection
