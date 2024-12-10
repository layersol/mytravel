@include('frontend.layouts.header-search')

@php
$pyamentIntent=$pyamentIntent; 
$getid=$result->id;
@endphp 

<script src="https://js.stripe.com/v3/"></script>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" class="bg-gray space-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
               
                <div class="mb-5 shadow-soft bg-white rounded-sm">
                    <div class="py-3 px-4 px-xl-12 border-bottom">
                        <ul class="list-group flex-nowrap overflow-auto overflow-md-visble list-group-horizontal list-group-borderless flex-center-between pt-1">
                            <li class="list-group-item text-center flex-shrink-0 flex-xl-shrink-1">
                                <div class="flex-content-center mb-3 width-40 height-40 border  border-width-2 border-gray mx-auto rounded-circle">
                                    1
                                </div>
                                <div class="text-gray-1">Customer information</div>
                            </li>
                            <li class="list-group-item text-center flex-shrink-0 flex-xl-shrink-1">
                                <div class="flex-content-center mb-3 width-40 height-40 bg-primary border-width-2 border border-primary text-white mx-auto rounded-circle">
                                    2
                                </div>
                                <div class="text-primary">Payment information</div>
                            </li>
                            <li class="list-group-item text-center flex-shrink-0 flex-md-shrink-1">
                                <div class="flex-content-center mb-3 width-40 height-40 border  border-width-2 border-gray mx-auto rounded-circle">
                                    3
                                </div>
                                <div class="text-gray-1">Booking is confirmed!</div>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4">
                            Payment Information
                        </h5>
                     
                        <!-- End Nav Classic -->

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade pt-8 show active" id="pills-one-example2" role="tabpanel" aria-labelledby="pills-one-example2-tab">
                                <!-- Payment Form -->
                                <form id="payment-form">

                                    <div id="payment-element"></div>

                                    <div class="col-sm-12 align-self-end">
                                        <div class="text-right">
                                            <button type="submit" id="pay-btn" class="btn btn-primary btn-wide rounded-sm transition-3d-hover font-size-16 font-weight-bold py-3 mt-2">Pay</button>
                                        </div>
                                    </div>

                                    <div id="error-messages text-danger"></div>
                            
                                </form>  
                                <!-- End Payment Form -->
                            </div>

                        </div>
                        <!-- End Tab Content -->
                    </div>
                </div>

                
            </div>
            
            @include('frontend.flight.partials.proceed-right')

        </div>
    </div>
</main>

<script>
    const stripe=Stripe('pk_test_51M7Z55ISOsxBdZn7Jen4rzf8Tk9qmVkzqqI1OrEqVcH7tu3NiPzgLHLVjY9ODnGegwMOHYh7wtQ5gwtpmiGcW0JG00ODxfXwso');
    const elements =stripe.elements({
        clientSecret:'{{ $pyamentIntent->client_secret }}'
    })
    const paymentElement=elements.create('payment')
    paymentElement.mount('#payment-element')
    const form=document.getElementById('payment-form')
    const payButton = document.getElementById('pay-btn');
    const messages = document.getElementById('error-messages');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
       

        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: window.location.href.split('?')[0] = '{{route("/payment-proceed",$getid)}}'
            }
        });

        if (error) {
            messages.innerText = error.message;
        } 
    });

</script>
<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
