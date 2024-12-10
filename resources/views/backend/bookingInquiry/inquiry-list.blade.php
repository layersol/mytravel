@extends('backend.layouts.main')
@section('main-container')
  
  
  <div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
      <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

          <h1 class="text-30 lh-14 fw-600">All Booking Inquiries</h1>
          <div class="text-15 text-light-1">Find all booking inquiries list from here.</div>

        </div>

      </div>

      @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif
      @if(session()->has('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
      @endif
      <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
          <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

            <div class="col-auto">
              <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">All Inquiries</button>

            </div>


          </div>

          <div class="tabs__content pt-30 js-tabs-content">

            <div class="tabs__pane -tab-item-1 is-tab-el-active">
              <div class="overflow-scroll scroll-bar-1">
                <table class="-border-bottom col-12 nowrap" id="my-datatable">
                  <thead class="bg-light-2">
                    <tr>
                      <th>#</th>
                      <th>Picked By</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Departure</th>
                      <th>Arrival</th>
                      <th>Dep-Date</th>
                      <th>Ret-Date</th>
                      <th>Adult</th>
                      <th>Child</th>
                      <th>Infant</th>
                      <th>Trip Type</th>
                      <th>Status</th>
                      <th>Inquiry Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($inquiries as $key=>$value)
                         
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>
                        @if (!empty($value->viewedBy))
                        <span class="text-primary">{{ $value->viewedBy->name }}</span>
                        @else
                            <a href="{{route('booking-inquiry',$value['id'])}}" class="text-info">Pick</a>
                        @endif
                        </td>
                      <td><b>{{Str::words($value['name'], 1 ,'..')}}</b></td>
                      <td>{{$value['email']}}</td>
                      <td>{{$value['mobile']}}</td>
                      <td>{{Str::words($value['departure_code'], 2 ,'..')}}</td>
                      <td>{{Str::words($value['arrival_code'], 2 ,'..')}}</td>
                      <td>{{$value['departure_date']}}</td>
                      <td>{{$value['return_date']}}</td>
                      <td>{{$value['adult']}}</td>
                      <td>{{$value['child']}}</td>
                      <td>{{$value['infant']}}</td>
                      <td>{{ $value['return_date']!=null ? 'Round' :'Single' }}</td>
                       <td>

                        <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 {{$value->status=='active' ? 'bg-blue-1-05 text-blue-1':'bg-red-3 text-red-2'}}">{{$value->status}}</span>
                      </td>
                      <td>{{$value['created_at']->format('M,d Y h:i a')}}</td>
                      <td>

                        <div class="col-auto">
                          <a href="{{route('booking-inquiry',$value['id'])}}" class="bg-blue-1-05 text-blue-1">
                            <i class="icon-eye text-16 text-light-1"></i>
                          </a>
                         
                        </div>

                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>


          </div>
        </div>

      </div>

      <script>
        $(document).ready( function () {
            $('#my-datatable').DataTable({
              responsive: true,
              order: [[0, 'desc']]
            });
        } );
      </script>

  @endsection
