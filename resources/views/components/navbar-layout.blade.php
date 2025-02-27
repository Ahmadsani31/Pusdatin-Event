      <nav class="navbar-classic navbar navbar-expand-lg">
          <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
          <div class="ms-lg-3 d-none d-md-none d-lg-block">
              <!-- Form -->

          </div>
          <!--Navbar nav -->
          <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
              <!-- List -->
              <li class="dropdown ms-2">
                  <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <div class="d-flex align-items-center">
                          <div class="lh-1  m-2 d-none d-md-block">
                              <h5 class="mb-1">Admin</h5>
                          </div>
                          <div class="avatar avatar-md avatar-indicators avatar-online">
                              <img alt="avatar" src="{{ asset('/') }}assets/images/avatar/avatar-1.jpg"
                                  class="rounded-circle" />

                          </div>
                      </div>


                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                      <div class="px-4 pb-0 pt-2 d-sm-block d-md-none">
                          <div class="lh-1 ">
                              <h5 class="mb-1">Admin</h5>
                              <a href="#" class="text-inherit fs-6">View my profile</a>
                          </div>
                          <div class=" dropdown-divider mt-3 mb-2"></div>

                      </div>

                      <ul class="list-unstyled">
                          <li>
                              <a class="dropdown-item" href="#"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class="me-2 icon-xxs dropdown-item-icon">
                                      <i class="fas fa-sign-out-alt"></i>
                                  </i>
                                  Sign
                                  Out
                              </a>
                              <form id="logout-form" action="" method="POST">
                                  @csrf
                              </form>
                          </li>
                      </ul>

                  </div>
              </li>
          </ul>
      </nav>
