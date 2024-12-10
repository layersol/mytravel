@extends('backend.layouts.main')
@section('main-container')
  
  
  <div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
      <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

          <h1 class="text-30 lh-14 fw-600">All Permission</h1>
          <div class="text-15 text-light-1">Find all permission here and count of users and roles having that permission.</div>

        </div>
        <div class="col-auto">

          <a href="{{route('RolesandPermissions/permissions.create')}}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
            Create New <div class="icon-plus ml-15"></div>
          </a>

        </div>
      </div>

      @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif
      <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
          <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

            <div class="col-auto">
              <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">All Permission</button>

            </div>


          </div>

          <div class="tabs__content pt-30 js-tabs-content">

            <div class="tabs__pane -tab-item-1 is-tab-el-active">
              <div class="overflow-scroll scroll-bar-1">
                <table class="table-3 -border-bottom col-12">
                  <thead class="bg-light-2">
                    <tr>
                      <th>Name</th>
                      <th>Guard Name</th>
                      <th>User's Count</th>
                      <th>Role's Count</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($permissions as $permissions)
                        
                    <tr>
                      <td>{{$permissions->name}}</td>
                      <td>{{$permissions->guard_name}}</td>
                      <td><span class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-blue-1-05 text-blue-1">{{$permissions->users_count}}</span></td>
                      <td><span class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-blue-1-05 text-blue-1">{{$permissions->roles_count}}</span></td>
                      <td>

                        <div class="col-auto">
                          <a href="{{route('RolesandPermissions/permissions.edit',$permissions->id)}}" class="bg-blue-1-05 text-blue-1">
                            <i class="icon-edit text-16 text-light-1"></i>
                          </a>

                           <a href="#" class="bg-red-3 text-red-2">
                            <i class="icon-trash-2 text-16 text-light-1"></i>
                           </a>
                        </div>

    
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>


          </div>
        </div>

      </div>


  @endsection
