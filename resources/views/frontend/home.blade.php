@extends('frontend.layouts.main')
@section('main-container')
<main id="content">
    <!-- ========== HERO ========== -->
    <div class="hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2" style="background-image: url({{asset('assets/frontend/img/bannerImage.webp')}});">
        <div class="container space-3 space-top-xl-3">
            <div class="row justify-content-md-center" style="margin-bottom: -7%;">
                <!-- Info -->
                <div class="py-8 py-xl-10 pb-5">
                    <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold">Search & Book At Your Fingertips</h1>
                   
                </div>
                <!-- End Info -->
            </div>
            <div class="mb-lg-n16 ">
                <!-- Nav Classic -->
                <ul class="nav tab-nav-rounded flex-nowrap pb-2 pb-md-4 tab-nav" role="tablist">
                   
                   
                    <li class="nav-item">
                        <a class="nav-link font-weight-medium active pl-md-5 pl-3" id="pills-seven-example2-tab" data-toggle="pill" href="#pills-seven-example2" role="tab" aria-controls="pills-seven-example2" aria-selected="true">
                            <div class="d-flex flex-column flex-md-row  position-relative  text-white align-items-center">
                                <figure class="ie-height-40 d-md-block mr-md-3">
                                    <i class="icon flaticon-aeroplane font-size-3"></i>
                                </figure>
                                <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">Flights</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- End Nav Classic -->
                <div class="tab-content hero-tab-pane">
                  
                    @if(session('customErrors'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('customErrors')[0]->detail }}
                           
                        </div>
                    @endif

                    @if(session('customError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong>
                        @if(isset(session('customError')->errors))
                            @foreach(session('customError')->errors as $error)
                                {{ $error->detail }}
                                <br>
                            @endforeach
                        @elseif(session('customError')->error_description)
                            {{ session('customError')->error_description }}
                           
                        @endif
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  @endif

                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error:</strong>
                     
                    {{ session('error') }}
                        
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif
                
                    <div class="tab-pane fade  active show" id="pills-seven-example2" role="tabpanel" aria-labelledby="pills-seven-example2-tab">
                        <!-- Search Jobs Form -->
                        <div class="card border-0 tab-shadow">
                            <div class="card-body">
                                <ul class="nav tab-nav tab-nav-inner flex-nowrap pb-4 px-lg-3 px-2 pb-xl-0" role="tablist">
                                   
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-medium active" id="pills-one-example2-tab" data-toggle="pill" href="#pills-one-example2" role="tab" aria-controls="pills-one-example2" aria-selected="true" onclick="updateDatePicker('range')">
                                            <div class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                                <span class="tabtext mt-2 mt-md-0 font-size-12 font-weight-semi-bold">ROUND-TRIP</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link font-weight-medium " id="pills-two-example2-tab" data-toggle="pill" href="#pills-two-example2" role="tab" aria-controls="pills-two-example2" aria-selected="true" onclick="updateDatePicker('single')">
                                            <div class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                                <span class="tabtext mt-2 mt-md-0 font-size-12 font-weight-semi-bold">ONE-WAY</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>

                                <form class="js-validate" action="{{ route('flight-list') }}">
                                    <input type="hidden" name="departure_code" id="departure_code" value="">
                                    <input type="hidden" name="arrival_code" id="arrival_code" value="">
                                  <div class="row nav-select d-block d-lg-flex mb-lg-2 px-lg-3 px-2">
                                    <div class="col-sm-12 col-lg-2dot3 change-col mb-4 mb-lg-0 ">
                                        <!-- Input -->
                                        <span class="d-block text-gray-1 text-left font-weight-normal mb-0">From where</span>
                                        <div class="js-focus-state">
                                            <div class="input-group border-bottom border-width-2 border-color-1">
                                                <i class="flaticon-pin-1 d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                              <input type="text" class="form-control font-size-lg-16 shadow-none hero-form  border-0 pl-0 search-input auto-focus form-inputs" placeholder="city or airport" aria-label="Keyword or title" id="departure" name="departure_full" autocomplete="off" onclick="this.value=''" required >
                                            </div>
                                        </div>
                                        <!-- End Input -->
                                    </div>
                                    <div class="col-sm-12 col-lg-2dot3 change-col mb-4 mb-lg-0 ">
                                        <!-- Input -->
                                        <span class="d-block text-gray-1 text-left font-weight-normal mb-0">To where</span>
                                        <div class="js-focus-state">
                                            <div class="input-group border-bottom border-width-2 border-color-1">
                                                <i class="flaticon-pin-1 d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                              <input type="text" class="form-control font-size-lg-16 shadow-none hero-form  border-0 pl-0 search-input auto-focus form-inputs" placeholder="city or airport" aria-label="Keyword or title" id="arrival" name="arrival_full" autocomplete="off" onclick="this.value=''" required>
                                            </div>
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-sm-12 col-lg-2 mb-4 mb-lg-0 " id="departure-date">
                                        <!-- Input -->
                                        <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Departure Date </span>
                                        <div class="border-bottom border-width-2 border-color-1">
                                            <div id="datepickerWrapperFromOne" class="u-datepicker input-group">
                                                <div class="input-group-prepend">
                                                    <span class="d-flex align-items-center mr-2">
                                                        <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                                    </span>
                                                </div>
                                                <input class="js-range-datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0 form-inputs"
                                                type="date"
                                                data-rp-wrapper="#datepickerWrapperFromOne"
                                                data-rp-type="single"
                                                data-rp-date-format="Y-m-d"
                                                data-custom-datepicker="departure"
                                                placeholder="YYYY-MM-DD"
                                                name="departure_date"
                                                id="departure_date_input"
                                                required
                                                oninput="moveToNextInput(this)">

                                            </div>
                                            <!-- End Datepicker -->
                                        </div>
                                        <!-- End Input -->
                                    </div>
                                    
                                    <div class="col-sm-12 col-lg-2 mb-4 mb-lg-0 " id="return-date">
                                        <!-- Input -->
                                        <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Return Date </span>
                                        <div class="border-bottom border-width-2 border-color-1">
                                            <div id="datepickerWrapperFromTwo" class="u-datepicker input-group">
                                                <div class="input-group-prepend">
                                                    <span class="d-flex align-items-center mr-2">
                                                        <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                                    </span>
                                                </div>
                                               
                                                    <input class="js-range-datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0 form-inputs"
                                                    type="date"
                                                    data-rp-wrapper="#datepickerWrapperFromTwo"
                                                    data-rp-type="single"
                                                    data-rp-date-format="Y-m-d"
                                                    data-custom-datepicker="return" 
                                                    data-auto-open="true"
                                                    placeholder="YYYY-MM-DD"
                                                    name="return_date"
                                                    id="return_date_input"
                                                    oninput="moveToNextInput(this)">

                                            </div>
                                            <!-- End Datepicker -->
                                        </div>
                                        <!-- End Input -->
                                    </div>


                                    <div class="col-sm-12 col-lg-2 travelers-col text-left mb-4 mb-lg-0 dropdown-custom">
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
                                            <i class="flaticon-plus d-flex align-items-center mr-3 font-size-18 text-primary font-weight-semi-bold"></i>
                                            <span class="text-black "><span id="adult-count1">1 adult,</span>  <span id="child-count1">0 child,</span>   <span id="infants-count1">0 infant</span> </span>
                                        </a>
                                        <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker">
                                           
                                            <div class="w-100 py-2 px-3 mb-3">
                                                <div class="js-quantity mx-3 row align-items-center justify-content-between">
                                                <span class="d-block font-size-16 text-secondary font-weight-medium">Adult</span>
                                                <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1" data-type="icon" href="javascript:;">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input name="adult" class="adults1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center " type="text" value="1">
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
                                                <input name="child" class="children1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center" type="text" value="0">
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
                                                <input name="infant" class="infants1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center" type="text" value="0">
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
                        <!-- End Search Jobs Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== END HERO ========== -->

    <!-- Icon Block v1 -->
    <div class="icon-block-center icon-center-v1 border-bottom border-color-8 mt-10">
        <div class="container text-center space-1">
            <!-- Title -->
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 mt-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold">Why Choose</h2>
            </div>
            <!-- End Title -->

            <!-- Features -->

            <div class="mb-2">
                    <div class="row">
                        <!-- Icon Block -->
                        @foreach (json_decode(getSectionContent('why_choose_us')->section_content) as $secKey => $secValue)
                                
                            <div class="col-md-3">
                            <img src="{{ url('storage/images/sections/'.$secValue->image) }}"  alt="" class="text-primary font-size-80 mb-3" style="width: 5rem;height:5rem"> 
                                <h5 class="font-size-17 text-dark font-weight-bold mb-2"><a href="#">{{ $secValue->title }}</a></h5>
                                <p class="text-gray-1 px-xl-2 px-uw-7">{{ $secValue->description }}</p>
                            </div>
                        @endforeach

                        <!-- End Icon Block -->
                       
                       
                        <!-- Icon Block -->
                        {{-- <div class="col-md-3">
                            <i class="fas fa-headphones-alt text-primary font-size-80 mb-3"></i>
                            <h5 class="font-size-17 text-dark font-weight-bold mb-2"><a href="#">Contact Us</a></h5>
                            <p class="text-gray-1 px-xl-2 px-uw-7">If you need any help to book your trip and explore the cheap travel option then call our travel specialists.</p>
                        </div> --}}
                        <!-- End Icon Block -->
                    </div>
                </div>
            <!-- End Features -->
        </div>
    </div>
    <!-- End Icon Block v1 -->

    <!-- Deal Carousel v1 -->
    <div class="deal-list-block deal-list-v1 bg-img-hero min-height-600" style="background-image: url({{ asset('assets/frontend/img/1920x600/img2.jpg') }});">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-4 pb-1 pt-7">
            <h2 class="section-title-1 text-dark font-size-30 font-weight-bold mb-0"> Travel Deals</h2>
        </div>
        <div class="container">
            <div class="row mb-xl-5">
                @foreach ($TravelDeals as $key => $value)
                    
                <div class="col-md-6 col-lg-3 mt-3">
                    <a class="d-block mb-4 mb-xl-0" href="{{ route('home-deal',strtolower($value->area_name)) }}">
                        <div class="text-hover bg-white p-3 rounded-xs d-flex justify-content-between transition-3d-hover">
                            <h6 class="font-size-17 font-weight-normal text-gray-5 ml-1 mb-0">{{$value->area_name}}</h6>
                            <span class="font-size-19 font-weight-bold text-gray-1 mr-1">{{ $value->currency . '  ' . $value->starting_price}}</span>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>
           
        </div>
    </div>
    <!-- End Deal Carousel v1 -->

    <div class="banner-block ">
        <div class="container space-2 space-lg-3 space-top-xl-2 space-bottom-xl-0">
            <div class="row align-items-lg-center align-items-xl-start mt-xl-4 pt-1">
                <div class="col mb-7 mb-lg-0 mt-xl-9">
                    <h5 class="font-size-xs-30 font-size-40 font-weight-bold text-black mb-2">Book with more ease</h5>
                    <h3 class="font-size-xs-30 font-size-25 font-weight-bold text-black mb-2">In 3 Steps</h3>
                    <p class="font-size-18 font-weight-normal text-black mb-4 mb-md-5 pb-lg-2"> Download, Search &amp; Book with app and get 10% off on each package you book. </p>
                    <div class="d-flex flex-wrap">
                    <button type="button" class="btn btn-wide rounded-xs transition-3d-hover btn-outline-black border-width-2 py-1 pl-lg-4 text-left mb-md-0 mr-md-2 mr-lg-4 btngpas ">
                    <span class="media align-items-center ml-1 ">
                        <span class="flaticon-apple font-size-35 mr-3"></span>
                        <span class="media-body">
                          <strong class="font-weight-bold text-black">App Store</strong>
                          <span class="d-block font-weight-normal text-black font-size-14">Available now on the</span>
                        </span>
                    </span>
                    </button>
                    <button type="button" class="btn btn-wide rounded-xs transition-3d-hover btn-outline-black border-width-2 py-1 pl-lg-4 text-left btngpas btngpas ">
                    <span class="media align-items-center ml-1">
                        <span class="flaticon-google-play font-size-35 mr-3"></span>
                        <span class="media-body">
                           <strong class="font-weight-bold text-black">Google Play</strong>
                          <span class="d-block font-weight-normal font-size-14 text-black">Get in on</span>
                        </span>
                    </span>
                    </button>
                  </div>
                </div>
                <div class="col-lg-5 col-xl-6dot5 text-right mr-xl-n2">
                    <img class="img-fluid" src="{{ asset('assets/frontend/img/709x457/img1.png') }}" alt="Image-Description">
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

  
  