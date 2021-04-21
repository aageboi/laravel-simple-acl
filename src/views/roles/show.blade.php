@extends(config('acl.layout'))

@section('heading')
<nav class="navbar navbar-expand-lg bg-white pl-4 text-danger justify-content-between" style="border-bottom: 1px solid #c8ced3">
  <h2>{{ trans('acl::global.show') }} {{ trans('acl::cruds.role.title') }}</h2>
  <a class="btn btn-outline-dark btn-lg" href="{{ route(config('acl.route.as') . 'roles.index') }}">
    <i class="fa fa-chevron-left"></i> {{ trans('acl::global.back_to_list') }}
  </a>
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="form-group">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th>
              {{ trans('acl::cruds.role.fields.id') }}
            </th>
            <td>
              {{ $role->id }}
            </td>
          </tr>
          <tr>
            <th>
              {{ trans('acl::cruds.role.fields.title') }}
            </th>
            <td>
              {{ $role->title }}
            </td>
          </tr>
          <tr>
            <th>
              {{ trans('acl::cruds.role.fields.permissions') }}
            </th>
            <td>
              @foreach($role->permissions as $key => $permissions)
                <span class="badge badge-info">{{ $permissions->title }}</span>
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>



@endsection