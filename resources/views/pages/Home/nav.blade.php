<nav class="navbar navbar-expand-lg bg-body-tertiary py-2 position-sticky top-0">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="images/logo-2.png" height="80" width="80" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav d-flex align-items-center">
          <a class="nav-link fw-semibold text-black px-3 fs-5" href="#">Home</a>
          <a class="nav-link fw-semibold text-black px-3 fs-5" href="#about">About</a>
          <a class="nav-link fw-semibold text-black px-3 fs-5" href="#feature">Feature</a>
          <a class="nav-link fw-semibold text-black px-3 fs-5" href="#contact">Contact</a>
          <a class="nav-link fw-semibold text-black px-3 fs-5" href="{{ url('/user-login') }}">Login</a>
          <a class="fw-semibold btn btn-info text-white px-md-5 py-md-3" href="{{ url('/user-registration') }}">Registration</a>
        </div>
      </div>
    </div>
</nav>