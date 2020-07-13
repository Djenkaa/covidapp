<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}"><i class="fas fa-chart-line fa-lg"></i> {{__('appTerms.covidStats')}} </a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="badge badge-light">
                            <img alt="Image placeholder" src="/img/flags/32/{{app()->getLocale()}}.png"> <i class="fas fa-sort-down text-white ml-1"></i>
                        </span>
{{--                        <div class="media-body ml-2 d-none d-lg-block">--}}
{{--                            <span class="mb-0 text-sm  font-weight-bold"></span>--}}
{{--                        </div>--}}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0"><i class="fas fa-globe fa-lg"></i> {{__('appTerms.languages')}}</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a hreflang="gb" href="{{ LaravelLocalization::getLocalizedURL('gb', null, [], true) }}" class="dropdown-item">
                        <img src="/img/flags/24/gb.png">
                        <span> {{__('languages.en')}}</span>
                    </a>
                    <a hreflang="sr" href="{{ LaravelLocalization::getLocalizedURL('rs', null, [], true) }}" class="dropdown-item">
                        <img src="/img/flags/24/rs.png">
                        <span> {{__('languages.sr')}}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>


