<header class="main-header clearfix">
    <div class="main-header__logo">
        <a href="">
            <img src="{{ asset('all/website/assets/images/resources/logo-bms.png') }}" alt="">
        </a>
    </div>
    <div class="main-menu-wrapper">
        <div class="main-menu-wrapper__top">
            <div class="main-menu-wrapper__top-inner">
                <div class="main-menu-wrapper__left">
                    <div class="main-menu-wrapper__left-content">
                        <div class="main-menu-wrapper__left-text">
                            <p>Welcome to the Banking System</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="main-menu-wrapper__bottom">
            <nav class="main-menu">
                <div class="main-menu__inner">
                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                    <ul class="main-menu__list">


                        @if (!Auth::check())
                        <li class="{{ Route::currentRouteName() == ('login') ? 'current' : '' }}"><a
                                href="{{ route('login') }}">Login</a> </li>
                        @else
                        <li class="{{ Route::currentRouteName() == ('user.dashboard') ? 'current' : '' }}"><a
                                href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        @endif

                    </ul>
                    <div class="main-menu__right">
                        {{-- <a href="#" class="main-menu__search search-toggler icon-magnifying-glass"></a>
                        <a href="#" class="main-menu__cart icon-shopping-cart  "></a> --}}
                        <div class="main-menu__phone-contact">
                            <div class="main-menu__phone-icon">
                                <span class="icon-chat"></span>
                            </div>
                            <div class="main-menu__phone-number">
                                <p>Call Anytime</p>
                                <a href="tel:07395342872">+44 7395 342872</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

</header>