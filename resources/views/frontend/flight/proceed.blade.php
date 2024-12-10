@include('frontend.layouts.header-search')
<style>
    .iti{
        width: 100% !important;
    }
</style>


<!-- ========== MAIN CONTENT ========== -->
<main id="content" class=" space-2" style="background-color: #1a0b24">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="mb-5 shadow-soft bg-white rounded-sm">
                    <div class="py-3 px-4 px-xl-12 border-bottom">
                        <ul
                            class="list-group flex-nowrap overflow-auto overflow-md-visble list-group-horizontal list-group-borderless flex-center-between pt-1">
                            <li class="list-group-item text-center flex-shrink-0 flex-xl-shrink-1">
                                <div
                                    class="flex-content-center mb-3 width-40 height-40 bg-primary border-width-2 border border-primary text-white mx-auto rounded-circle">
                                    1
                                </div>
                                <div class="text-primary">Customer information</div>
                            </li>
                            <li class="list-group-item text-center flex-shrink-0 flex-xl-shrink-1">
                                <div
                                    class="flex-content-center mb-3 width-40 height-40 border  border-width-2 border-gray mx-auto rounded-circle">
                                    2
                                </div>
                                <div class="text-gray-1">Payment information</div>
                            </li>
                            <li class="list-group-item text-center flex-shrink-0 flex-md-shrink-1">
                                <div
                                    class="flex-content-center mb-3 width-40 height-40 border  border-width-2 border-gray mx-auto rounded-circle">
                                    3
                                </div>
                                <div class="text-gray-1">Booking is confirmed!</div>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}

                            </div>
                        @endif
                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4">
                            Fill up booking-details
                        </h5>
                        <!-- Contacts Form -->
                        <form class="js-validate" action="{{ route('/flight-form') }}" method="post">
                            @csrf
                            <div class="row">
                                <!-- Input -->
                                <div class="col-sm-6 mb-4">
                                    <div class="js-form-message">
                                        <label class="form-label">
                                            First Name
                                        </label>

                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="First Name" aria-label="First Name" required
                                            data-msg="Please enter your first name." data-error-class="u-has-error"
                                            data-success-class="u-has-success" value="{{ old('first_name') }}">

                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="col-sm-6 mb-4">
                                    <div class="js-form-message">
                                        <label class="form-label">
                                            Last name
                                        </label>

                                        <input type="text" class="form-control" name="last_name"
                                            placeholder="Last Name" aria-label="Last Name" required
                                            data-msg="Please enter your last name." data-error-class="u-has-error"
                                            data-success-class="u-has-success" value="{{ old('last_name') }}">
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                                    </div>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="col-sm-6 mb-4">
                                    <div class="js-form-message">
                                        <label class="form-label">
                                            Email
                                        </label>

                                        <input type="email" class="form-control" name="email"
                                            placeholder="myemail@exmaple.com" aria-label="myemail@exmaple.com" required
                                            data-msg="Please enter a valid email address."
                                            data-error-class="u-has-error" data-success-class="u-has-success"
                                            value="{{ old('email') }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="col-sm-6 mb-4">
                                    <div class="js-form-message">
                                        <label class="form-label">
                                            Phone
                                        </label>

                                            <input type="text"
                                            class="form-control "
                                            placeholder="Mobile No" aria-label="contact_no" name="contact_no"
                                            autocomplete="off" required id="phone-input"
                                            data-msg="Please enter a valid phone number." data-error-class="u-has-error"
                                            data-success-class="u-has-success" value="{{ old('contact_no') }}">

                                        <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />

                                    </div>
                                </div>
                                <!-- End Input -->

                                <div class="w-100"></div>
                                @foreach ($selectedData->travelerPricings as $tKey => $traveler)
                                    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4">
                                        Passenger: {{ $tKey + 1 }} ({{ $traveler->travelerType }})
                                    </h5>
                                    <input type="hidden" name="passType[]" value="{{ $traveler->travelerType }}">
                                    <div class="w-100"></div>
                                    <div class="col-sm-2 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Title
                                            </label>
                                            <select class="form-control js-select selectpicker dropdown-select"
                                                required="" data-msg="Please select title."
                                                data-error-class="u-has-error" data-success-class="u-has-success"
                                                data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal"
                                                name="title[]">

                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>

                                            </select>

                                            <x-input-error :messages="$errors->get('title.' . $tKey)" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-sm-2 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Gender
                                            </label>
                                            <select class="form-control js-select selectpicker dropdown-select"
                                                required="" data-msg="Please select Gender."
                                                data-error-class="u-has-error" data-success-class="u-has-success"
                                                data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal"
                                                name="gender[]">

                                                <option value="MALE">MALE</option>
                                                <option value="FEMALE">FEMALE</option>

                                            </select>
                                            <x-input-error :messages="$errors->get('gender.' . $tKey)" class="mt-2" />


                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                First And Middle Name
                                            </label>

                                            <input type="text" class="form-control" name="name[]"
                                                placeholder="Passenger First And Middle Name" aria-label="Passenger First Name"
                                                required data-msg="Please enter pax first name."
                                                data-error-class="u-has-error" data-success-class="u-has-success"
                                                value="{{ old('name.' . $tKey) }}">
                                            <x-input-error :messages="$errors->get('name.' . $tKey)" class="mt-2" />

                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Last Name
                                            </label>

                                            <input type="text" class="form-control" name="surname[]"
                                                placeholder="Passenger Last Name" aria-label="Passenger Last Name"
                                                required data-msg="Please enter pax last name."
                                                data-error-class="u-has-error" data-success-class="u-has-success"
                                                value="{{ old('surname.' . $tKey) }}">
                                            <x-input-error :messages="$errors->get('surname.' . $tKey)" class="mt-2" />


                                        </div>
                                    </div>
                                 <h5 class="w-100 mx-5 text-primary"><input type="checkbox" id="pax-check-{{$tKey}}" onclick="togglePaxBox('{{$tKey}}')"><label class="mx-2" for="pax-check-{{$tKey}}">Add Passport Info</label></h5>
                                <div class="col-12 row" style="margin-left:0;display:none" id="pax-box-{{$tKey}}">
                                    <div class="col-sm-3 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Passport Number
                                            </label>

                                            <input type="text" class="form-control" name="pidno[]"
                                                placeholder="Passport No" aria-label="Passport No"
                                                data-msg="Please enter pax passport No."
                                                data-error-class="u-has-error" data-success-class="u-has-success"
                                                value="{{ old('pidno.' . $tKey) }}">
                                            <x-input-error :messages="$errors->get('pidno.' . $tKey)" class="mt-2" />

                                        </div>
                                    </div>

                                    <div class="col-sm-3 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Expiry
                                            </label>

                                            {{-- <div id="datepickerWrapperFromOne-{{$tKey}}" class="u-datepicker input-group">
                                                <div class="input-group-prepend">
                                                    <span class="d-flex align-items-center mr-2">
                                                        <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                                    </span>
                                                </div>
                                                <input class="js-range-datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0"
                                                    type="date"
                                                    data-rp-wrapper="#datepickerWrapperFromOne-{{$tKey}}"
                                                    data-rp-type="single"
                                                    data-rp-date-format="Y-m-d"
                                                    data-custom-datepicker="expiray" 
                                                    placeholder="YYYY-MM-DD"
                                                    name="pied[]"
                                                    
                                                    value="{{ old('pied.' . $tKey) }}" 
                                                    data-msg="Please enter pax passport expiry."
                                                    data-error-class="u-has-error" data-success-class="u-has-success"
                                                   >
                                            </div> --}}
                                            <input class="datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0"
                                                    type="text"
                                                    placeholder="YYYY-MM-DD"
                                                    name="pied[]"
                                                    value="{{ old('pied.' . $tKey) }}" 
                                                    data-msg="Please enter pax passport expiry."
                                                    data-error-class="u-has-error" data-success-class="u-has-success"
                                                    data-future="false"
                                                    autocomplete="off"
                                                   >
                                            <x-input-error :messages="$errors->get('pied.' . $tKey)" class="mt-2" />

                                        </div>
                                    </div>

                                    <div class="col-sm-3 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Dob
                                            </label>

                                            {{-- <div id="datepickerWrapperFromTwo-{{$tKey}}" class="u-datepicker input-group">
                                                <div class="input-group-prepend">
                                                    <span class="d-flex align-items-center mr-2">
                                                        <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                                    </span>
                                                </div>
                                                <input class="js-range-datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0"
                                                    type="date"
                                                    data-rp-wrapper="#datepickerWrapperFromTwo-{{$tKey}}"
                                                    data-rp-type="single"
                                                    data-rp-date-format="Y-m-d"
                                                    data-custom-datepicker="dob" 
                                                    placeholder="YYYY-MM-DD"
                                                    name="dob[]"
                                                    
                                                    data-error-class="u-has-error" data-success-class="u-has-success"
                                                    data-msg="Please enter pax Dob."
                                                    data-error-class="u-has-error" data-success-class="u-has-success"
                                                    value="{{ old('dob.' . $tKey) }}"
                                                    data-max-date="today"
                                                    data-min-date="">
                                            </div> --}}
                                            <input class="datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0"
                                            type="text"
                                          autocomplete="off"
                                            placeholder="YYYY-MM-DD"
                                            name="dob[]"
                                            
                                            data-error-class="u-has-error" data-success-class="u-has-success"
                                            data-msg="Please enter pax Dob."
                                            data-error-class="u-has-error" data-success-class="u-has-success"
                                            value="{{ old('dob.' . $tKey) }}"
                                            data-max-date="today"
                                            data-min-date="">
                                            <x-input-error :messages="$errors->get('dob.' . $tKey)" class="mt-2" />

                                        </div>
                                    </div>

                                    <div class="col-sm-3 mb-4">
                                        <div class="js-form-message">
                                            <label class="form-label">
                                                Issue Country
                                            </label>
                                            <select class="form-control js-select selectpicker dropdown-select"
                                                 data-msg="Please select issue country."
                                                data-error-class="u-has-error" data-success-class="u-has-success"
                                                data-live-search="true"
                                                data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal"
                                                name="country[]"
                                               >

                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->shortname }}" {{ old('country.' . $tKey) == $country->shortname ? 'selected' : '' }}>{{ $country->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <x-input-error :messages="$errors->get('country.' . $tKey)" class="mt-2" />


                                        </div>
                                    </div>
                                </div>
                                @endforeach


                                <div class="w-100"></div>


                                <div class="col-sm-12 align-self-end">
                                    <div class="text-right">
                                        <button type="submit"
                                            class="btn btn-primary btn-wide rounded-sm transition-3d-hover font-size-16 font-weight-bold py-3 has-spinner"><span class="button-text">Proceed</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Contacts Form -->
                    </div>
                </div>

            </div>
            
            @include('frontend.flight.partials.proceed-right')

        </div>
        <div class="row">
            <div class="col-12 mb-10">
                <div id="nfaq">
                    <div class="container pb-4">
                        <div class="accordion" id="faq">
                            <div class="card bg-transparent">
                                <div class="card-header bg-transparent" id="faqhead1">
                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse"
                                        data-target="#faq1" aria-expanded="false" aria-controls="faq1">How do we
                                        process this information ?</a>
                                </div>

                                <div id="faq1" class="collapse" aria-labelledby="faqhead1" data-parent="#faq"
                                    style="">
                                    <div class="card-body">
                                        It's your right to be informed that we will process these details for flight
                                        booking because according to airline travelling
                                        passenger information is required in order to hold the seat
                                        &amp; to update regarding your ticket in the future.
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-transparent">
                                <div class="card-header bg-transparent" id="faqhead3">
                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse"
                                        data-target="#faq3" aria-expanded="true" aria-controls="faq3">What if I need
                                        to add more Passengers ?</a>
                                </div>

                                <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                    <div class="card-body">
                                        We always ensure to provide you the best and if more than 1 passenger is
                                        travelling then you will get a 5% discount for each person.
                                        Which you can avail by contacting one of our support team members by chat or on
                                        call.
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-transparent">
                                <div class="card-header bg-transparent" id="faqhead4">
                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse"
                                        data-target="#faq4" aria-expanded="true" aria-controls="faq3">Can I add more
                                        bags ? </a>
                                </div>

                                <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                    <div class="card-body">
                                        Hand carry is by default you will be getting apart from that if you wanted to
                                        add more Checked Bag (More Suitcase) or Weight (In KG) then Yes you can &amp;
                                        for that you need to confirm from one of our team members by chat or call.

                                    </div>
                                </div>
                            </div>
                            <div class="card bg-transparent">
                                <div class="card-header bg-transparent" id="faqhead5">
                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse"
                                        data-target="#faq5" aria-expanded="true" aria-controls="faq5">Once I booked
                                        but if in future I need to make any changes how will that work ?</a>
                                </div>

                                <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                                    <div class="card-body">
                                        After you complete the booking &amp; you have your ticket. Later if any changes
                                        need to be made for that you will be having 2 options.
                                        Either changes can be made directly from the airline or It can be done from our
                                        side according to the airline rules. </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function togglePaxBox(tKey) {
        let checkBox = document.getElementById("pax-check-" + tKey);
        let paxBox = document.getElementById("pax-box-" + tKey);

        if (checkBox.checked) {
            paxBox.style.display = "flex";
        } else {
            paxBox.style.display = "none";
        }
    }
</script>

<!-- Pikaday CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">

<!-- Moment.js (required by Pikaday) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Pikaday JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var datepickers = document.querySelectorAll('.datepicker');

        datepickers.forEach(function (element) {
          
            var picker = new Pikaday({
                field: element,
                format: 'YYYY-MM-DD',
                yearRange: [1900, moment().year()],
                showYearDropdown: true,
               
            });
        });
    });
</script>

<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
