<div class="container-fluid bg-light">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-2 col-xl-2 px-sm-2 px-0 bg-dark min-vh-100" >
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top" >
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none py-3">
                    <h3>AHP-TOPSIS</h3>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/kriteria" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-file-bar-graph-fill"></i> <span class="ms-1 d-none d-sm-inline">Data Kriteria</span></a>
                    </li>
                    <li>
                        <a href="/alternatif" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-building-fill"></i> <span class="ms-1 d-none d-sm-inline">Data Alternatif</span></a>
                    </li>
                    <li>
                        <a href="/hasil" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-calculator-fill"></i> <span class="ms-1 d-none d-sm-inline">Hasil Alternatif</span></a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    @auth
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">{{ auth()->user()->name }}</span>
                        </a>
                    @endauth
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-auto col-md-10 px-0 py-0 sticky-right">
            <div class="px-3 sticky-top bg-light" style="padding-top: 1em">
                <p class="fs-2 "> {{ $title }} </p>
                <hr />
            </div>
            <div class="container-fluid ">
                <div class="col-12 px-3 py-3">
                    @yield('container')
                </div>

            </div>
        </div>
    </div>
</div>