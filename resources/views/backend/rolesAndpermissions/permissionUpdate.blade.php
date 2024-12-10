@extends('backend.layouts.main')
@section('title', 'Permission-update')

@section('main-container')
  
  <div class="dashboard__main">
      <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
          <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">All Permission</h1>
            <div class="text-15 text-light-1">update permission from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>
        
        <div class="col-12">
          <div class="px-24 py-20 rounded-4 bg-red-1">
            <div class="row x-gap-20 y-gap-20 items-center">
              <div class="col-auto">
                <div class="flex-center size-60 rounded-full bg-white">
                  <i class="icon-star text-yellow-1 text-30"></i>
                </div>
              </div>

              <div class="col-auto">
                <h4 class="text-18 lh-15 fw-500 text-white">Be Carefull.!</h4>
                <div class="text-15 lh-15 text-white">Changing the name may disturb the site do it only when necessary.</div>
              </div>
            </div>
          </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
        @endif
        <div class="py-30 px-30 rounded-4 bg-white shadow-3 mt-2">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Permission Information</button>
              </div>
            </div>


            <form action="{{ route('RolesandPermissions/permission.Update',$permission->id) }}" method="post">
                @csrf
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">
              
                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-9">
                  <div class="row x-gap-20 y-gap-20">
                    <div class="col-12">

                        <div class="form-input ">
                            <x-text-input id="name" type="text" name="name"  :value="old('name',$permission->name)" required autocomplete="name"/>
                          <label class="lh-1 text-16 text-light-1">Permission Name</label>
                        </div>
                         <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        
                      </div>
                </div>

                <div class="d-inline-block pt-30">

                  <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    Update <div class="icon-arrow-top-right ml-15"></div>
                  </button>

                </div>
                
              </div>
              

            </div>
            </form>
          </div>

          <div class="col-12">
            <div class="row ">
              <form method="POST" action="{{ route('assignRevokePermission',$permission->id) }}" >
                @csrf
              <div class="col-auto">
                <div class="text-16 lh-12 text-dark-1 fw-500 mb-30 mt-10">Assign/Revoke this permission from users</div>
                @foreach ($users as $user)
                    
                <div class="form-switch d-inline-flex items-center">
                  <div class="switch">
                    <input type="checkbox" name="users[]" value="{{$user->id}}" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <span class="switch__slider"></span>
                  </div>
                  <div class="text-13 lh-1 text-dark-1 ml-10">{{$user->name}}</div>
                </div>
                 @endforeach
              </div>
              <hr>
              <div class="col-auto">
                <div class="text-16 lh-12 text-dark-1 fw-500 mb-30 mt-10">Assign/Revoke this permission from roles</div>
              @foreach ($roles as $role)
                    
              <div class="form-switch d-inline-flex items-center">
                <div class="switch">
                  <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                  <span class="switch__slider"></span>
                </div>
                <div class="text-13 lh-1 text-dark-1 ml-10">{{$role->name}}</div>
              </div>
               @endforeach
                <div class="d-block-block pt-30">

                <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                  Assign/Revoke <div class="icon-arrow-top-right ml-15"></div>
                </button>

              </div>
              </form>
            </div>
          </div>
  
        </div>
      </div>

  @endsection
     