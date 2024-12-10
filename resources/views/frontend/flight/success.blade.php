@include('frontend.layouts.header-search')


<!-- ========== MAIN CONTENT ========== -->
<main id="content" class="bg-gray space-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
               
                <div class="mb-5 shadow-soft bg-white rounded-sm">
                    <div class="py-3 px-4 px-xl-12 border-bottom">
                        <ul class="list-group flex-nowrap overflow-auto overflow-md-visble list-group-horizontal list-group-borderless flex-center-between pt-1">
                            <li class="list-group-item text-center flex-shrink-0 flex-xl-shrink-1">
                                <div class="flex-content-center mb-3 width-40 height-40 bg-primary border  border-width-2 border-gray text-white mx-auto rounded-circle">
                                    1
                                </div>
                                <div class="text-primary">Customer information</div>
                            </li>
                            <li class="list-group-item text-center flex-shrink-0 flex-xl-shrink-1">
                                <div class="flex-content-center mb-3 width-40 height-40 bg-primary border-width-2 border border-primary text-white mx-auto rounded-circle">
                                    2
                                </div>
                                <div class="text-primary">Payment information</div>
                            </li>
                            <li class="list-group-item text-center flex-shrink-0 flex-md-shrink-1">
                                <div class="flex-content-center mb-3 width-40 height-40 bg-primary border  border-width-2 border-gray mx-auto text-white rounded-circle">
                                    3
                                </div>
                                <div class="text-primary">Booking is confirmed!</div>
                            </li>
                        </ul>
                    </div>
                   
                </div>

                <div class="mb-5 shadow-soft bg-white rounded-sm">
                        
                    <div class="py-6 px-5 border-bottom">
                        <div class="flex-horizontal-center">

                            @if ($ticketDetails->payment_status=='succeeded')

                            <div class="height-50 width-50 flex-shrink-0 flex-content-center bg-primary rounded-circle">
                                @if ($ticketDetails->payment_status=='succeeded')
                                <i class="flaticon-tick text-white font-size-24"></i>
                                @else
                                <i class=" text-white font-size-24">!</i>

                                @endif
                            </div>

                            <div class="ml-3">
                                <h3 class="font-size-18 font-weight-bold text-dark mb-0 text-lh-sm">
                                    Thank You. Your Booking Order is Confirmed Now.
                                </h3>
                                <p class="mb-0">A confirmation email has been sent to your provided email address.</p>
                            </div>
                     @else
                     <div class="ml-3">
                        <h3 class="font-size-18 font-weight-bold text-dark mb-0 text-lh-sm">
                            There is a problem with your payment information. Payment was not successfull.
                        </h3>
                        <p class="mb-0">The payment was not successfull. You might need to wait for payment verification.</p>
                    </div>
                    @endif

                        </div>
                    </div>

                    <div class="pt-4 pb-5 px-5 border-bottom">
                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
                            Traveler Information
                        </h5>
                        <!-- Fact List -->
                        <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                            <li class="d-flex justify-content-between py-2 px-2">
                                <span class="font-weight-medium">Booking number</span>
                                <span class="text-secondary text-right">{{ $ticketDetails->pnr_no }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 px-2">
                                <span class="font-weight-medium">First name</span>
                                <span class="text-secondary text-right">{{ $ticketDetails->p_name }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 px-2">
                                <span class="font-weight-medium">Last name</span>
                                <span class="text-secondary text-right">{{ $ticketDetails->p_surname }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 px-2">
                                <span class="font-weight-medium">E-mail address</span>
                                <span class="text-secondary text-right">{{ $ticketDetails->email }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 px-2">
                                <span class="font-weight-medium">Contact No</span>
                                <span class="text-secondary text-right">{{ $ticketDetails->contact_no }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 px-2">
                                <span class="font-weight-medium">Trip Type</span>
                                <span class="text-secondary text-right">{{ $ticketDetails->tripType }}</span>
                            </li>

                        </ul>
                        <!-- End Fact List -->
                    </div>
                    <div class="pt-4 pb-5 px-5 border-bottom">
                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-3">
                            Payment
                        </h5>
                        <p class="">
                            @if ($ticketDetails->payment_status=='succeeded')
                            Your payment has been done. We might still need to verify it with. You will get confirmation after verification . Trx id : <a href="#" class="text-underline text-primary">{{ $ticketDetails->txn_id }}</a>
                            @else
                            Your payment was not succeeded you may need wait to payment completion.
                            @endif
                        </p>

                        <a href="#" class="text-underline text-primary"></a>
                    </div>
                   
                </div>
            </div>
            @include('frontend.flight.partials.proceed-right')

        </div>
    </div>
</main>


<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
