 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
        
        <span class="d-none d-lg-block">
          <i class="fas fa-dumbbell"></i>
          Gym System</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#" onsubmit="redirectToPage(event)">
        <input type="text" id="searchQuery" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>
    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

       

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ Storage::url('public/profiles/' . auth()->user()->image) }}" alt="Profile Image" width="50" height="50" style="border-radius: 50%;">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->username}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
                <h6>{{ auth()->user()->fullname }}</h6>
                <span>{{ auth()->user()->email }}</span>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.show', ['username' => auth()->user()->username]) }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
            </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.edit', ['username' => auth()->user()->username]) }}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
            </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa-solid fa-sign-out-alt"></i> Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

          </ul>
          <!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->

      </ul>
    </nav>
    <!-- End Icons Navigation -->

  </header>
  <!-- End Header -->

  <script>
    function redirectToPage(event) {
      event.preventDefault();
      const query = document.getElementById('searchQuery').value.trim().toLowerCase();
  
      if (query === 'admin') {
        window.location.href = "{{ route('users.admins') }}";
      } else if (query === 'trainer') {
        window.location.href = "{{ route('users.trainers') }}";
      } else if (query === 'customer') {
        window.location.href = "{{ route('users.customers') }}";
      } else {
        alert('Page not found!');
      }
    }
  </script>