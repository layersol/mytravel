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

            <h1 class="text-30 lh-14 fw-600">Add Airport</h1>
            <div class="text-15 text-light-1">You can create new airport data from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>

        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Airport Information</button>
              </div>

                    </div>
               <form action="{{route('airports.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">
              

                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-12">
                  <div class="row x-gap-20 y-gap-20">

                    <div class="col-md-9">

                      <div class="form-input">
                        <x-text-input id="name" name="name" type="text" :value="old('name')" required/>
                        <label class="lh-1 text-16 text-light-1">Airport Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('name')" />

                    </div>
                    <div class="col-md-3">

                        <div class="form-input">
                          <x-text-input id="iata" name="iata" type="text" :value="old('iata')" required/>
                          <label class="lh-1 text-16 text-light-1">Iata Code</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('iata')" />
  
                      </div>

                      <div class="col-lg-8">

                        <div class="select js-select js-liveSearch" data-select-value="">
                          <button class="select__button js-button" type="button">
                            <span class="js-button-title text-light-1">Select Country</span>
                            <input type="hidden" name="country" class="countryname" value="{{ old('country') }}">
                            <i class="select__icon" data-feather="chevron-down"></i>
                          </button>
            
                          <div class="select__dropdown js-dropdown">
                            <input type="text" placeholder="Search" class="select__search js-search">
                          
                            <div class="select__options js-options">
                                @foreach ($countries as $country)
                                    
                              <div class="select__options__button" data-value="{{ strtolower($country->name) }}">{{ $country->name }}</div>

                              @endforeach
                                
                            </div>
                          </div>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('city')" />

                      </div>
                      <div class="col-md-4">

                        <div class="form-input">
                          <x-text-input id="city" name="city" type="text" :value="old('city')" required/>
                          <label class="lh-1 text-16 text-light-1">City Name</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
  
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
     