<nav class="navbar navbar-expand px-3 border-bottom border-white">
    <button class="btn" type="button" id="sidebar-toggle">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--  -->
    <div class="collapse navbar-collapse justify-content-end">
        <div class="dropdown-center">
            <button class="btn dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!--<img id="userImage" src="" alt="User Image" class="rounded-circle" width="100" height="100">-->
            </button>
            <ul class="dropdown-menu border-0 rounded-0 shadow-sm" style="left: -75px">
                <!-- profile -->
                <li>
                <a class="dropdown-item fw-semibold text-body-emphasis d-flex align-items-center" href="{{url('/userProfile')}}">
                    <i class="fa-regular fa-user me-2"></i>
                    Profile
                </a>
                </li>
                <!-- Settings -->
                <li>
                <a class="dropdown-item fw-semibold text-body-emphasis d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear me-2"></i>
                    Settings
                </a>
                </li>
                <!-- LogOut -->
                <li>
                <a class="dropdown-item fw-semibold text-body-emphasis d-flex align-items-center" href="{{ url('/logOut') }}">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                    LogOut
                </a>
                </li>
            </ul>
        </div>
    </div>
</nav>