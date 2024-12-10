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

            <h1 class="text-30 lh-14 fw-600">Contact Page</h1>
            <div class="text-15 text-light-1">You can make changes to contact page from here.</div>

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
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Contact Page</button>
              </div>
            </div>
                    <form method="post" action="{{route('/settings/pages/contactPage.update',$contact[0]['id'])}}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
            
                        <div class="tabs__content pt-30 js-tabs-content">
                            <div class="tabs__pane -tab-item-1 is-tab-el-active">
            
            
                                 <div class="text-15 text-light-1">Contact page settings :</div>

                                    <div class="row y-gap-30 items-center">
                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <x-text-input name="phone" type="text" value="{{$contact[0]['phone']}}" />
                                                <label class="lh-1 text-16 text-light-1">Phone</label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <x-text-input name="email" type="email" value="{{$contact[0]['email']}}" />
                                                <label class="lh-1 text-16 text-light-1">email</label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-input">
                                                <x-text-input name="address" type="text" value="{{$contact[0]['address']}}" />
                                                <label class="lh-1 text-16 text-light-1">address</label>
                                            </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    
                                        </div>
                                       <div class="text-15 text-light-1">Social links: leave empty if you don't want to show any link on website.</div>

                                       @foreach (json_decode($contact[0]['social_media'],true) as $key => $social)
                                       <div class="col-md-6">
                                           <div class="form-input">
                                               <x-text-input name="social_media[{{ $key }}]" type="text" :value="$social" />
                                               <label class="lh-1 text-16 text-light-1">{{ $key }}</label>
                                           </div>
                                           <x-input-error class="mt-2" :messages="$errors->get('social_media.' . $key)" />
                                       </div>
                                   @endforeach
                                    </div>

                                </div>
 
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

  @endsection
     