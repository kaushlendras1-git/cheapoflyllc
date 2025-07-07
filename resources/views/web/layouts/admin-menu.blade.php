  <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu flex-grow-0">

              <div class="container-xxl d-flex h-100">

                <ul class="menu-inner">

                  <!-- Dashboards -->

                  <li class="menu-item active">

                    <a href="{{route('admin.dashboard')}}" class="menu-link">

                      <i class="menu-icon icon-base ri ri-home-smile-line"></i>

                      <div>Dashboards</div>

                    </a>

                  </li>

                  <li class="menu-item me-auto">

                    <a href="#" class="menu-link fw-bold">

                      <div>
                        @if (Auth::check()) 
                          Hi, {{ Auth::user()->name }}
                        @endif
                      </div>
                    </a>
                  </li>

  



                  <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'teams') ? 'active' : '' }}">
                    <a href="" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ri ri-article-line"></i>
                      <div data-i18n="Masters">Masters</div>
                    </a>
                    <ul class="menu-sub"> 
                      
                      <li class="menu-item">
                        <a href="{{route('emails.index')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Emails">Emails</div>
                        </a>
                      </li>
                     
                      <li class="menu-item">
                        <a href="{{route('teams.index')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Teams">Teams</div>
                        </a>
                      </li>

                      <li class="menu-item">
                        <a href="{{route('campaign.index')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Campaign">Campaign</div>
                        </a>
                      </li>

                      <li class="menu-item">
                        <a href="{{route('call-types.index')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="CallType">CallType</div>
                        </a>
                      </li>
                    </ul>
                  </li>


               <!-- Reports -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ri ri-article-line"></i>
                      <div data-i18n="Reports">Reports</div>
                    </a>
                    <ul class="menu-sub"> 
                      
                      <li class="menu-item">
                        <a href="{{route('marketing')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Marketing">Marketing</div>
                        </a>
                      </li>
                    
                      <li class="menu-item">
                        <a href="{{route('call_queue')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Call Queue">Call Queue</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="{{route('agents')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Agent">Agents</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="{{route('score')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                          <div data-i18n="Score">Score</div>
                        </a>
                      </li>

                    </ul>
                  </li>

                  <!-- Layouts -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ri ri-layout-2-line"></i>
                      <div data-i18n="Booking">Booking</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="{{route('booking.index')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-layout-4-line"></i>
                          <div data-i18n="Booking">Booking</div>
                        </a>
                      </li>
                      
                      <li class="menu-item">
                        <a href="{{route('booking.search')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                          <div data-i18n="Find Booking">Find Booking</div>
                        </a>
                      </li>

                      <li class="menu-item">
                        <a href="{{route('booking.add')}}" class="menu-link">
                          <i class="menu-icon icon-base ri ri-layout-top-line"></i>
                          <div data-i18n="Create Booking">Create Booking</div>
                        </a>
                      </li>

                      <li class="menu-item">
                        <a href="layouts-container.html" class="menu-link">
                          <i class="menu-icon icon-base ri ri-layout-top-2-line"></i>
                          <div data-i18n="Online Booking">Online Booking</div>
                        </a>
                      </li>
                    </ul>
                  </li>


                  <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'call-logs') ? 'active' : '' }}">
                    <a href="{{route('call-logs.index')}}" class="menu-link">
                      <i class="menu-icon icon-base ri ri-table-line"></i>
                      <div>Call Logs</div>
                    </a>
                  </li>
                  
                  <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'follow-up') ? 'active' : '' }}">
                    <a href="{{route('follow-up.index')}}" class="menu-link">
                      <i class="menu-icon icon-base ri ri-table-line"></i>
                      <div>Follow Up</div>
                    </a>
                  </li>


                  <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'users') ? 'active' : '' }}">

                    <a href="{{route('users')}}" class="menu-link">

                      <i class="menu-icon icon-base ri ri-user-line"></i>

                      <div>Users</div>

                    </a>

                  </li>

                </ul>

              </div>

            </aside>

            <!-- / Menu -->