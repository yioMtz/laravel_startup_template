@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
    <h1>Usuarios</h1>
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
            <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CORREO_E</th>
                        <th>ROLES</th>
                        <th>ACCIONES</th>
                    </thead>
               <tbody>
                        @foreach($users as $user)
                         <?php  $roles= $user->getRoleNames(); ?>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($roles as $role)
                                    {{ $role.',' }}
                                @endforeach
                            </td>
                            <td>acciones</td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
            {{ $users->links() }}
          </div>
    </div>
  </div>
        
@endsection
