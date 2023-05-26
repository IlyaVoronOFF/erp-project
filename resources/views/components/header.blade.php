      <!--**********************************
            Nav header start
        ***********************************-->
      <div class="nav-header">
          <a href="/" class="brand-logo">
              <img src="{{ asset('assets/images/afblogo1.png') }}" class="logo-img" width="50" height="50"
                  alt="logo">
              <span class="brand-title" width="123" height="68">АФБ</span>
          </a>
          <div class="nav-control">
              <div class="hamburger">
                  <span class="line"></span>
                  <span class="line"></span>
                  <span class="line"></span>
              </div>
          </div>
      </div>
      <!--**********************************
            Nav header end
        ***********************************-->
      <!--**********************************
            Header start
        ***********************************-->
      <div class="header">
          <div class="header-content">
              <nav class="navbar navbar-expand">
                  <div class="collapse navbar-collapse justify-content-between">
                      <div class="header-left">
                          <div class="dashboard_bar">
                              @section('title') @show
                          </div>
                      </div>
                      <ul class="navbar-nav header-right">
                          <li class="nav-item dropdown header-profile">
                              <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                  <img src="{{ asset('assets/images/user.png') }}" alt="">
                                  <div class="header-info ms-3">
                                      <span>{{ Auth::user()->fio }}</span>
                                      <small>{{ Auth::user()->rule->name }}</small>
                                  </div>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                  <a href="#" class="dropdown-item ai-icon">
                                      <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                          width="18" height="18" viewBox="0 0 24 24" fill="none"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round">
                                          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                          <circle cx="12" cy="7" r="4"></circle>
                                      </svg>
                                      <span class="ms-2">Профиль </span>
                                  </a>
                                  <a href="{{ route('logout') }}" class="dropdown-item ai-icon"
                                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                          width="18" height="18" viewBox="0 0 24 24" fill="none"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round">
                                          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                          <polyline points="16 17 21 12 16 7"></polyline>
                                          <line x1="21" y1="12" x2="9" y2="12"></line>
                                      </svg>
                                      <span class="ms-2">Выйти </span>
                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                  </form>
                              </div>
                          </li>
                      </ul>
                  </div>
              </nav>
          </div>
      </div>
      <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
