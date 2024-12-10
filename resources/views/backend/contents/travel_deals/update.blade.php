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

            <h1 class="text-30 lh-14 fw-600">Update Deal</h1>
            <div class="text-15 text-light-1">You can update deal from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>

        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Deal Information</button>
              </div>

                    </div>
               <form action="{{route('travel-deals.update',$deal->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">
                
                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-12">
                  <div class="row x-gap-20 y-gap-20">

                    <div class="col-md-6">

                      <div class="form-input">
                        <x-text-input id="airport_name" name="airport_name" type="text" :value="old('airport_name',$deal->airport_name)" required/>
                        <label class="lh-1 text-16 text-light-1">Airport Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('airport_name')" />

                    </div>
                    <div class="col-md-4">

                      <div class="form-input">
                        <x-text-input id="area_name" name="area_name" type="text" :value="old('area_name',$deal->area_name)" required/>
                        <label class="lh-1 text-16 text-light-1">City Or Country Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('area_name')" />

                    </div>

                    <div class="col-md-2">

                      <div class="form-input ">
                        <x-text-input id="iata_code" name="iata_code" type="text" :value="old('iata_code',$deal->iata_code)" required/>
                        <label class="lh-1 text-16 text-light-1">Iata Code</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('iata_code')" />

                    </div>

                    <div class="col-md-4">

                      <div class="form-input ">
                        <x-text-input id="starting_price" name="starting_price" type="text" :value="old('starting_price',$deal->starting_price)" required/>
                        <label class="lh-1 text-16 text-light-1">Starting Price</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('starting_price')" />

                    </div>

                    <div class="col-md-4">

                      <div class="form-input ">
                        <x-text-input id="currency" name="currency" type="text" :value="old('currency',$deal->currency)" required/>
                        <label class="lh-1 text-16 text-light-1">Currency Eg:USD</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('currency')" />

                    </div>

                    <div class="col-4">

                        <div class="form-input ">
                        <select name="status" class="input_select" required="">

                        <option value="active" {{ $deal->status=='active'?'selected': '' }}>Active</option>
                        <option value="inactive" {{ $deal->status=='inactive'?'selected': '' }}>Inactive</option>
                       
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
     