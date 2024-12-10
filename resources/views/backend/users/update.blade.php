@extends('backend.layouts.main')
@section('main-container')
    <style>
      .input_select{
          border: 1px solid var(--color-border);
      border-radius: 4px;
      padding: 0 15px;
      padding-top: 25px;
      min-height: 70px;
      transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
      }
      .image_error p{
          color: red;
      }
    </style>
  <div class="dashboard__main">
      <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
          <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Update User</h1>
            <div class="text-15 text-light-1">You can update user from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Personal Information</button>
              </div>
              
                    </div>
                <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data" action="POST">
                  @csrf
                  @method('PUT')
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">
                <div class="row y-gap-30 items-center">
                  <div class="col-auto">
                    <div class="d-flex ratio ratio-1:1 w-200">
                      <img src="{{ asset('storage/images/users/' . $user->image) }}" alt="image" class="img-ratio rounded-4" id="db_user_image_upload">

                    </div>
                  </div>
   
                  <div class="col-auto">
                    <h4 class="text-16 fw-500">User Picture</h4>
                    <div class="text-14 mt-5">PNG or JPG no bigger than 800px wide and tall.</div>

                    <div class="d-inline-block mt-15">
                     
                        <input type="file" name="image" class="button -dark-1 bg-blue-1 text-white" style="padding: 10px"  onchange="readURL(this);">
                       <label class="image_error"></label>
                    </div>
                  </div>
                  <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>

                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-9">
                  <div class="row x-gap-20 y-gap-20">
                    <div class="col-12">

                      <div class="form-input ">
                        <select name="role" class="input_select" required="">
                          @foreach ($user->roles as $role)
                          <option value="{{$role->name}}" selected>{{$role->name}}</option>
                              
                           @endforeach
                          <option value=""></option>
                          @foreach ($roles as $role)
                           <option value="{{$role->name}}">{{$role->name}}</option>
                              
                          @endforeach
                        </select>
                        <label class="lh-1 text-16 text-light-1">Select role to assign user</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('role')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input">
                        <x-text-input id="name" name="name" type="text" :value="old('name',$user['name'])" required/>
                        <label class="lh-1 text-16 text-light-1">Full Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('name')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="email" name="email" type="email" :value="old('email',$user['email'])" required/>
                        <label class="lh-1 text-16 text-light-1">Email</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="mobile" name="mobile" type="number" :value="old('mobile',$user['mobile'])"/>
                        <label class="lh-1 text-16 text-light-1">Phone Number</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('mobile')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="password" name="password" type="password" :value="old('password')" />
                        <label class="lh-1 text-16 text-light-1">Set Password</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('password')" />

                    </div>
                    <div class="col-12">

                      <div class="form-input ">
                        <x-text-input id="address" name="address" type="address" :value="old('address',$user['address'])"/>
                        <label class="lh-1 text-16 text-light-1">Address</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('address')" />

                    </div>
                    <div class="col-12">

                        <div class="form-input ">
                        <select name="status" class="input_select" required="">

                        <option value="active" {{$user['status']=='active' ? 'selected': ''}}>Active</option>
                        <option value="inactive" {{$user['status']=='inactive' ? 'selected': ''}}>Inactive</option>
                       
                        </select>
                        <label class="lh-1 text-16 text-light-1">Select Status</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />

                        </div>
                  </div>
                </div>

                <div class="d-inline-block pt-30">

                  <button href="#" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    Save <div class="icon-arrow-top-right ml-15"></div>
                  </button>

                </div>
                
              </div>
              

            </div>
            </form>
          </div>
            <hr>
          <div class="col-12">
            <div class="row ">
              <form method="POST" action="{{ route('assignRevokePermissionUser',$user->id) }}" >
                @csrf
              <div class="col-auto">
                <div class="text-16 lh-12 text-dark-1 fw-500 mb-30 mt-10">Permissions this user have</div>
                @foreach ($permissions as $permission)
                    
                <div class="form-switch d-inline-flex items-center">
                  <div class="switch">
                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <span class="switch__slider"></span>
                  </div>
                  <div class="text-13 lh-1 text-dark-1 ml-10">{{$permission->name}}</div>
                </div>
                 @endforeach
              </div>
                <div class="d-inline-block pt-30">

                <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                  Assign/Revoke <div class="icon-arrow-top-right ml-15"></div>
                </button>

              </div>
              </form>
            </div>
          </div>

        </div>
        <script type="text/javascript">
          function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
      
                  reader.onload = function (e) {
                      $('#db_user_image_upload').attr('src', e.target.result);
                  }
      
                  reader.readAsDataURL(input.files[0]);
              }
          }
        </script>

  @endsection
     