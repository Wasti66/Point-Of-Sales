<ul class="navbar-nav">
    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/dashboard') }}">
            <i class="fa-solid fa-chart-line me-2"></i>
            <span class="mt-1">Dashboard</span>
        </a>                           
    </li>
    <!-- user profile -->
    <li class="nav-item {{ request()->is('userProfile') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/userProfile') }}">
            <i class="fa-regular fa-user me-2"></i>
            <span class="mt-1">User Profile</span>
        </a>                           
    </li>
    <!-- category -->
    <li class="nav-item {{ request()->is('category') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/category') }}">
            <i class="fa-solid fa-list me-2"></i>
            <span class="mt-1">Category</span>
        </a>                           
    </li>
    <!-- customer -->
    <li class="nav-item {{ request()->is('customer') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/customer') }}">
            <i class="fa-solid fa-users me-2"></i>
            <span class="mt-1">Customer</span>
        </a>                           
    </li>
    <!-- product -->
    <li class="nav-item {{ request()->is('product') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/product') }}">
            <i class="fa-solid fa-store me-2"></i>
            <span class="mt-1">Product</span>
        </a>                           
    </li>
    <!-- sale page -->
    <li class="nav-item {{ request()->is('salePage') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/salePage') }}">
            <i class="fa-solid fa-dollar-sign me-2"></i>
            <span class="mt-1">Create Sale</span>
        </a>                           
    </li>
    <!-- Invoice page -->
    <li class="nav-item {{ request()->is('invoice') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/invoice') }}">
            <i class="fa-solid fa-file-invoice me-2"></i>
            <span class="mt-1">Invoice</span>
        </a>                           
    </li>
    <!-- Report page -->
    <li class="nav-item {{ request()->is('reportPage') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/reportPage') }}">
            <i class="fa-solid fa-file-pdf me-2"></i>
            <span class="mt-1">Report</span>
        </a>                           
    </li>
    <!-- settings -->
    <li class="nav-item {{ request()->is('setting') ? 'active' : '' }}">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/setting') }}">
            <i class="fa-solid fa-gear me-2"></i>
            <span>Setting</span>
        </a>                           
    </li>
    <!-- logout -->
    <li class="nav-item">
        <a class="nav-link text-white d-flex align-items-center poppins-medium fw-normal" href="{{ url('/logOut') }}">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
            <span>LogOut</span>
        </a>                           
    </li>
</ul>