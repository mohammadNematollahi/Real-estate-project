<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar"
    style="direction: rtl;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.home') }}">Royal<span>estate</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> منو
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.html" class="nav-link">خانه</a></li>
                <li class="nav-item"><a href="{{ route("home.property.show") }}" class="nav-link">آگهی ها</a></li>
                <li class="nav-item"><a href="{{ route('home.about') }}" class="nav-link">درباره ما</a></li>
                <li class="nav-item"><a href="{{ route('home.blog.show') }}" class="nav-link">بلاگ</a></li>
                @if (\System\Auth\Auth::checkLogin())
                    <li class="nav-item cta"><a href="" class="nav-link">{{ \System\Auth\Auth::user()->first_name . ' ' . \System\Auth\Auth::user()->last_name }}</a></li>
                @else
                    <li class="nav-item cta"><a href="{{ route('login.index') }}" class="nav-link ml-lg-1 mr-lg-5"><span
                                class="icon-user m-2"></span>ورود</a></li>
                    <li class="nav-item cta cta-colored"><a href="{{ route('register.index') }}" class="nav-link"><span
                                class="icon-pencil m-2"></span>ثبت نام</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
