@extends(config('acl.layout'))

@section('heading')
<nav class="navbar navbar-expand-lg bg-white pl-4 text-danger justify-content-between" style="border-bottom: 1px solid #c8ced3">
  <h2>{{ trans('acl::cruds.permission.title_singular') }} {{ trans('acl::global.list') }}</h2>
  @can('permission_create')
  <a class="btn btn-danger btn-lg" href="{{ route(config('acl.route.as') . "permissions.create") }}">
    <i class="fa fa-plus-circle"></i> {{ trans('acl::global.add') }} {{ trans('acl::cruds.permission.title_singular') }}
  </a>
  @endcan
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover datatable datatable-Permission">
        <thead>
          <tr>
            <th width="10%"></th>
            <th width="10%">
              {{ trans('acl::cruds.permission.fields.id') }}
            </th>
            <th>
              {{ trans('acl::cruds.permission.fields.title') }}
            </th>
            <th width="10%">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach($permissions as $key => $permission)
            <tr data-entry-id="{{ $permission->id }}">
              <td></td>
              <td>
                {{ $permission->id ?? '' }}
              </td>
              <td>
                <span class="badge badge-info">{{ $permission->title ?? '' }}</span>
              </td>
              <td>
                @can('permission_show')
                <a class="btn btn-xs btn-primary" href="{{ route(config('acl.route.as') . 'permissions.show', $permission->id) }}" title="{{ trans('acl::global.view') }}">
                  <i class="fa fa-eye"></i>
                </a>
                @endcan

                @can('permission_edit')
                <a class="btn btn-xs btn-info" href="{{ route(config('acl.route.as') . 'permissions.edit', $permission->id) }}" title="{{ trans('acl::global.edit') }}">
                  <i class="fa fa-edit"></i>
                </a>
                @endcan

                @can('permission_delete')
                <form action="{{ route(config('acl.route.as') . 'permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('acl::global.areYouSure') }}');" style="display: inline-block;">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="submit" class="btn btn-xs btn-danger" title="{{ trans('acl::global.delete') }}">
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
  var table = $('.datatable-Permission:not(.ajaxTable)').DataTable({
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