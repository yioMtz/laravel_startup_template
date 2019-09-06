@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
    <h1>{{__('acl.acl_title')}}</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="row my-2">
        <div class="col">
          <a class="btn btn-secondary mr-2" href="{{ route('manageRoles') }}">{{__('acl.rolesBtn')}}</a>
          <a class="btn btn-secondary" href="{{ route('managePermissions') }}">{{__('acl.permissionsBtn')}}</a>
        </div>
      </div>


        <div class="table-responsive">
            <caption>{{__('acl.list_of_users')}}</caption>
            <table class="table table-hover table-sm table-bordered bg-white">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('general.name')}}</th>
                    <th scope="col">{{__('general.email')}}</th>
                    <th scope="col">{{__('general.actions')}}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                  <tr >
                    <th scope="row" class="text-center">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                    <a href="{{ URL::route('edit.permissions', array('id' => $user->id)) }}"  class="btn btn-info text-white">{{__('acl.editRoles')}}</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
          </div>
    </div>
  </div>
        
@endsection
