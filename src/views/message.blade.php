@if(session('message'))
<div class="row mb-2">
  <div class="col-lg-12">
    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
  </div>
</div>
@endif
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif