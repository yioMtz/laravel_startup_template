@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm col-md-6">
    <h1>{{__('acl.createRole')}}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('createRole') }}">
        @csrf
            <div class="form-group">
              <label for="roleName">{{__('acl.rolename')}}</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
        <a class="btn btn-danger" href="{{ route('manageRoles')}}">{{__('general.cancel')}}</a>
    </form>
    </div>
  </div>
         
@endsection
