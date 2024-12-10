@extends('backend.layouts.main')
@section('main-container')
  
  <div class="dashboard__main">
      <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
          <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Add Permission</h1>
            <div class="text-15 text-light-1">Add new permission from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>

        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Permission Information</button>
              </div>

    
            </div>
<!-- form starting from here -->
            <form action="{{route('RolesandPermissions/permissions.store')}}" method="post">
                @csrf
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">
              
                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-9">
                  <div class="row x-gap-20 y-gap-20">
                    <div class="col-12">

                        <div class="form-input ">
                            <x-text-input id="name" type="text" name="name" :value="old('name')" required autocomplete="name"/>
                          <label class="lh-1 text-16 text-light-1">Permission Name</label>
                        </div>
                         <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        
                      </div>
                </div>

                <div class="d-inline-block pt-30">

                  <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    Add <div class="icon-arrow-top-right ml-15"></div>
                  </button>

                </div>
                
              </div>
              

            </div>
            </form>
          </div>
        </div>
      </div>

  @endsection
     