@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
    <h1>{{__('acl.list_of_roles')}}</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="row my-2">
        <div class="col">
                <a class="btn btn-secondary mr-2 float-left" href="{{ route('admin.acl') }}"><i class="fas fa-chevron-left"></i> {{__('general.return')}}</a>
                <a class="btn btn-secondary ml-2 float-right primary-color" href="{{ route('newRole') }}">{{__('acl.createRole')}}</a>
        </div>
      </div>


        <div class="table-responsive">
            <caption>{{__('acl.list_of_roles')}}</caption>
            @if(!empty($roles))
            <table class="table table-hover table-sm table-bordered bg-white">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('acl.rolename')}}</th>
                    <th scope="col">{{__('acl.permissions')}}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                  <tr >
                    <th scope="row" class="text-center">{{ $role->id }}</th>
                    <td class="text-center">{{ $role->name }}</td>
                    <td class="text-center">
                      <a type="button" class="btn btn-info text-white">{{__('acl.manageAssignPermissions')}}</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
            @endif
          </div>
    </div>
  </div>
        
@endsection
