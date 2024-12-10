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
      .input_select_label{
        top: 18px !important;
      }
      .image_error p{
          color: red;
      }
      .passenger-heading{
        color: var(--color-blue-1) !important;
      }
    </style>
  <div class="dashboard__main">
      <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
          <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">View Inquiry</h1>
            <div class="text-15 text-light-1">You can view inquiry from here.</div>

          </div>

        </div>
        
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls justify-content-between">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Inquiry Information</button>
               
              </div>
              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Inquiry Date : {{ $inquiries->created_at->format('M,d Y h:i a') }}</button>
              </div>
              
          </div>
        <form action="{{ route('booking-inquiry-update',$inquiries->id) }}" method="post">
          @csrf
          <div class="row">
          <div class="col-md-8 mt-3 mb-3">
           
            <div class="form-input">
              <x-text-input id="comment" name="comment" type="text" :value="$inquiries->comment" />
              <label class="lh-1 text-16 text-light-1">Comment</label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('comment')" />

          </div>
          @if (!empty($inquiries->viewedBy))
              
          <div class="col-md-4 mt-3">By: <span class="text-primary">{{ $inquiries->viewedBy->name }}-[{{ $inquiries->viewedBy->email }}]</span></div>
          @endif

        </div>
          <div class="d-inline mt-3">

            <button  class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
              Add <div class="icon-arrow-top-right ml-15"></div>
            </button>

          </div>
        </form>
           <form method="get" action="#">
           
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">

                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-12">
                  <div class="row x-gap-20 y-gap-20">
                   
                    <div class="col-md-4">

                      <div class="form-input">
                        <x-text-input id="pnr_no" name="pnr_no" type="text" :value="$inquiries->name" />
                        <label class="lh-1 text-16 text-light-1">Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('pnr_no')" />

                    </div>

                    <div class="col-md-4">

                      <div class="form-input ">
                        <x-text-input id="destinations" name="destinations" type="text" :value="$inquiries->email"/>
                        <label class="lh-1 text-16 text-light-1">Email</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('destinations')" />

                    </div>

                    <div class="col-md-4">

                      <div class="form-input ">
                        <x-text-input id="departure_date" name="departure_date" type="text" :value="$inquiries->mobile"/>
                        <label class="lh-1 text-16 text-light-1">Mobile</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('departure_date')" />

                    </div>
                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="return_date" name="return_date" type="text" :value="$inquiries->departure_full"/>
                        <label class="lh-1 text-16 text-light-1">Departrue</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('return_date')" />

                    </div>
                    <div class="col-md-6">

                        <div class="form-input ">
                          <x-text-input id="bags" name="bags" type="text" :value="$inquiries->arrival_full" />
                          <label class="lh-1 text-16 text-light-1">Arrival</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('bags')" />
  
                      </div>
                      <div class="col-md-2">
                        <div class="form-input ">
                            <select name="tripType" class="input_select">
                            <option>{{ $inquiries->return_date!=null?'Round' : 'Single' }}</option>
                           
                            </select>
                            <label class="lh-1 text-16 text-light-1 input_select_label">Trip Type</label>
                            </div>
                        <x-input-error class="mt-2" :messages="$errors->get('tripType')" />
  
                      </div>
                      <div class="col-md-2">

                        <div class="form-input ">
                          <x-text-input id="ticket_status" name="ticket_status" type="text" :value="$inquiries->adult" />
                          <label class="lh-1 text-16 text-light-1">Adult</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('ticket_status')" />
  
                      </div>
                      <div class="col-md-2">

                        <div class="form-input ">
                          <x-text-input id="total_amount" name="total_amount" type="text" :value="$inquiries->child" />
                          <label class="lh-1 text-16 text-light-1">Child</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
  
                      </div>
                      <div class="col-md-2">

                        <div class="form-input ">
                          <x-text-input id="total_amount" name="total_amount" type="text" :value="$inquiries->infant" />
                          <label class="lh-1 text-16 text-light-1">Infant</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
  
                      </div>
                      <div class="col-md-2">

                        <div class="form-input ">
                          <x-text-input id="total_amount" name="total_amount" type="text" :value="$inquiries->departure_date" />
                          <label class="lh-1 text-16 text-light-1">Dep-Date</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
  
                      </div>
                      <div class="col-md-2">

                        <div class="form-input ">
                          <x-text-input id="total_amount" name="total_amount" type="text" :value="$inquiries->return_date" />
                          <label class="lh-1 text-16 text-light-1">Ret-Date</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
  
                      </div>
                     
                  </div>
                </div>

                <div class="d-inline-block pt-30">

                  <a href="{{ route('booking-inquiry') }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    Back <div class="icon-arrow-top-right ml-15"></div>
                  </a>

                </div>
                
              </div>
            </div>

            </form>

          </div>
         
        </div>


  @endsection
     