

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li>
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ url('admin/categories') }}">Categories</a>
            </li>
            <li>
                <a href="{{ url('admin/brands') }}">Brands</a>
            </li>
            <li>
                <a href="{{ url('admin/products') }}">Products</a>
            </li>
            <li>
                <a href="{{ url('admin/order') }}">Order</a>
            </li>
            <li>
                <a href="{{ url('admin/user') }}">User</a>
            </li>
            <li>
                <a href="{{ url('admin/slideshow') }}">Slideshow</a>
            </li>
            <li>
                <a href="{{ route('admin.shipping.index') }}">Shipping Cost</a>
            </li>
            <li>
                <a href="{{ url('admin/bank') }}">Bank Account</a>
            </li>
            <li>
                <a href="{{ url('admin/config') }}">Configuration</a>
            </li>
            <li>
                <a href="{{ route('admin.static.index') }}">Static Page</a>
            </li>
        </ul>
    </div>
