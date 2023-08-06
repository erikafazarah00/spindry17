<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item @if (Request::segment(1) == 'dashboard') active @endif">
                    <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment(1) == 'hero') active @endif">
                    <a href="{{ url('/hero') }}" class='sidebar-link'>
                        <i class="fa-solid fa-mask"></i>
                        <span>Hero</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment(1) == 'promotion') active @endif">
                    <a href="{{ url('/promotion') }}" class='sidebar-link'>
                        <i class="fa-solid fa-percent"></i>
                        <span>Promotion</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment(1) == 'partner') active @endif">
                    <a href="{{ url('/partner') }}" class='sidebar-link'>
                        <i class="fa-solid fa-handshake"></i>
                        <span>Partner</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment(1) == 'service') active @endif">
                    <a href="{{ url('/service') }}" class='sidebar-link'>
                        <i class="fa-solid fa-sink"></i>
                        <span>Service</span>
                    </a>
                </li>
                <li class="sidebar-item @if (Request::segment(1) == 'order') active @endif">
                    <a href="{{ url('/order') }}" class='sidebar-link'>
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Order</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'> 
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a> 
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>