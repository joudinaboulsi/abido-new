<!-- Footer Start -->

<?php
$language = session('lang');
if ($language == '') {
    $language = 'ENG';
}
?>
<footer class="ct-footer footer-3 footer-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 footer-widget contact-widget">
                <ul class="contatctli">
                    <li>
                        <a href="/">
                            <img src="{{ asset('/img/logo-footer.svg') }}" alt="logo" width="200" />
                        </a>
                    </li>
                    @if ($language == 'ENG')
                        <li>
                            <i class="flaticon-email"></i>
                            export@abido.com
                        </li>
                    @else
                        <li>
                            export@abido.com
                            <i class="flaticon-email"></i>

                        </li>
                    @endif
                    @if ($language == 'ENG')
                        <li>
                            <i class="flaticon-location"></i>
                            Beirut, Lebanon
                        </li>
                    @else
                        <li>
                            <i class="flaticon-location"></i>
                            بيروت، لبنان
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-4 col-sm-6 footer-widget">
                        @if ($language == 'ENG')
                            <h5 class="widget-title">Abido Spices</h5>
                        @else
                            <h5 class="widget-title">بهارات عبيدو</h5>
                        @endif
                        <ul>
                            @if ($language == 'ENG')
                                <li><a href="{{ route('about') }}">About</a></li>
                            @else
                                <li><a href="{{ route('about') }}">معلومات عنا</a></li>
                            @endif
                            @if ($language == 'ENG')
                                <li><a href="{{ route('recipes') }}">Recipes</a></li>
                            @else
                                <li><a href="{{ route('recipes') }}">وصفات</a></li>
                            @endif
                            @if ($language == 'ENG')
                                <li><a href="{{ route('packing') }}">Packing</a></li>
                            @else
                                <li><a href="{{ route('packing') }}">التعبئة</a></li>
                            @endif
                            @if ($language == 'ENG')
                                <li><a href="{{ route('contact_path') }}">Contact</a></li>
                            @else
                                <li><a href="{{ route('contact_path') }}">اتصال</a></li>
                            @endif


                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6 footer-widget">
                        @if ($language == 'ENG')
                            <h5 class="widget-title">Legal</h5>
                        @else
                            <h5 class="widget-title">قانوني</h5>
                        @endif
                        <ul>
                            @if ($language == 'ENG')
                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            @else
                                <li><a href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
                            @endif
                            @if ($language == 'ENG')
                                <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                            @else
                                <li><a href="{{ route('terms') }}">الأحكام والشروط</a></li>
                            @endif
                            @if ($language == 'ENG')
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                            @else
                                <li><a href="{{ route('faq') }}">الأسئلة الشائعة</a></li>
                            @endif

                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6 footer-widget">
                        @if ($language == 'ENG')
                            <h5 class="widget-title">Eshop</h5>
                        @else
                            <h5 class="widget-title">متجر إلكتروني</h5>
                        @endif

                        <ul>
                            @foreach (app('categories')->root_items as $c)
                                <?php
                                if ($c->category->seo_url) {
                                    $seo_url = seoFriendly($c->category->seo_url);
                                } else {
                                    $seo_url = seoFriendly($c->title);
                                }
                                ?>
                                <li>
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
                            @if (session()->exists('user'))
                                <li><a href="{{ route('my_account_path') }}">My Account</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center mb-3 mb-lg-0">
                    @if ($language == 'ENG')
                        <p class="m-0">&copy; Copyright <?php echo date('Y'); ?>. All Rights Reserved. by <a
                                href="http://webneoo.com" target="_blank">Webneoo </a></p>
                    @else
                        <p class="m-0">&copy; <?php echo date('Y'); ?>حقوق الطبع والنشر جميع الحقوق محفوظة. بواسطة <a
                                href="http://webneoo.com" target="_blank">Webneoo </a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
