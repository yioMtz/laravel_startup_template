@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
    <h1>{{__('acl.list_of_permissions')}}</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="row my-2">
        <div class="col">
                <a class="btn btn-secondary mr-2 float-left" href="{{ route('admin.acl') }}"><i class="fas fa-chevron-left"></i> {{__('general.return')}}</a>
                <a class="btn btn-secondary ml-2 float-right primary-color" href="{{ route('newPermission') }}">{{__('acl.createPermission')}}</a>
        </div>
      </div>


        <div class="table-responsive">
            <caption>{{__('acl.list_of_roles')}}</caption>
            @if(!empty($permissions))
            <table class="table table-hover table-sm table-bordered bg-white">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('acl.permissionName')}}</th>
                    <th scope="col">{{__('general.description')}}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                  <tr >
                    <th scope="row" class="text-center">{{ $permission->id }}</th>
                    <td class="text-center">{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                  </tr>
                @endforeach
                </tbody>
            </table>
            @endif
          </div>
    </div>
  </div>
        
@endsection
