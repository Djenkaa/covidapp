<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0 text-uppercase" href="{{ route('home') }}">
            <i class="fas fa-shield-virus fa-lg"></i> Covid-19
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="badge badge-light">
                            <img alt="Image placeholder" src="https://www.countryflags.io/gb/shiny/32.png"> <i class="fas fa-sort-down ml-1"></i>
                            </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Languages</h6>
                    </div>
                    <a href="#" class="dropdown-item">
                        <img src="https://www.countryflags.io/gb/shiny/24.png">
                        <span> English</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <img src="https://www.countryflags.io/rs/shiny/24.png">
                        <span> Serbian</span>
                    </a>

                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-shield-virus"></i> Covid-19
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
{{--            <form class="mt-4 mb-3 d-md-none">--}}
{{--                <div class="input-group input-group-rounded input-group-merge">--}}
{{--                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <div class="input-group-text">--}}
{{--                            <span class="fa fa-search"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-globe-americas text-primary"></i> Global
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('country') }}">
                        <i class="fas fa-flag text-primary"></i> Country

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('travel') }}">
                        <i class="fas fa-plane-departure text-primary"></i> Travel Alert
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('support')}}">
                        <button class="btn btn-primary"><i class="fab fa-paypal"></i> Support Us</button>
                    </a>
                </li>

            </ul>

            <hr class="my-3">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-sync-alt fa-lg"></i>
                        <span style="font-size: 13px;">The data is refreshed every 20 minutes</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
