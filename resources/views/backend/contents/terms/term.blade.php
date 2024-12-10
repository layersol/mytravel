@extends('backend.layouts.main')
@section('main-container')
  
  
  <div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
      <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

          <h1 class="text-30 lh-14 fw-600">Terms and Privacy</h1>
          <div class="text-15 text-light-1">Find all term list from here.</div>

        </div>
        <div class="col-auto">

            {{-- <a href="{{route('/settings/blogs.create')}}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
              Create New <div class="icon-plus ml-15"></div>
            </a> --}}
  
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
              <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">All Terms </button>

            </div>


          </div>

          <div class="tabs__content pt-30 js-tabs-content">

            <div class="tabs__pane -tab-item-1 is-tab-el-active">
              <div class="overflow-scroll scroll-bar-1">
                <table class="-border-bottom col-12 nowrap" id="my-datatable">
                  <thead class="bg-light-2">
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($terms as $key=>$term)
                         
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{Str::words($term['title'], 3, '...')}}</td>
                     

                      <td>

                        <div class="col-auto">
                          <a href="{{route('/settings/terms.edit',$term['id'])}}" class="bg-blue-1-05 text-blue-1">
                            <i class="icon-edit text-16 text-light-1"></i>
                          </a>
                           <form method="post" action="{{route('/settings/blogs.delete',$term['id'])}}" onsubmit="return confirm('Are you sure to delete')" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit"><i class="icon-trash-2 text-16 text-light-1"></i></button>
                        </form>
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
              responsive: true
            });
        } );
      </script>

  @endsection
