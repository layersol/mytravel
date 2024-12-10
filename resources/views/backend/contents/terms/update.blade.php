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

            <h1 class="text-30 lh-14 fw-600">Edit Term</h1>
            <div class="text-15 text-light-1">You can edit term from here.</div>

          </div>

          <div class="col-auto">

          </div>
        </div>

        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Term Information</button>
              </div>

                    </div>
                    <form action="{{ route('/settings/terms.update', $term['id']) }}" method="post">
                      @csrf
                  
                      <div class="tabs__content pt-30 js-tabs-content">
                          <div class="tabs__pane -tab-item-1 is-tab-el-active">
                  
                              <div class="col-xl-12">
                                  <div class="row x-gap-20 y-gap-20">
                  
                                      <div class="col-md-12">
                  
                                          <div class="form-input">
                                              <x-text-input id="title" name="title" type="text" :value="old('title', $term['title'])" />
                                              <label class="lh-1 text-16 text-light-1">Title</label>
                                          </div>
                                          <x-input-error class="mt-2" :messages="$errors->get('title')" />
                  
                                      </div>
                                      <div class="col-md-12">
                                          @foreach (json_decode($term['points'],true) as $key => $point)
                                      <div class="text-15 text-light-1">Point: {{$key+1}}</div>

                                          <div class="form-input">
                                              <input type="text" name="points[{{$key}}][heading]" value="{{ $point['heading'] }}" />
                                              <label class="lh-1 text-16 text-light-1">Heading</label>
                                          </div>
                                          <x-input-error class="mt-2" :messages="$errors->get('points.'.$key.'.heading')" />
                  
                                          <div class="form-input mt-2">
                                              <textarea rows="6" name="points[{{$key}}][description]">{{ $point['description'] }}</textarea>
                                              <label class="lh-1 text-16 text-light-1">Description</label>
                                          </div>
                                          <x-input-error class="mt-2" :messages="$errors->get('points.'.$key.'.description')" />
                                          @endforeach
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

  @endsection
     