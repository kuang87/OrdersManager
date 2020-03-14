<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link  {{Request::is('weather*') ? 'active' : ''}}" href="{{route('weather')}}">
                    <span data-feather="home"></span>
                    Weather
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request::is('orders*') ? 'active' : ''}}" href="{{route('orders.index')}}">
                    <span data-feather="file"></span>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request::is('products*') ? 'active' : ''}}" href="{{route('products.index')}}">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Partners
                </a>
            </li>
        </ul>
    </div>
</nav>
