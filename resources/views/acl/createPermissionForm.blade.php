@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm col-md-6">
    <h1>{{__('acl.createPermission')}}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('createPermission') }}">
        @csrf
            <div class="form-group">
              <label for="permissionName">{{__('acl.permissionName')}}</label>
              <input type="text" class="form-control" id="name" name="name">

              <label for="permissionDesc">{{__('general.description')}}</label>
              <textarea class="form-control" id="description" name="description" rows="10"> </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="{{ route('managePermissions')}}">{{__('general.cancel')}}</a>
    </form>
    </div>
  </div>
         
@endsection
