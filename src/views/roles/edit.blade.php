@extends('acl::layout')

@section('heading')
<nav class="navbar navbar-expand-lg bg-white pl-4 text-danger justify-content-between" style="border-bottom: 1px solid #c8ced3">
  <h2>{{ trans('acl::global.edit') }} {{ trans('acl::cruds.role.title_singular') }}</h2>
  <a class="btn btn-outline-dark btn-lg" href="{{ route(config('acl.route.as') . 'roles.index') }}">
    <i class="fa fa-chevron-left"></i> {{ trans('acl::global.back_to_list') }}
  </a>
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route(config('acl.route.as') . "roles.update", [$role->id]) }}" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label class="required" for="title">{{ trans('acl::cruds.role.fields.title') }}</label>
        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
        @if($errors->has('title'))
          <div class="invalid-feedback">
            {{ $errors->first('title') }}
          </div>
        @endif
        <span class="help-block">{{ trans('acl::cruds.role.fields.title_helper') }}</span>
      </div>
      <div class="form-group">
        <label class="required" for="permissions">{{ trans('acl::cruds.role.fields.permissions') }}</label>
        <div style="padding-bottom: 4px">
          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('acl::global.select_all') }}</span>
          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('acl::global.deselect_all') }}</span>
        </div>
        <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
          @foreach($permissions as $id => $permissions)
            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
          @endforeach
        </select>
        @if($errors->has('permissions'))
          <div class="invalid-feedback">
            {{ $errors->first('permissions') }}
          </div>
        @endif
        <span class="help-block">{{ trans('acl::cruds.role.fields.permissions_helper') }}</span>
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