<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="{{ url('user') }}">
          <i class="bi bi-grid"></i>
          <span>Data User</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Houtel</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('kota') }}">
              <i class="bi bi-circle"></i><span>Data Kota</span>
            </a>
          </li>
          <li>
            <a href="{{ url('hotel') }}">
              <i class="bi bi-circle"></i><span>Data Hotel</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

    </ul>

  </aside><!-- End Sidebar-->