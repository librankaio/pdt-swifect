<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
        <a class="navbar-brand" href="{{ 'dashboard' }}">GLT-WMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ 'dashboard' }}"><i class="fas fa-sign-in-alt"></i><span> Inbound</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ 'outbound' }}"><i class="fas fa-sign-out-alt"></i><span> Outbound</span></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ 'lokasi' }}"><i class="fas fa-map-marker-alt"></i><span> Lokasi</span></a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ 'logout' }}"><i class="fas fa-power-off"></i><span> Logout</span></a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
            </li>
        </ul>
        </div>
    </div>
    </nav>