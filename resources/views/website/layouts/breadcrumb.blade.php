<!--Page Header Start-->

<section class="page-header">
    {{-- <div class="page-header__bg" style="background-color: rgba(31, 34, 48, .95);background-image: url(assets/images/backgrounds/breadcum.jpg);"></div> --}}
    <div class="page-header__bg" style="background-color: rgba(31, 34, 48, .95);"></div>
    <!-- /.page-header__bg -->
    @if(Route::currentRouteName() == ('login'))
    <div class="container">
        <h2>Login</h2>
        <ul class="thm-breadcrumb list-unstyled">
            <li class="color-thm-gray">/</li>
            <li><span>Login</span></li>
        </ul>
    </div>
    @elseif(Route::currentRouteName() == ('register'))
    <div class="container">
        <h2>Registration</h2>
        <ul class="thm-breadcrumb list-unstyled">
            <li class="color-thm-gray">/</li>
            <li><span>Registration</span></li>
        </ul>
    </div>
    @endif


</section>
<!--Page Header End-->