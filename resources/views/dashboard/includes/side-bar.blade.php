<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
          <a class="nav-link " href="{{route('dashboard')}}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
          </a>
      </li>
      <!-- End Dashboard Nav -->
      <li class="nav-item">
          <a class="nav-link " href="{{route('home')}}">
              <i class="fa-solid fa-globe"></i>
              <span>Website</span>
          </a>
      </li>
      <!-- End website Nav -->

      {{-- Users --}}
      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="users-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
              <li>
                  <a href="{{route('users.admins')}}">
                      <i class="fa-solid fa-user-tie fs-5"></i><span>Admin</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('users.trainers')}}">
                      <i class="fas fa-chalkboard-teacher fs-5"></i><span>Trainer</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('users.customers')}}">
                      <i class="fas fa-user fs-5"></i><span>Customer</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('users.index')}}">
                      <i class="fa-sharp fa-solid fa-i fs-5"></i><span>Index</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('users.create')}}">
                      <i class="fa-solid fa-plus fs-5"></i><span>Create</span>
                  </a>
              </li>
          </ul>
      </li>

      {{-- Plans --}}
      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#plans-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-menu-button-wide"></i><span>Plans</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="plans-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
              <li>
                  <a href="{{route('plans.index')}}">
                      <i class="fa-sharp fa-solid fa-i fs-5"></i><span>Index</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('plans.create')}}">
                      <i class="fa-solid fa-plus fs-5"></i><span>Create</span>
                  </a>
              </li>
          </ul>
      </li>

      {{-- Blogs --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#blogs-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="blogs-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('blogs.index')}}">
                    <i class="fa-sharp fa-solid fa-i fs-5"></i><span>Index</span>
                </a>
            </li>
            <li>
                <a href="{{route('blogs.create')}}">
                    <i class="fa-solid fa-plus fs-5"></i><span>Create</span>
                </a>
            </li>
        </ul>
    </li>
      
  </ul>
</aside>
