@extends('acl::layout')

@section('heading')
<nav class="navbar navbar-expand-lg bg-white pl-4 text-danger justify-content-between" style="border-bottom: 1px solid #c8ced3">
  <h2>{{ trans('acl::cruds.role.title_singular') }} {{ trans('acl::global.list') }}</h2>
  @can('role_create')
  <a class="btn btn-danger btn-lg" href="{{ route(config('acl.route.as') . "roles.create") }}">
    <i class="fa fa-plus-circle"></i> {{ trans('acl::global.add') }} {{ trans('acl::cruds.role.title_singular') }}
  </a>
  @endcan
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover datatable datatable-Role">
        <thead>
          <tr>
            <th width="10%"></th>
            <th>
                {{ trans('acl::cruds.role.fields.id') }}
            </th>
            <th>
                {{ trans('acl::cruds.role.fields.title') }}
            </th>
            <th>
                {{ trans('acl::cruds.role.fields.permissions') }}
            </th>
            <th width="10%">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $key => $role)
          <tr data-entry-id="{{ $role->id }}">
            <td></td>
            <td>
              {{ $role->id ?? '' }}
            </td>
            <td>
              {{ $role->title ?? '' }}
            </td>
            <td>
              @foreach($role->permissions as $key => $item)
                <span class="badge badge-info">{{ $item->title }}</span>
              @endforeach
            </td>
            <td align="right">
              @can('role_show')
              <a class="btn btn-sm btn-outline-primary" href="{{ route(config('acl.route.as') . 'roles.show', $role->id) }}" title="{{ trans('acl::global.view') }}">
                <i class="fa fa-eye"></i>
              </a>
              @endcan

              @can('role_edit')
              <a class="btn btn-sm btn-outline-info" href="{{ route(config('acl.route.as') . 'roles.edit', $role->id) }}" title="{{ trans('acl::global.edit') }}">
                <i class="fa fa-edit"></i>
              </a>
              @endcan

              @can('role_delete')
              <form action="{{ route(config('acl.route.as') . 'roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('acl::global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ trans('acl::global.delete') }}">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')
@parent
<script>
  $(function () {
    $.extend(true, $.fn.dataTable.defaults, {
      pageLength: 100,
    });
    var table = $('.datatable-Role:not(.ajaxTable)').DataTable({
      dom: 'ftip'
    })
    table.columns([0]).visible(false)
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
    });
  })

</script>
@endsection