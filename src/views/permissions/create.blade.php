@extends(config('acl.layout'))

@section('heading')
<nav class="navbar navbar-expand-lg bg-white pl-4 text-danger justify-content-between" style="border-bottom: 1px solid #c8ced3">
  <h2>{{ trans('acl::global.create') }} {{ trans('acl::cruds.permission.title_singular') }}</h2>
  <a class="btn btn-outline-dark btn-lg" href="{{ route(config('acl.route.as') . 'permissions.index') }}">
    <i class="fa fa-chevron-left"></i> {{ trans('acl::global.back_to_list') }}
  </a>
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route(config('acl.route.as') . "permissions.store") }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label class="required" for="title">{{ trans('acl::cruds.permission.fields.title') }}</label>
        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
        @if($errors->has('title'))
          <div class="invalid-feedback">
            {{ $errors->first('title') }}
          </div>
        @endif
        <span class="help-block">{{ trans('acl::cruds.permission.fields.title_helper') }}</span>
      </div>
      <div class="form-group">
        <button class="btn btn-danger" type="submit">
          {{ trans('acl::global.save') }}
        </button>
      </div>
    </form>
  </div>
</div>
@endsection