@extends('acl::layout')

@section('heading')
<nav class="navbar navbar-expand-lg bg-white pl-4 text-danger justify-content-between" style="border-bottom: 1px solid #c8ced3">
  <h2>{{ trans('acl::global.show') }} {{ trans('acl::cruds.permission.title') }}</h2>
  <a class="btn btn-outline-dark btn-lg" href="{{ route(config('acl.route.as') . 'permissions.index') }}">
    <i class="fa fa-chevron-left"></i> {{ trans('acl::global.back_to_list') }}
  </a>
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <th>
            {{ trans('acl::cruds.permission.fields.id') }}
          </th>
          <td>
            {{ $permission->id }}
          </td>
        </tr>
        <tr>
          <th>
            {{ trans('acl::cruds.permission.fields.title') }}
          </th>
          <td>
            {{ $permission->title }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



@endsection