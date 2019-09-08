@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('setPermissionsToRole') }}" method="post">
        @csrf
        <input type="hidden" name="role_id" value="{{ $role->id }}" >
<h1>{{__('acl.manageAssignPermissions')}}</h1>

<div class="row my-2">
  <div class="col">
          <a class="btn btn-secondary mr-2 float-left" href="{{ route('manageRoles') }}"><i class="fas fa-chevron-left"></i> {{__('general.return')}}</a>
          <button class="btn btn-success float-right" type="submit">
            {{ __('general.save') }}
       </button>
        </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col">       
          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{  $role->name }}</h4>
                </div>  
                  <P>
                    {{ __('acl.assign_permissions_to_role_text') }}
                  <p>        
              </div>
          </div>
        </div>
  </div>
<div class="row">
<div class="accordion col mt-3" id="accordionExample">

    <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-key"></i> {{ __('acl.permissions') }}
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body grid-permissions">
                @if(!empty($permissions))
                @foreach ($permissions as $permission)
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="permissions[{{ $permission->name }}]" value={{ $permission->name }} id="permission{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                  </div>
                @endforeach
                @endif
            </div>
          </div>
        </div>
</div>
</div> 
</form>
</div>
@endsection