@extends('layouts.app')

@section('content')
<div class="container">
<h1>{{__('acl.title')}}</h1>
<form action="" method="post" id="roleForm">
<div class="row">
<div class="card col px-5">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}" >
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ __('general.username').': '. $user->name }}</h4>
                @if(!empty($user->first_name))
            <h5 class="text-capitalize ">{{ $user->first_name.' '.$user->last_name}}</h5>
            @endif
            </div>           
          </div>
        </div>
                     </form>
                   </div>

                   <div class="row">
                        <div class="accordion" id="accordionExample">
                                <div class="card">
                                  <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Collapsible Group Item #1
                                      </button>
                                    </h2>
                                  </div>
                              
                                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                           
                                                    <div class="form-group">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="role1" name="role_admin" {{ $user->hasRole('admin') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="role1">
                                                      Administrador
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="role2" name="role_r4" {{ $user->hasRole('r4') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="role2">
                                                      Rojo 4
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="role3" name="role_r5" {{ $user->hasRole('r5') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="role3">
                                                      Rojo 5
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="role4" name="role_user" {{ $user->hasRole('usuario') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="role4">
                                                      Usuario
                                                    </label>
                                                  </div>
                                                </div>
                                                
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Collapsible Group Item #2
                                      </button>
                                    </h2>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Collapsible Group Item #3
                                      </button>
                                    </h2>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                              </div>
                  </div> 
                  </div>
@endsection