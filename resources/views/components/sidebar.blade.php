<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Alrescha Wash</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Pesanan</li>
            <li class="{{ $type_menu === 'kasir' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('customer/kasir') }}"><i class="fas fa-reguler fa-cash-register"></i>
                    <span>Pesanan</span></a>
            </li>
            <li class="{{ Request::routeIs('customer.transaksi.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('customer/transaksi') }}"><i class="fas fa-money-bill"></i>
                    <span>Riwayat Pesanan</span></a>
            </li>
            <li class="{{ Request::routeIs('customer.user.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('customer/user') }}"><i class="fas fa-users"></i>
                    <span>Profile</span></a>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Customer
            </a>
        </div>
    </aside>
</div>
