@include('frontend.layouts.header-search')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
  <style>
    .noUi-connect {
      background: #ffc107 !important;
    }

    .noUi-handle {
      border-radius: 50%;
      /* background: #297cbb !important; */
    }
    .noUi-horizontal .noUi-handle{
        width: 24px !important;
        height: 24px !important;
    }
    @media (max-width: 770px) {
  .justify-content-center-sm {
    justify-content: center !important; 
  }
 }
 .airline-image{
    mix-blend-mode: multiply;
 }
 @media (max-width: 770px) {
  .airline-image {
    max-width:3rem !important; 
  }
 }
 @media (min-width: 770px) {
  .airline-image {
    max-width:3rem !important; 
  }
 }

  </style>
 <!-- ========== MAIN CONTENT ========== -->
 <main id="content" role="main" style="background-color: #1a0b24">
    <div class="bg-gray-33 py-1">
        <div class="container">
           <div class="navbar-expand-xl navbar-expand-xl-collapse-block">
                <button class="btn d-xl-none mb-5 p-0 collapsed  " type="button" data-toggle="collapse" data-target="#sidebar-search" aria-controls="sidebar-search" aria-expanded="false" aria-label="Toggle navigation" >
                    <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i>
                    <span class="text-primary ml-2">Modify Search</span>
                </button>
          <div id="sidebar-search" class="collapse navbar-collapse">
            <div class="border-0">
                <div class="card-body">
                    <ul class="nav tab-nav tab-nav-inner flex-nowrap pb-4 px-lg-3 px-2 pb-xl-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium {{ request('return_date') !='' ?'active' : '' }}" id="pills-one-example2-tab" data-toggle="pill" href="#pills-one-example2" role="tab" aria-controls="pills-one-example2" aria-selected="true" onclick="updateDatePicker('range')">
                                <div class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                    <span class="tabtext mt-2 mt-md-0 font-size-12 font-weight-semi-bold">ROUND-TRIP</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link font-weight-medium {{ request('return_date') =='' ?'active' : '' }}" id="pills-two-example2-tab" data-toggle="pill" href="#pills-two-example2" role="tab" aria-controls="pills-two-example2" aria-selected="true" onclick="updateDatePicker('single')">
                                <div class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                    <span class="tabtext mt-2 mt-md-0 font-size-12 font-weight-semi-bold">ONE-WAY</span>
                                </div>
                            </a>
                        </li>
                    
                        
                    </ul>

                    <form class="" action="{{ route('flight-list') }}">
                        <input type="hidden" name="departure_code" id="departure_code" value="{{ request('departure_code') }}">
                        <input type="hidden" name="arrival_code" id="arrival_code" value="{{ request('arrival_code') }}">
                      <div class="row nav-select d-block d-lg-flex mb-lg-2 px-lg-3 px-2">
                        <div class="col-sm-12 {{ request('return_date') =='' ?'col-lg-3' : 'col-lg-2dot3' }} change-col mb-4 mb-lg-0 ">
                            <!-- Input -->
                            <span class="d-block text-gray-1 text-left font-weight-normal mb-0">From where</span>
                            <div class="js-focus-state">
                                <div class="input-group border-bottom border-width-2 border-color-1">
                                    <i class="flaticon-pin-1 d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                  <input type="text" class="form-control font-size-lg-16 shadow-none hero-form font-weight-normal border-0 pl-0 search-input bg-transparent form-inputs" placeholder="city or airport" aria-label="Keyword or title" id="departure" name="departure_full" autocomplete="off" value="{{ request('departure_full') }}" onclick="this.value=''" oninput="moveToNextInput(this)">
                                </div>
                            </div>
                            <!-- End Input -->
                        </div>
                        <div class="col-sm-12 {{ request('return_date') =='' ?'col-lg-3' : 'col-lg-2dot3' }} change-col mb-4 mb-lg-0 ">
                            <!-- Input -->
                            <span class="d-block text-gray-1 text-left font-weight-normal mb-0">To where</span>
                            <div class="js-focus-state">
                                <div class="input-group border-bottom border-width-2 border-color-1">
                                    <i class="flaticon-pin-1 d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                  <input type="text" class="form-control font-size-lg-16 shadow-none hero-form font-weight-normal border-0 pl-0 search-input bg-transparent form-inputs" placeholder="city or airport" aria-label="Keyword or title" id="arrival" name="arrival_full" autocomplete="off" value="{{ request('arrival_full') }}"  onclick="this.value=''" oninput="moveToNextInput(this)">
                                </div>
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-sm-12 col-lg-2dot3 mb-4 mb-lg-0 " id="departure-date">
                            <!-- Input -->
                            <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Depart-Date</span>
                            <div class="border-bottom border-width-2 border-color-1">
                                <div id="datepickerWrapperFromOne" class="u-datepicker input-group">
                                    <div class="input-group-prepend">
                                        <span class="d-flex align-items-center mr-2">
                                          <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                        </span>
                                    </div>
                                    <input class="js-range-datepicker font-size-16 shadow-none font-weight-normal form-control hero-form bg-transparent border-0 form-inputs"
                                    type="date"
                                    data-rp-wrapper="#datepickerWrapperFromOne"
                                    data-rp-type="single" 
                                    data-rp-date-format="Y-m-d"
                                    data-custom-datepicker="departure" 
                                    placeholder="YYYY-MM-DD"
                                    name="departure_date"
                                    id="departure_date_input"
                                    value="{{ request('departure_date') }}"
                                    oninput="moveToNextInput(this)">
                             
                                </div>
                                 <!-- End Datepicker -->
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-sm-12 col-lg-2 mb-4 mb-lg-0 {{ request('return_date') !='' ?'' : 'disable-element' }}" id="return-date">
                            <!-- Input -->
                            <span class="d-block text-gray-1 text-left font-weight-normal mb-0" >Return-Date </span>
                            <div class="border-bottom border-width-2 border-color-1">
                                <div id="datepickerWrapperFromTwo" class="u-datepicker input-group">
                                    <div class="input-group-prepend">
                                        <span class="d-flex align-items-center mr-2">
                                          <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                        </span>
                                    </div>
                                     <input class="js-range-datepicker font-size-lg-16 shadow-none font-weight-normal form-control hero-form bg-transparent  border-0 form-inputs" type="date"
                                         data-rp-wrapper="#datepickerWrapperFromTwo"
                                         data-rp-type="single"
                                         data-rp-date-format="Y-m-d"
                                         data-custom-datepicker="return" 
                                        data-auto-open="true"
                                        placeholder="YYYY-MM-DD"
                                        name="return_date"
                                        value="{{ request('return_date') }}"
                                        id="return_date_input"
                                        oninput="moveToNextInput(this)">

                                </div>
                                 <!-- End Datepicker -->
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-sm-12 {{ request('return_date') =='' ?'col-lg-2dot3' : 'col-lg-2' }} travelers-col text-left mb-4 mb-lg-0 dropdown-custom">
                            <!-- Input -->
                            <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Travelers</span>
                            <a id="basicDropdownClickInvoker" class="dropdown-nav-link dropdown-toggle d-flex pt-3 pb-2" href="javascript:;" role="button"
                                aria-controls="basicDropdownClick"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-target="#basicDropdownClick"
                                data-unfold-type="css-animation"
                                data-unfold-duration="300"
                                data-unfold-delay="300"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-animation-in="slideInUp"
                                data-unfold-animation-out="fadeOut">
                                <i class="flaticon-plus d-flex align-items-center mr-3 font-size-18 text-primary font-weight-normal"></i>
                                <span class="text-black "><span id="adult-count1">{{ request('adult') }} adult,</span>
                                <span id="child-count1">{{ request('child') }} child,</span> 
                                <span id="infants-count1">{{ request('infant') }} infant</span> </span>
                            </a>
                            <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker">
                               
                                <div class="w-100 py-2 px-3 mb-3">
                                    <div class="js-quantity mx-3 row align-items-center justify-content-between">
                                    <span class="d-block font-size-16 text-secondary font-weight-medium">Adult</span>
                                    <div class="d-flex">
                                    <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1" data-type="icon" href="javascript:;">
                                    <small class="fas fa-minus btn-icon__inner"></small>
                                    </a>
                                    <input name="adult" class="adults1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center" type="text" value="{{ request('adult') }}">
                                    <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1" data-type="icon" href="javascript:;">
                                    <small class="fas fa-plus btn-icon__inner"></small>
                                    </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="w-100 py-2 px-3 mb-3">
                                    <div class="js-quantity mx-3 row align-items-center justify-content-between">
                                    <span class="d-block font-size-16 text-secondary font-weight-medium">Child</span>
                                    <div class="d-flex">
                                    <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1 " data-type="icon" href="javascript:;">
                                    <small class="fas fa-minus btn-icon__inner"></small>
                                    </a>
                                    <input name="child" class="children1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center" type="text" value="{{ request('child') }}">
                                    <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1" data-type="icon" href="javascript:;">
                                    <small class="fas fa-plus btn-icon__inner"></small>
                                    </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="w-100 py-2 px-3">
                                    <div class="js-quantity mx-3 row align-items-center justify-content-between">
                                    <span class="d-block font-size-16 text-secondary font-weight-medium">Infant</span>
                                    <div class="d-flex">
                                    <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1" data-type="icon" href="javascript:;">
                                    <small class="fas fa-minus btn-icon__inner"></small>
                                    </a>
                                    <input name="infant" class="infants1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center" type="text" value="{{ request('infant') }}">
                                    <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1" data-type="icon" href="javascript:;">
                                    <small class="fas fa-plus btn-icon__inner"></small>
                                    </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="text-primary font-weight-semi-bold font-size-16 travelers-done text-center" data-type="done" style="background: #fff;
                                border: white;" id="done-selection1" type="button">Done</div>
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-sm-12 col-lg-1 text-left align-self-lg-end">
                            <button type="submit" class="btn btn-primary text-white border-radius-2 font-weight-bold  mb-xl-0 mb-lg-1 transition-3d-hover has-spinner"> <span class="button-text">Search</span></button>
                        </div>
                      </div>
                      <!-- End Checkbox -->
                    </form>

                </div>
            </div>
           </div>
           </div>
        </div>
    </div>
    <div class="container">
        <div class="row pt-5 pt-xl-8 mb-5 mb-xl-9 pb-xl-1">
            <div class="col-lg-4 col-xl-3 mt-xl-1 ">
                <div class="navbar-expand-xl navbar-expand-xl-collapse-block bg-light" style="border-radius: 5px">
                    <button class="btn d-xl-none mb-5 p-0 collapsed d-flex" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation" style="align-items: flex-start">
                        <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i>
                        <span class="text-primary ml-2">Filters</span>
                    </button>
                    <div id="sidebar" class="collapse navbar-collapse">
                        <div class="mb-6 w-100">
                            <div class="sidenav border border-color-8 rounded-xs">
                                <!-- Accordiaon -->
                                <div id="shopCategoryAccordion" class="accordion rounded-0 shadow-none">
                                    <div class="border-0">
                                        <div class="card-collapse" id="shopCategoryHeadingOne">
                                            <h3 class="mb-0">
                                                <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#shopCategoryOne" aria-expanded="false" aria-controls="shopCategoryOne">
                                                    <span class="row align-items-center">
                                                        <span class="col-9">
                                                            <span class="font-weight-bold font-size-17 text-dark mb-3">Stops
                                                            </span>
                                                        </span>
                                                        <span class="col-3 text-right">
                                                            <span class="card-btn-arrow">
                                                                <span class="fas fa-chevron-down small"></span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </button>
                                            </h3>
                                        </div>
                                        <div id="shopCategoryOne" class="collapse show" aria-labelledby="shopCategoryHeadingOne" data-parent="#shopCategoryAccordion">
                                            <div class="card-body pt-0 mt-1 px-5 pb-4">
                                               <!-- Checkboxes -->
                                                <div class="form-group font-size-1 text-lh-md text-gray-1 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="1" name="stopFilter" value="0">
                                                        <label class="custom-control-label" for="1">Non Stop</label>
                                                    </div>
                                                </div>
                                                <div class="form-group font-size-1 text-lh-md text-gray-1 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="2" name="stopFilter" value="1">
                                                        <label class="custom-control-label" for="2">1 Stop</label>
                                                    </div>
                                                </div>
                                                <div class="form-group font-size-1 text-lh-md text-gray-1 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="3" name="stopFilter" value="2">
                                                        <label class="custom-control-label" for="3">2 Stop</label>
                                                    </div>
                                                </div>
                                                <div class="form-group font-size-1 text-lh-md text-gray-1 mb-1">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="4" name="stopFilter" value="3">
                                                        <label class="custom-control-label" for="4">3 Stop</label>
                                                    </div>
                                                </div>
                                                <!-- End Checkboxes -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Accordion -->
                                <!-- Accordiaon -->
                                <div id="shopCartAccordion" class="accordion rounded shadow-none border-top">
                                    <div class="border-0">
                                        <div class="card-collapse" id="shopCardHeadingOne">
                                            <h3 class="mb-0">
                                                <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#shopCardOne" aria-expanded="false" aria-controls="shopCardOne">
                                                    <span class="row align-items-center">
                                                        <span class="col-9">
                                                            <span class="d-block font-size-lg-15 font-size-17 font-weight-bold text-dark">Price({{ getCurrencySymbol($data->data[0]->price->currency) }})</span>
                                                        </span>
                                                        <span class="col-3 text-right">
                                                            <span class="card-btn-arrow">
                                                                <span class="fas fa-chevron-down small"></span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </button>
                                            </h3>
                                        </div>
                                        <div id="shopCardOne" class="collapse show" aria-labelledby="shopCardHeadingOne" data-parent="#shopCartAccordion">
                                            <div class="card-body pt-0 px-5">
                                                {{-- <div class="pb-3 mb-1 d-flex text-lh-1">
                                                    <span></span>
                                                    <span id="rangeSliderExample3MinResult" class=""></span>
                                                    <span class="mx-0dot5"> — </span>
                                                    <span></span>
                                                    <span id="rangeSliderExample3MaxResult" class=""></span>
                                                </div>
                                                <input class="js-range-slider" type="text"
                                                data-extra-classes="u-range-slider height-35"
                                                data-type="double"
                                                data-grid="false"
                                                data-hide-from-to="true"
                                                data-min="0"
                                                data-max="3456"
                                                data-from="200"
                                                data-to="3456"
                                                data-prefix="$"
                                                data-result-min="#rangeSliderExample3MinResult"
                                                data-result-max="#rangeSliderExample3MaxResult"> --}}
                                                
                                                    <div class="js-price-rangeSlider">
                                                      <div class="text-14 fw-500 "></div>
                                
                                                      <div class="d-flex">
                                                        <div class="text-15 text-dark-1 w-100 text-center">
                                                          <span class="js-lower"></span>
                                                          -
                                                          <span class="js-upper"></span>
                                                        </div>
                                                      </div>
                                
                                                      <div class="px-5">
                                                        <div class="js-slider"></div>
                                                      </div>
                                                    </div>
                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Accordion -->

                                <div id="facilityCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                                    <div class="border-0">
                                        <div class="card-collapse" id="facilityCategoryHeadingOne">
                                            <h3 class="mb-0">
                                                <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#facilityCategoryOne" aria-expanded="false" aria-controls="facilityCategoryOne">
                                                    <span class="row align-items-center">
                                                        <span class="col-9">
                                                            <span class="font-weight-bold font-size-17 text-dark mb-3">Airlines</span>
                                                        </span>
                                                        <span class="col-3 text-right">
                                                            <span class="card-btn-arrow">
                                                                <span class="fas fa-chevron-down small"></span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </button>
                                            </h3>
                                        </div>
                                        <div id="facilityCategoryOne" class="collapse show" aria-labelledby="facilityCategoryHeadingOne" data-parent="#facilityCategoryAccordion">
                                            <div class="card-body pt-0 mt-1 px-5 pb-4">
                                                @foreach ($data->dictionaries->carriers as $airKey => $airline)
                                                    
                                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="airline-{{$airKey}}" name="airlineFilter" value="{{$airKey}}">
                                                        <label class="custom-control-label" for="airline-{{$airKey}}">{{ $airline }}</label>
                                                    </div>
                                                    <small>{{ $airKey }}</small>
                                                </div>
                                                @endforeach
                                               
                                                <!-- End Checkboxes -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- End Accordion -->
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 mt-xl-1">
                <!-- Shop-control-bar Title -->
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 pb-1">
                    <h3 class="font-size-21 font-weight-bold mb-4 mb-md-0 text-lh-1 text-center text-md-left text-light">
                     @if (!empty($data->data))

                        {{ count($data->data) .' flights found. '}}
                   
                        
                    @endif </h3>
                    {{-- <div class="d-flex align-items-center justify-content-between justify-content-md-start">
                        <div class="position-relative">
                            <a id="basicDropdownClickInvoker" class="dropdown-nav-link dropdown-toggle" href="javascript:;" role="button" aria-controls="basicDropdownClickSort" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#basicDropdownClickSort" data-unfold-type="css-animation"data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                            <span class="font-weight-bold text-gray-3"> Sorted By</span>
                          </a>

                          <div id="basicDropdownClickSort" class="dropdown-menu dropdown-unfold" aria-labelledby="basicDropdownClickInvoker">
                            <a class="dropdown-item active" href="#">One</a>
                            <a class="dropdown-item" href="#">Two</a>
                            <a class="dropdown-item" href="#">Three</a>
                          </div>
                        </div>
                        <ul class="nav tab-nav-shop flex-nowrap" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-size-22 p-0 ml-4 active" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-size-22 p-0 ml-2 " id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
               
                <!-- End shop-control-bar Title -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab" data-target-group="groups">

                        @foreach ($data->data as $mainKey=> $flights)

                        @php
                        $seg3 = '';
                        $seg2 = '';
                        $iti = '';
                        $seg4='';
                        
                        if (count($flights->itineraries[0]->segments) - 1 == 1) {
                            // means it has two segments
                            $seg2 = $flights->itineraries[0]->segments[1]->carrierCode;
                        }
                
                        if (count($flights->itineraries[0]->segments) - 1 == 2) {
                            // means it has three segments
                            $seg3 = $flights->itineraries[0]->segments[2]->carrierCode;
                        }
                
                        if (count($flights->itineraries) == 2) {
                            $iti = $flights->itineraries[1]->segments[0]->carrierCode;
                            if (count($flights->itineraries[1]->segments) - 1 != 0) {
                                $seg4 = $flights->itineraries[1]->segments[1]->carrierCode;
                            }
                        } else {
                            $iti = '';
                        }
                    @endphp

                        <div class="mb-5 flight-list-main bg-light" data-stop="{{ count($flights->itineraries[0]->segments)-1 }}" data-price="{{ $flights->price->grandTotal }}"  data-airline1="{{ $flights->itineraries[0]->segments[0]->carrierCode }}" data-airline2="{{ $seg2 }}" data-airline3="{{ $iti }}" data-airline4="{{ $seg3 }}" data-airline5="{{ $seg4 }}" 
                            style="border-radius: 5px">
                            <div class="hover-bg-gray-1 border rounded-xs ">
                                <div class="row align-items-center text-center p-3">

                                @foreach ($flights->itineraries as $itiKey=> $itineraries)
                                @php
                                    $segmentsCount = $itineraries->segments;

                                    $num_segments = count($segmentsCount);

                                    $first_segment = $segmentsCount[0];

                                    $last_segment = $segmentsCount[$num_segments - 1]
                                @endphp     
                                        
                                   
                                   <div class="d-flex col-9 ">

                                    <div class="col-3 p-0">
                                        <img class="airline-image" src="{{ url('assets/frontend/img/airlines/'.$first_segment->carrierCode) }}.png" alt="Image" >
                                    </div>

                                    <div class="col-3">
                                        <div class="flex-content-center d-block d-lg-flex">
                                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                                <i class="flaticon-aeroplane font-size-20 text-primary"></i>
                                            </div>
                                            <div class="text-lg-left">
                                                <h6 class="font-weight-bold font-size-14 text-gray-5 mb-0">{{ formatTime($first_segment->departure->at,'H:i') }}
                                                </h6>
                                                <span class="font-size-14 text-gray-1">{{ $first_segment->departure->iataCode }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <div class="flex-content-center flex-column">
                                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">{{ formatDuration($itineraries->duration) }}</h6>
                                            <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                                            <div class="font-size-14 text-gray-1">{{ $num_segments > 1 ? $num_segments-1 .' Stops ' : 'Non Stop' }} </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="flex-content-center d-block d-lg-flex">
                                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                                <i class="d-block rotate-90 flaticon-aeroplane font-size-20 text-primary"></i>
                                            </div>
                                            <div class="text-lg-left">
                                                <h6 class="font-weight-bold font-size-14 text-gray-5 mb-0">{{ formatTime($last_segment->arrival->at,'H:i') }}</h6>
                                                <span class="font-size-14 text-gray-1">{{ $last_segment->arrival->iataCode }}</span>
                                            </div>
                                        </div>
                                    </div>

                                   </div>
                                
                                @endforeach
                                <div class="col-3 {{ count($flights->itineraries)>1 && $itiKey==0 ? 'd-none' : '' }}  {{ count($flights->itineraries)>1 ? 'price-element-return' : 'price-element-single' }} " style="padding-right: 0;">
                                    <div class="border-xl-left">
                                        <div class="">
                                            <div class="mb-2">
                                                <div class="mb-2 text-lh-1dot4">
                                                    <span class="font-weight-bold font-size-15">{{ getCurrencySymbol($flights->price->currency) . '  ' .$flights->price->grandTotal }}</span>
                                                </div>

                                             <form action="{{ route('/flight-book') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="selectedData" value='{{ json_encode($flights) }}'>
                                                <input type="hidden" name="dictionaries" value='{{ json_encode($data->dictionaries) }}'>
                                                <button  class="btn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100" type="submit">Book </button>
                                            </form>
                                            </div>
                                            <!-- On Target Modal -->
                                            <a class="font-size-14 text-gray-1 d-block" href="#ontargetModal-{{$mainKey}}"
                                                data-modal-target="#ontargetModal-{{$mainKey}}"
                                                data-modal-effect="fadein">
                                                 Details
                                            </a>
                                            <div id="ontargetModal-{{$mainKey}}" class="js-modal-window u-modal-window max-width-960"
                                                data-modal-type="ontarget"
                                                data-open-effect="fadeIn"
                                                data-close-effect="fadeOut"
                                                data-speed="500">
                                                <div class="card mx-4 mx-xl-0 mb-4 mb-md-0">
                                                    <button type="button" class="border-0 width-50 height-50 bg-primary flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0" aria-label="Close" onclick="Custombox.modal.close();">
                                                        <i aria-hidden="true" class="flaticon-close text-white font-size-14"></i>
                                                    </button>
                                                   
                                                    <header class="card-header bg-light">
                                                        @foreach ($flights->itineraries as $subItiKey => $itineraries)
                                                            @if ($subItiKey == 0)
                                                                <h5 class="text-center text-primary " style="margin-left:2rem">Outbound</h5>
                                                            @elseif($subItiKey == 1)
                                                                <h5 class="text-center text-primary"style="margin-left:2rem">Inbound</h5>
                                                            @endif
                                                    
                                                            @php
                                                                $totalLayoverTime = 0; // Initialize total layover time for the itinerary
                                                            @endphp
                                                    
                                                            @foreach ($itineraries->segments as $segKey => $segment)
                                                                <div class="row align-items-center text-center">
                                                                    
                                                    
                                                                    <div class="single-line-items d-flex col-lg-12 col-md-12 col-sm-12 mb-md-0 d-flex justify-content-around justify-content-center-sm">

                                                                        <div class="d-flex justify-content-center" style=" 
                                                                        flex-direction: column;
                                                                       ">
                                                                            <img class="" src="{{ url('assets/frontend/img/airlines/'.$segment->carrierCode) }}.png" alt="Image-{{$mainKey}}" style="width: 3rem">
                                                                            <div class="font-size-14">
                                                                                {{ $segment->carrierCode. '  ' . $segment->aircraft->code }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md mb-md-0">
                                                                            <div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                                                                                <div class="mr-lg-3 mb-1 mb-lg-0">
                                                                                    <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                                                                                </div>
                                                                                <div class="text-lg-left">
                                                                                    <h6 class="font-size-21 text-gray-5 mb-0">{{ formatTime($segment->departure->at,'H:i') }}</h6>
                                                                                    <div class="font-size-14 text-gray-5">{{ formatTime($segment->departure->at,'D,d M ') }}</div>
                                                                                    <span class="font-size-14 text-gray-1">{{ $segment->departure->iataCode }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                    
                                                                        <div class="col-md mb-md-0 d-flex align-items-center justify-content-center">
                                                                            <div class="mx-2 mx-xl-3 flex-content-center flex-column">
                                                                                <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">{{ formatDuration($segment->duration) }}</h6>
                                                                                <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                                                                            </div>
                                                                        </div>
                                                    
                                                                        <div class="col-md mb-md-0">
                                                                            <div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                                                                                <div class="mr-lg-3 mb-1 mb-lg-0">
                                                                                    <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                                                                </div>
                                                                                <div class="text-lg-left">
                                                                                    <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">{{ formatTime($segment->arrival->at,'H:i') }}</h6>
                                                                                    <div class="font-size-14 text-gray-5">{{ formatTime($segment->arrival->at,'D,d M ') }}</div>
                                                                                    <span class="font-size-14 text-gray-1">{{ $segment->arrival->iataCode }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    
                                                                    @if ($segKey < count($itineraries->segments) - 1)
                                                                        @php
                                                                            // Calculate layover time in seconds
                                                                            $layoverTime = strtotime($itineraries->segments[$segKey + 1]->departure->at) - strtotime($segment->arrival->at);
                                                                            
                                                                            // Add layover time to the total for the itinerary
                                                                            $totalLayoverTime += $layoverTime;
                                                                            
                                                                            // Convert layover time to hours and minutes
                                                                            $layoverHours = floor($layoverTime / 3600);
                                                                            $layoverMinutes = floor(($layoverTime % 3600) / 60);
                                                                        @endphp
                                                    
                                                                        <div class="d-flex justify-content-center w-100">
                                                                            <div class="text-center" style="border-top: 2px solid #ffc107; border-bottom: 2px solid #ffc107; display: inline-block; padding: 0 10px; margin-left:2rem">
                                                                                Layover {{ $layoverHours }}h {{ $layoverMinutes }}min
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </header>
                                                    
                                                    <!-- End Header -->

                                                    <!-- Body -->
                                                    <div class="card-body py-4 p-md-5">
                                                        <div class="row">
                                                            <div class="col">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Type</th>
                                                                            <th>Total Price</th>
                                                                            <th>Baggage (Adult)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                        $displayedTypes = [];
                                                                    @endphp
                                                                    
                                                                    @foreach ($flights->travelerPricings as $priceData)
                                                                        @if (!in_array($priceData->travelerType, $displayedTypes))
                                                                            <tr>
                                                                                <td>
                                                                                    <span class="text-gray-1">Per {{ $priceData->travelerType =='HELD_INFANT' ?'Infant' : $priceData->travelerType}}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <span class="text-gray-1">{{ getCurrencySymbol($priceData->price->currency) . ' ' . $priceData->price->total }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    @if (isset($priceData->fareDetailsBySegment[0]->includedCheckedBags))
                                                                                        <span class="text-gray-1">
                                                                                           
                                                                                        @php
                                                                                        $weight = $priceData->fareDetailsBySegment[0]->includedCheckedBags->weight ?? '';
                                                                                        $weightUnit = $priceData->fareDetailsBySegment[0]->includedCheckedBags->weightUnit ?? '';

                                                                                        if (empty($weight) && empty($weightUnit)) {
                                                                                            $quantity = $priceData->fareDetailsBySegment[0]->includedCheckedBags->quantity ?? '';
                                                                                            echo $quantity;
                                                                                        } else {
                                                                                            echo $weight . ' ' . $weightUnit;
                                                                                        }
                                                                                        @endphp

                                                                                        </span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                                $displayedTypes[] = $priceData->travelerType;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                            <div class="col-auto mx-2">
                                                                <div class="min-width-250">
                                                                    <h5 class="font-size-17 font-weight-bold text-dark">Fare breakup</h5>
                                                                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                                                        <li class="d-flex justify-content-between py-2">
                                                                            <span class="font-weight-medium">Base Fare</span>
                                                                            <span class="text-secondary">{{ getCurrencySymbol($flights->price->currency) . '  ' . $flights->price->base }}</span>
                                                                        </li>

                                                                        <li class="d-flex justify-content-between py-2">
                                                                            <span class="font-weight-medium">Surcharges</span>
                                                                            <span class="text-secondary">{{ getCurrencySymbol($flights->price->currency) . '  ' . $flights->price->total-$flights->price->base }}</span>
                                                                        </li>


                                                                        <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                                                            <span class="font-weight-bold">Pay Amount</span>
                                                                            <span class="">{{ getCurrencySymbol($flights->price->currency) . '  ' . $flights->price->grandTotal }}</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Body -->
                                                </div>
                                            </div>
                                            <!-- End On Target Modal -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="tab-pane fade" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="mb-5">
                                    <div class="card w-100 shadow-hover-3">
                                        <a href="../flights/flights-booking.html" class="d-block mb-0 mx-1 mt-1 p-3" tabindex="0">
                                            <img class="card-img-top" src="../../assets/img/260x200/img1.jpg" alt="Image Description">
                                        </a>
                                        <div class="card-body px-3 pt-0 pb-3 my-0 mx-1">
                                            <div class="row">
                                                <div class="col-7">
                                                    <a href="../flights/flights-booking.html" class="card-title text-dark font-size-17 font-weight-bold" tabindex="0">Paris</a>
                                                    <span class="font-weight-normal font-size-14 d-block text-color-1">Oneway flight</span>
                                                </div>
                                                <div class="col-5">
                                                    <div class="text-right">
                                                        <h6 class="font-weight-bold font-size-17 text-gray-3 mb-0">£350.00</h6>
                                                        <span class="font-weight-normal font-size-14 d-block text-color-1">avg/person</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 pb-1">
                                            <div class="border-bottom pb-3 mb-3">
                                                <div class="px-3">
                                                    <div class="d-flex mx-1">
                                                        <i class="flaticon-aeroplane font-size-30 text-primary mr-3"></i>
                                                        <div class="d-flex flex-column">
                                                            <span class="font-weight-normal text-gray-5">Take off</span>
                                                            <span class="font-size-14 text-gray-1">Wed Nov 19 7:50 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-bottom pb-3 mb-3">
                                                <div class="px-3">
                                                    <div class="d-flex mx-1">
                                                        <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary mr-3"></i>
                                                        <div class="d-flex flex-column">
                                                            <span class="font-weight-normal text-gray-5">Landing</span>
                                                            <span class="font-size-14 text-gray-1">Wed Nov 29 7:50 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center font-size-14 text-primary mb-3">
                                                <!-- On Target Modal -->
                                                <a class="font-size-14 text-gray-1 d-block" href="#ontargetModal"
                                                    data-modal-target="#ontargetModal"
                                                    data-modal-effect="fadein">
                                                    Flight Details
                                                </a>
                                                <div id="ontargetModal" class="js-modal-window u-modal-window max-width-960"
                                                    data-modal-type="ontarget"
                                                    data-open-effect="fadeIn"
                                                    data-close-effect="fadeOut"
                                                    data-speed="500">
                                                    <div class="card mx-4 mx-xl-0 mb-4 mb-md-0">
                                                        <button type="button" class="border-0 width-50 height-50 bg-primary flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0" aria-label="Close" onclick="Custombox.modal.close();">
                                                            <i aria-hidden="true" class="flaticon-close text-white font-size-14"></i>
                                                        </button>
                                                        <!-- Header -->
                                                        <header class="card-header bg-light py-4 px-4">
                                                            <div class="row align-items-center text-center">
                                                                <div class="col-md-auto mb-4 mb-md-0">
                                                                    <div class="d-block d-lg-flex flex-horizontal-center">
                                                                        <img class="img-fluid mr-3 mb-3 mb-lg-0" src="../../assets/img/90x90/img1.png" alt="Image-Description">
                                                                        <div class="font-size-14">Spicejet SG 143 | Boeing 737-700</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-auto mb-4 mb-md-0">
                                                                    <div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                                                                        <div class="mr-lg-3 mb-1 mb-lg-0">
                                                                            <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                                                                        </div>
                                                                        <div class="text-lg-left">
                                                                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">18:30</h6>
                                                                            <div class="font-size-14 text-gray-5">Sat, 21 Sep 19</div>
                                                                            <span class="font-size-14 text-gray-1">New Delhi, India</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-auto mb-4 mb-md-0">
                                                                    <div class="mx-2 mx-xl-3 flex-content-center flex-column">
                                                                        <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">02 hrs 45 mins</h6>
                                                                        <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                                                                        <div class="font-size-14 text-gray-1">Non Stop</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-auto mb-4 mb-md-0">
                                                                    <div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                                                                        <div class="mr-lg-3 mb-1 mb-lg-0">
                                                                            <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                                                        </div>
                                                                        <div class="text-lg-left">
                                                                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">21.15</h6>
                                                                            <div class="font-size-14 text-gray-5">Sun, 22 Sep 19</div>
                                                                            <span class="font-size-14 text-gray-1">Bengaluru, India</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </header>
                                                        <!-- End Header -->

                                                        <!-- Body -->
                                                        <div class="card-body py-4 p-md-5">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <ul class="d-block d-md-flex list-group list-group-borderless list-group-horizontal list-group-flush no-gutters">
                                                                        <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                                                            <div class="font-weight-bold text-dark">Baggage</div>
                                                                            <span class="text-gray-1">Adult</span>
                                                                        </li>
                                                                        <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                                                            <div class="font-weight-bold text-dark">Check-in</div>
                                                                            <span class="text-gray-1">15 Kgs</span>
                                                                        </li>
                                                                        <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                                                            <div class="font-weight-bold text-dark">Cabin</div>
                                                                            <span class="text-gray-1">7 Kgs</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="min-width-250">
                                                                        <h5 class="font-size-17 font-weight-bold text-dark">Fare breakup</h5>
                                                                        <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                                                            <li class="d-flex justify-content-between py-2">
                                                                                <span class="font-weight-medium">Base Fare</span>
                                                                                <span class="text-secondary">€580,00</span>
                                                                            </li>

                                                                            <li class="d-flex justify-content-between py-2">
                                                                                <span class="font-weight-medium">Surcharges</span>
                                                                                <span class="text-secondary">€0,00</span>
                                                                            </li>


                                                                            <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                                                                <span class="font-weight-bold">Pay Amount</span>
                                                                                <span class="">€580,00</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Body -->
                                                    </div>
                                                </div>
                                                <!-- End On Target Modal -->
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <a href="../flights/flights-booking.html" class="btn btn-blue-1 font-size-14 width-260 text-lh-lg transition-3d-hover py-1">Choose</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="priceChangeModal" tabindex="-1" role="dialog" aria-labelledby="priceChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="priceChangeModalLabel">Price Update</h5>
                <!-- Remove the close button from the header -->
            </div>
            <div class="modal-body">
                <p>Prices may have changed. Please click the "Refresh" button below to get the latest prices.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="refreshPage()">Refresh</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Set a timer for 10 minutes (in milliseconds)
    const timerDuration = 10 * 60 * 1000;

    // Function to show the modal
    const showPriceChangeModal = () => {
        $('#priceChangeModal').modal({
            backdrop: 'static', // Prevents closing when clicking outside the modal
            keyboard: false,     // Prevents closing with the keyboard
        });

        // Disable right-click on the whole document
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    };

    // Set the timer
    setTimeout(showPriceChangeModal, timerDuration);

    // Function to refresh the page
    const refreshPage = () => {
        location.reload();
    };
</script>
<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
