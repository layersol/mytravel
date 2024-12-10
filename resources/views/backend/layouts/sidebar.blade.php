<div class="dashboard__sidebar bg-white scroll-bar-1">

    <div class="sidebar -dashboard">

      <div class="sidebar__item {{set_active_route('dashboard','active-menu')}}">


        <a href="{{route('dashboard')}}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500 ">
          <img src="{{url('assets/backend')}}/img/dashboard/sidebar/compass.svg" alt="image" class="mr-15">
          Dashboard
        </a>


      </div>

      <div class="sidebar__item {{set_active_route('/booking','active-menu')}}">


        <a href="{{ route('/booking-list') }}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
          <img src="{{url('assets/backend')}}/img/dashboard/sidebar/booking.svg" alt="image" class="mr-15">
          Booking Manager
        </a>
        
      </div>

       @can('manage booking inquiries')
      <div class="sidebar__item {{set_active_route('booking-inquiry','active-menu')}}">

         <a href="{{ route('booking-inquiry') }}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
          <img src="{{url('assets/backend')}}/img/dashboard/sidebar/booking.svg" alt="image" class="mr-15">
          Booking Inquiries
        </a>

      </div>
      @endcan

     @can('manage users')
            
      <div class="sidebar__item {{set_active_route('users','active-menu')}}">
        <a href="{{route('users.index')}}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
          <img src="{{url('assets/backend')}}/img/dashboard/sidebar/booking.svg" alt="image" class="mr-15">
          User Management
        </a>
      </div>
      
    @endcan


      @can('manageRolesPermissions')
          
      <div class="sidebar__item ">


        <div class="accordion -db-sidebar js-accordion">
          <div class="accordion__item {{ set_active_route('RolesandPermissions') }}">
            <div class="accordion__button">
              <div class="sidebar__button col-12 d-flex items-center justify-between">
                <div class="d-flex items-center text-15 lh-1 fw-500">
                  <img src="{{url('assets/backend')}}/img/dashboard/sidebar/canoe.svg" alt="image" class="mr-10">
                  Roles & Permissions
                </div>
                <div class="icon-chevron-sm-down text-7"></div>
              </div>
            </div>

            <div class="accordion__content">
              <ul class="list-disc pt-15 pb-5 pl-40">

                <li>
                  <a href="{{route('RolesandPermissions/roles.index')}}" class="text-15">All Roles</a>
                </li>

                <li>
                  <a href="{{route('RolesandPermissions/permissions.index')}}" class="text-15">All Permission</a>
                </li>

           
              </ul>
            </div>
          </div>
        </div>


      </div>
      @endcan

     @can('manage settings')
         
      <div class="sidebar__item ">

        <div class="accordion -db-sidebar js-accordion">
          <div class="accordion__item {{ set_active_route('/settings') }}">
            <div class="accordion__button">
              <div class="sidebar__button col-12 d-flex items-center justify-between">
                <div class="d-flex items-center text-15 lh-1 fw-500">
                  <img src="{{url('assets/backend')}}/img/dashboard/sidebar/gear.svg" alt="image" class="mr-10">
                  Settings
                </div>
                <div class="icon-chevron-sm-down text-7"></div>
              </div>
            </div>

            <div class="accordion__content">
              <ul class="list-disc pt-15 pb-5 pl-40">

                <li>
                  <a href="{{ route('airports.index') }}" class="text-15">Airports</a>
                </li>

                <li>
                  <a href="{{ route('/settings/section.index') }}" class="text-15">Sections</a>
                </li>

                <li>
                  <a href="{{ route('/settings/siteIdentity.index') }}" class="text-15">Site Identity</a>
                </li>
                <li>
                  <a href="{{ route('testimonials.index') }}" class="text-15">Testimonials</a>
                </li>

                <li>
                  <a href="{{ route('travel-deals.index') }}" class="text-15">Travel Deals</a>
                </li>

                <li>
                  <a href="#" class="text-15">Pages</a>
                  <ul class="list-disc pt-5 pb-5 pl-40">
                    <li>
                      <a href="{{route('/settings/about.index')}}" class="text-15">About</a>
                    </li>
                    <li>
                      <a href="{{route('/settings/contact.index')}}" class="text-15">Contact Details</a>
                    </li>

                    <li>
                      <a href="{{route('/settings/blogs.index')}}" class="text-15">Blogs</a>
                    </li>
                    <li>
                      <a href="{{route('/settings/terms.index')}}" class="text-15">Terms and Privacy</a>
                    </li>

                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </div>


      </div>
          
      @endcan

      @can('general management')
         
      <div class="sidebar__item ">

        <div class="accordion -db-sidebar js-accordion">
          <div class="accordion__item {{ set_active_route('/general') }}">
            <div class="accordion__button">
              <div class="sidebar__button col-12 d-flex items-center justify-between">
                <div class="d-flex items-center text-15 lh-1 fw-500">
                  <img src="{{url('assets/backend')}}/img/dashboard/sidebar/gear.svg" alt="image" class="mr-10">
                  General Management
                </div>
                <div class="icon-chevron-sm-down text-7"></div>
              </div>
            </div>

            <div class="accordion__content">
              <ul class="list-disc pt-15 pb-5 pl-40">

                <li>
                  <a href="{{ route('/general/contact-queries') }}" class="text-15">Contact Queries</a>
                </li>

              </ul>
            </div>
          </div>
        </div>


      </div>
          
      @endcan

      <div class="sidebar__item ">

        <form action="{{route('logout')}}" method="post">
          @csrf
        <button class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
          <img src="{{url('assets/backend')}}/img/dashboard/sidebar/log-out.svg" alt="image" class="mr-15">
          Logout
        </button>
       </form>

      </div>

    </div>

  </div>