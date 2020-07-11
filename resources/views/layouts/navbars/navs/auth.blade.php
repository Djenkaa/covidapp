<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}"><i class="fas fa-chart-line fa-lg"></i> COVID-19 statistics </a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="badge badge-light">
                            <img alt="Image placeholder" src="https://www.countryflags.io/gb/shiny/32.png"> <i class="fas fa-sort-down text-white ml-1"></i>
                        </span>
{{--                        <div class="media-body ml-2 d-none d-lg-block">--}}
{{--                            <span class="mb-0 text-sm  font-weight-bold"></span>--}}
{{--                        </div>--}}
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
    </div>
</nav>
