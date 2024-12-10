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

            <h1 class="text-30 lh-14 fw-600">About Page</h1>
            <div class="text-15 text-light-1">You can make changes to about page from here.</div>

          </div>

        </div>
        
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls d-flex justify-content-between">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">About Page</button>
              </div>
            </div>
                    <form method="post" action="{{route('/settings/pages/aboutPage.update',$about[0]['id'])}}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
            
                        <div class="tabs__content pt-30 js-tabs-content">
                            <div class="tabs__pane -tab-item-1 is-tab-el-active">
            
            
                                 <div class="text-15 text-light-1">About page settings :</div>

                                    <div class="row y-gap-30 items-center">
                                      
                                        <div class="col-md-8">
                                            <div class="d-flex">
                                                <img src="{{asset('storage/images/pages/'.$about[0]['image'])}}" alt="image" class=" rounded-4" id="image_1" style="width: 33em;height:15em">
                                            </div>
                                        </div>
            
                                        <div class="col-md-4">
                                            <h4 class="text-16 fw-500">Logo Image</h4>
                                            <div class="text-14 mt-5">PNG or JPG Svg.</div>
                                            <div class="d-inline-block mt-15">
                                                <input type="file" name="image" class="button -dark-1 bg-blue-1 text-white" style="padding: 10px" onchange="readURL(this);" data-image-container="image_1">
                                                <label class="image_error"></label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('image')" />

                                        </div>
            
                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <x-text-input name="title" type="text" value="{{$about[0]['title']}}" />
                                                <label class="lh-1 text-16 text-light-1">Page Title</label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />

                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-input">
                                                <textarea required="" rows="5" name="text">{{$about[0]['text']}}</textarea>
                                                <label class="lh-1 text-16 text-light-1">Text</label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('text')" />

                                        </div>
                                 
                                    </div>
                                <div class="border-top-light mt-30 mb-30"></div>

                            </div>
                        </div>
            
                        <div class="d-inline-block pt-30">
                            <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                Save <div class="icon-arrow-top-right ml-15"></div>
                            </button>
                        </div>
                    </form>
          </div>
          <hr>

        </div>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var imageContainerId = $(input).data('image-container'); // Get the ID of the image container
                        $('#' + imageContainerId).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

  @endsection
     