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

            <h1 class="text-30 lh-14 fw-600">Add Testimonial</h1>
            <div class="text-15 text-light-1">You can create new testimonial from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>

        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Testimonial Information</button>
              </div>

                    </div>
               <form action="{{route('testimonials.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">
                <div class="row y-gap-30 items-center">
                  <div class="col-auto">
                    <div class="d-flex ratio ratio-1:1 w-200">
                      <img src="" alt="image" class="img-ratio rounded-4" id="db_user_image_upload">

                    </div>
                  </div>
   
                  <div class="col-auto">
                    <h4 class="text-16 fw-500">User Picture</h4>
                    <div class="text-14 mt-5">PNG or JPG.</div>

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

                    <div class="col-md-6">

                      <div class="form-input">
                        <x-text-input id="name" name="name" type="text" :value="old('name')" required/>
                        <label class="lh-1 text-16 text-light-1">Full Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('name')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="designation" name="designation" type="text" :value="old('designation')" required/>
                        <label class="lh-1 text-16 text-light-1">Designation</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('designation')" />

                    </div>

                    <div class="col-12">

                        <div class="form-input ">
                        <select name="status" class="input_select" required="">

                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                       
                        </select>
                        <label class="lh-1 text-16 text-light-1">Select Status</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />

                        </div>
                        <div class="col-12">

                            <div class="form-input ">
                              <x-text-input id="text" name="text" type="text" :value="old('text')"/>
                              <label class="lh-1 text-16 text-light-1">Text</label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('text')" />
      
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
     