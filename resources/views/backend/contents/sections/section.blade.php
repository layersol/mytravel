@extends('backend.layouts.main')
@section('main-container')
  
  
  <div class="dashboard__main">
    <div class="dashboard__content bg-light-2">


        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
          <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Sections</h1>
            <div class="text-15 text-light-1">You can change frontend sections from here .</div>

          </div>

          <div class="col-auto">

          </div>
        </div>


        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              @foreach ($sections as $index => $section)
              <div class="col-auto">
                  <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button {{ $index === 0 ? 'is-tab-el-active' : '' }}" data-tab-target=".{{ $section['section_type'] }}">{{ $section['section_type'] }}</button>
              </div>
          @endforeach

            </div>

            <div class="tabs__content pt-30 js-tabs-content">

              @foreach ($sections as $index => $section)
              <div class="tabs__pane {{ $index === 0 ? 'is-tab-el-active' : '' }} {{ $section['section_type'] }}">
                  <div class="row y-gap-20">
                      <div class="col-12">
                          <div class="">
                              <!-- Add your section content here -->
                              <div class="d-flex justify-content-between">
                              <h2>{{ $section['section_heading'] }}</h2>

                              <div class="col-auto">

                                <a href="{{ route('/settings/section.edit',$section['id']) }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                  Edit  <i class="icon-edit text-16 text-white mx-1"> </i> 
                                </a>
                      
                              </div>

                             </div>
                              <p>{{ $section['short_title'] }}</p>
                              <hr>
                              <div class="d-flex col-lg-12 flex-wrap">
                              @foreach (json_decode($section['section_content'],true) as $point)
                              <div class="col-lg-4">

                                 <div class="w-200"> <img src="{{ asset('storage/images/sections/'.$point['image']) }}" alt="{{ $point['title'] }}" />
                                 </div>
                                  <h3 class="text-16">{{ $point['title'] }}</h3>
                                  @if (isset($point['description']))
                                      
                                  <p>{{ Str::words($point['description'], 10, '...')  }}</p>
                                  @endif

                                </div>
                              @endforeach
                            </div>
                              <!-- End of section content -->
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach


            </div>
          </div>

        </div>


  @endsection
