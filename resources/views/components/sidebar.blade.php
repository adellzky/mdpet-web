<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">MEDIPET</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Mp</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard Admin</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Manage</span></a>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="/orders">Manage Order</a>
                    </li>
                    <li class=" ">
                        <a class="nav-link" href="/products">Manage Product</a>
                    </li>

                </ul>
            </li>

            {{-- <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="/Katalog"><i class="far fa-square"></i>
                    <span>Katalog</span></a>
            </li> --}}

            <li class="{{ Request::is('posts') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('posts') }}"><i class="far fa-square"></i>
                    <span>Consultation</span></a>
            </li>


            <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                <a href="/katalogs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Catalog
                </a>
            </div>
    </aside>
</div>
