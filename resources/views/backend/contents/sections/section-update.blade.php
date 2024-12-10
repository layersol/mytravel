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

            <h1 class="text-30 lh-14 fw-600">Section Details</h1>
            <div class="text-15 text-light-1">You can make changes to section from here.</div>

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
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">{{$section['section_type']}}</button>
              </div>
              <div class="col-auto">

                <a href="{{ route('/settings/section.add',$section['id']) }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                  New  <i class="icon-plus text-16 text-white mx-1"> </i> 
                </a>
      
              </div>
            </div>
                    <form method="post" action="{{ route('/settings/section.update', $section['id']) }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
            
                        <div class="tabs__content pt-30 js-tabs-content">
                            <div class="tabs__pane -tab-item-1 is-tab-el-active">
                                <div class="col-xl-12">
                                    <div class="row x-gap-20 y-gap-20">
            
                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <x-text-input id="section_heading" name="section_heading" type="text" :value="old('section_heading', $section['section_heading'])" required/>
                                                <label class="lh-1 text-16 text-light-1">Heading</label>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('section_heading')" />
                                        </div>
            
                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <x-text-input id="short_title" name="short_title" type="text" :value="old('short_title', $section['short_title'])"/>
                                                <label class="lh-1 text-16 text-light-1">Short Title</label>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('short_title')" />
                                        </div>
            
                                    </div>
                                </div>
            
                                <div class="border-top-light mt-30 mb-30"></div>
            
                                @foreach (json_decode($section['section_content'], true) as $key => $item)
                                <div class="d-flex justify-content-between">
                                 <div class="text-15 text-light-1">Section content point : {{$key+1}}</div>

                                 <div class="col-auto">

                                    <a href="{{ route('/section.removeContent', [$section['id'], $key]) }}"><i class="icon-trash-2 text-16 text-light-1"></i></a>

                                  </div>
                                </div>

                                    <div class="row y-gap-30 items-center">
                                      
                                        <div class="col-md-2">
                                            <div class="d-flex ratio ratio-1:1 w-200">
                                                <img src="{{ asset('storage/images/sections/'.$item['image']) }}" alt="image" class="img-ratio rounded-4" id="image_{{$key+1}}">
                                            </div>
                                        </div>
            
                                        <div class="col-md-4">
                                            <h4 class="text-16 fw-500">Content Picture</h4>
                                            <div class="text-14 mt-5">PNG or JPG Svg.</div>
                                            <div class="d-inline-block mt-15">
                                                <input type="file" name="image{{ $key }}" class="button -dark-1 bg-blue-1 text-white" style="padding: 10px" onchange="readURL(this);" data-image-container="image_{{$key+1}}">
                                                <label class="image_error"></label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('image'.$key)" />

                                        </div>
            
                                        <div class="col-md-5">
                                            <div class="form-input">
                                                <textarea required="" rows="5" name="title{{ $key }}">{{ $item['title'] }}</textarea>
                                                <label class="lh-1 text-16 text-light-1">Title</label>
                                            </div>
                                        </div>
                                        @if (isset($item['price']) && $item['price']!='')
                                            
                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <x-text-input name="price{{ $key }}" type="text" value="{{$item['price']}}" />
                                                <label class="lh-1 text-16 text-light-1">Price</label>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('price'.$key)" />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <x-text-input name="from{{ $key }}" type="text" value="{{$item['from']}}" />
                                                <label class="lh-1 text-16 text-light-1">From(iata code)</label>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('from'.$key)" />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <x-text-input name="to{{ $key }}" type="text" value="{{$item['to']}}" />
                                                <label class="lh-1 text-16 text-light-1">To(iata code)</label>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('to'.$key)" />
                                        </div>
                                        @endif
                                         @if (!isset($item['price']) || $item['price']=='')
                                        <div class="col-md-12">
                                            <div class="form-input">
                                                <textarea  rows="3" name="description{{ $key }}">{{ $item['description'] }}</textarea>
                                                <label class="lh-1 text-16 text-light-1">Description</label>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                <div class="border-top-light mt-30 mb-30"></div>

                                @endforeach
                            </div>
                        </div>
            
                        <div class="d-inline-block pt-30">
                            <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white" type="submit">
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
     