<!-- Aside (Mobile Navigation) -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<?php
$currency_code = session('currency_code');
$currency_id = session('currency_id');
$rate = session('currency_rate');
if ($currency_id == '') {
    $currency_code = app('settings')->currency;
    $currency_id = app('settings')->currency_id;
    $rate = '1';
}
?>

<?php
$language = session('lang');
if ($language == '') {
    $language = 'ENG';
}
?>
<!-- search popup start-->

<div class="td-search-popup" id="td-search-popup">
    {!! Form::open(['route' => 'search_path', 'class' => 'search-form']) !!}
    @if ($language == 'ENG')
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Type here" required name="keyword" value="">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    @else
        <div class="form-group">
            <input type="text" class="form-control" placeholder="ابحث" required name="keyword" value="">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    @endif
    {!! Form::close() !!}
</div>
<!-- search popup end-->

<!--header mobile -->
<aside class="sigma_aside sigma_aside-left">
    <div class="aside-scroll">
        <ul>
            @if ($language == 'ENG')
                <li class="menu-item">
                    <a href="{{ route('home_path') }}"
                        class="{{ request()->routeIs('home_path') ? 'active' : '' }}">Home</a>
                </li>
            @else
                <li class="menu-item">
                    <a href="{{ route('home_path') }}"
                        class="{{ request()->routeIs('home_path') ? 'active' : '' }}">الصفحة الرئيسية</a>
                </li>
            @endif
            @if ($language == 'ENG')
                <li class="menu-item menu-item-has-children">
                    <a href="#"
                        class="{{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('history') ? 'active' : '' }}">About</a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('about') }}"
                                class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                        <li class="menu-item"><a href="{{ route('history') }}"
                                class="{{ request()->routeIs('history') ? 'active' : '' }}">History</a></li>
                        <li class="menu-item"><a href="{{ route('team') }}"
                                class="{{ request()->routeIs('team') ? 'active' : '' }}">Team</a></li>
                    </ul>
                </li>
            @else
                <li class="menu-item menu-item-has-children">
                    <a href="#"
                        class="{{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('history') ? 'active' : '' }}">About</a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('about') }}"
                                class="{{ request()->routeIs('about') ? 'active' : '' }}">معلومات عنا</a></li>
                        <li class="menu-item"><a href="{{ route('history') }}"
                                class="{{ request()->routeIs('history') ? 'active' : '' }}">تاريخنا</a></li>
                        <li class="menu-item"><a href="{{ route('team') }}"
                                class="{{ request()->routeIs('team') ? 'active' : '' }}">الفريق</a></li>
                    </ul>
                </li>
            @endif
            <li class="menu-item menu-item-has-children">
                @if ($language == 'ENG')
                    <a href="#"
                        class="{{ request()->routeIs('products_spices') || request()->routeIs('products_herbs') || request()->routeIs('product_details') ? 'active' : '' }}">Products</a>
                @else
                    <a href="#"
                        class="{{ request()->routeIs('products_spices') || request()->routeIs('products_herbs') || request()->routeIs('product_details') ? 'active' : '' }}">المنتجات</a>
                @endif
                <ul class="sub-menu">
                    @foreach (app('categories')->root_items as $c)
                        <?php
                        if ($c->category->seo_url) {
                            $seo_url = seoFriendly($c->category->seo_url);
                        } else {
                            $seo_url = seoFriendly($c->title);
                        }
                        ?>
                        <li class="menu-item">
                            <a href="{{ route('category_products_path', [$c->destination_id, $seo_url]) }}"
                                class="{{ request()->routeIs('products_spices') ? 'active' : '' }}">
                                @if ($language == 'ENG')
                                    {{ $c->title }}
                                @elseif($c->arabic != null)
                                    {{ $c->arabic->title }}
                                @endif
                            </a>
                        </li>
                    @endforeach

                </ul>
            </li>
            @if ($language == 'ENG')
                <li class="menu-item">
                    <a href="{{ route('recipes') }}"
                        class="{{ request()->routeIs('recipes') ? 'active' : '' }}">Recipes</a>
                </li>
            @else
                <li class="menu-item">
                    <a href="{{ route('recipes') }}"
                        class="{{ request()->routeIs('recipes') ? 'active' : '' }}">الوصفات</a>
                </li>
            @endif
            @if ($language == 'ENG')
                <li class="menu-item">
                    <a href="{{ route('packing') }}"
                        class="{{ request()->routeIs('packing') ? 'active' : '' }}">Packing</a>
                </li>
            @else
                <li class="menu-item">
                    <a href="{{ route('packing') }}"
                        class="{{ request()->routeIs('packing') ? 'active' : '' }}">التعبئة</a>
                </li>
            @endif
            @if ($language == 'ENG')
                <li class="menu-item">
                    <a href="{{ route('contact_path') }}"
                        class="{{ request()->routeIs('contact_path') ? 'active' : '' }}">Contact</a>
                </li>
            @else
                <li class="menu-item">
                    <a href="{{ route('contact_path') }}"
                        class="{{ request()->routeIs('contact_path') ? 'active' : '' }}">اتصل
                        بنا</a>
                </li>
            @endif
        </ul>
    </div>
</aside>
<div class="sigma_aside-overlay aside-trigger-left"></div>

<!-- Header Start -->
<header class="main-header header-1 can-sticky">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <ul class="left-side">
                        <li>
                            <a href="mailto:export@abido.com">
                                <i class="fas fa-info-circle"></i>
                                export@abido.com
                            </a>
                        </li>
                        <li>
                            <a href="tel:+9611654369">
                                <i class="fas fa-phone"></i>
                                +961 1 654 369
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="right-side navbar">

                        <li class="menu-item menu-item-has-children">
                            <a href="#language">{{ $language }}</a>

                            <ul class="submenu">
                                <li class="menu-item">
                                    <a href="#language" onclick="lang_change('ENG')">English</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#language" onclick="lang_change('AR')">Arabic</a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item menu-item-has-children">
                            <a>{{ $currency_code }}</a>

                            <ul class="submenu">
                                <li class="menu-item">
                                    <a href="#" onclick="currency_change('USD','1','96');">USD</a>
                                </li>

                                @foreach (app('settings')->multicurrencies as $c)
                                    <li class="menu-item">
                                        <a href="#{{ $currency_code }}"
                                            onclick="currency_change('{{ $c->currency->code }}','{{ $c->rate }}','{{ $c->currency->id }}');">{{ $c->currency->code }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li>
                            @if ($language == 'ENG')
                                <a href="{{ route('sign_in_path') }}">Sign-in </a>
                            @else
                                <a href="{{ route('sign_in_path') }}">تسجيل الدخول</a>
                            @endif
                            <span style="color:#fff">|</span>
                            @if ($language == 'ENG')
                                <a href="{{ route('sign_up_path') }}">Register </a>
                            @else
                                <a href="{{ route('sign_up_path') }}">تسجيل </a>
                            @endif

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <!-- Logo -->
            <li class="logo-wrapper">
                <!-- Logo -->
                <a class="navbar-brand" href="/"> <img src="{{ asset('/img/logo-header.svg') }}"
                        alt="logo" /> </a>
            </li>
            <!-- Menu -->
            <ul class="navbar-nav">
                @if ($language == 'ENG')
                    <li class="menu-item">
                        <a href="{{ route('home_path') }}"
                            class="{{ request()->routeIs('home_path') ? 'active' : '' }}">Home</a>
                    </li>
                @else
                    <li class="menu-item">
                        <a href="{{ route('home_path') }}"
                            class="{{ request()->routeIs('home_path') ? 'active' : '' }}">الصفحة الرئيسية</a>
                    </li>
                @endif
                @if ($language == 'ENG')
                    <li class="menu-item menu-item-has-children">
                        <a href="#"
                            class="{{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('history') ? 'active' : '' }}">About</a>
                        <ul class="submenu">
                            <li class="menu-item"><a href="{{ route('about') }}"
                                    class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                            <li class="menu-item"><a href="{{ route('history') }}"
                                    class="{{ request()->routeIs('history') ? 'active' : '' }}">History</a></li>
                            <li class="menu-item"><a href="{{ route('team') }}"
                                    class="{{ request()->routeIs('team') ? 'active' : '' }}">Team</a></li>
                        </ul>
                    </li>
                @else
                    <li class="menu-item menu-item-has-children">
                        <a href="#"
                            class="{{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('history') ? 'active' : '' }}">معلومات
                            عنا</a>
                        <ul class="submenu">
                            <li class="menu-item"><a href="{{ route('about') }}"
                                    class="{{ request()->routeIs('about') ? 'active' : '' }}">معلومات عنا</a></li>
                            <li class="menu-item"><a href="{{ route('history') }}"
                                    class="{{ request()->routeIs('history') ? 'active' : '' }}">تاريخ</a></li>
                            <li class="menu-item"><a href="{{ route('team') }}"
                                    class="{{ request()->routeIs('team') ? 'active' : '' }}">فريق</a></li>
                        </ul>
                    </li>
                @endif
                <li class="menu-item menu-item-has-children">
                    <a href="#"
                        class="{{ request()->routeIs('products_spices') || request()->routeIs('products_herbs') || request()->routeIs('product_details') ? 'active' : '' }}">
                        @if ($language == 'ENG')
                            Products
                        @else
                            منتجات
                        @endif
                    </a>
                    <ul class="submenu">
                        @foreach (app('categories')->root_items as $c)
                            <?php
                            if ($c->category->seo_url) {
                                $seo_url = seoFriendly($c->category->seo_url);
                            } else {
                                $seo_url = seoFriendly($c->title);
                            }
                            ?>
                            <li class="menu-item">
                                <a href="{{ route('category_products_path', [$c->destination_id, $seo_url]) }}"
                                    class="{{ request()->routeIs('products_spices') ? 'active' : '' }}">
                                    @if ($language == 'ENG')
                                        {{ $c->title }}
                                    @elseif($c->arabic != null)
                                        {{ $c->arabic->title }}
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('recipes') }}"
                        class="{{ request()->routeIs('recipes') || request()->routeIs('recipe_details') ? 'active' : '' }}">
                        @if ($language == 'ENG')
                            Recipes
                        @else
                            وصفات
                        @endif
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('packing') }}" class="{{ request()->routeIs('packing') ? 'active' : '' }}">
                        @if ($language == 'ENG')
                            Packing
                        @else
                            التعبئة
                        @endif
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('contact_path') }}"
                        class="{{ request()->routeIs('contact_path') ? 'active' : '' }}">
                        @if ($language == 'ENG')
                            Contact
                        @else
                            اتصال
                        @endif
                    </a>
                </li>
            </ul>
            <div class="header-controls">
                <ul class="header-controls-inner">
                    <li class="cart-dropdown-wrapper cart-trigger">
                        <a href="{{ route('shopping_cart_path') }}" class="cart-toggle label-down link">
                            <i class="flaticon-shopping-basket"></i>
                            <span class="cart-count"
                                style=" background-color: #FE8F3E;
                                                        border-radius: 25%;
                                                        padding: 2px;
                                                        font-size: 15px;
                                                        border-radius: 50%;
                                                        width: 15px;
                                                        height: 15px;
                                                        font-size: 8px;
                                                        position: relative;
                                                        top: -25px;
                                                        right: 22px;
                                                        color:#fff;
                                                        text-align: center;
                                                        line-height: 2;
                                                        padding: 3px 6px;"
                                id="cart_total">
                                @if (Session::has('counter'))
                                    {{ session('counter') }}
                                @else
                                    0
                                @endif
                            </span></a>

                    </li>
                    <li>
                        <a class="search-bar-btn" href="#"><i class="fa fa-search"></i></a>
                    </li>
                    <div class="body-overlay" id="body-overlay"></div>

                </ul>

                <!-- Toggler -->
                <div class="aside-toggler style-2 aside-trigger-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="header-control-left">
                    <div class="aside-toggler aside-trigger-right desktop-toggler">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>
<!-- Header End -->
<!-- End of Header -->
<script>
    // update currency
    function currency_change(currency_code, rate, currency_id) {

        $.ajax({
            type: 'POST',
            url: '{{ route('currency.load') }}',
            data: {
                currency_code: currency_code,
                rate: rate,
                currency_id: currency_id,
                _token: '{{ csrf_token() }}',
            },

            success: function(response) {
                if (response['status']) {

                    location.reload();
                } else {
                    alert('server error');
                }
            }

        })
    }
</script>

<!-- update language -->
<script>
    function lang_change(name) {

        $.ajax({
            type: 'POST',
            url: '{{ route('language.load') }}',
            data: {
                lang_code: name,
                _token: '{{ csrf_token() }}',
            },

            success: function(response) {
                if (response['status']) {

                    location.reload();
                } else {
                    alert(' server error');
                }
            }

        })
    }
</script>
