<!DOCTYPE html>

<?php
$language = session('lang');
if ($language == '') {
    $language = 'ENG';
}
?>
@if ($language == 'ENG')
    <html lang="en">
@else
    <html lang="ar" dir="rtl">
@endif
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


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Abido Spices</title>

    {!! SEO::generate() !!}
    <!-- Vendor Stylesheets -->
    @if ($language == 'ENG')
        <link rel="stylesheet" href="{{ asset('/css/plugins/bootstrap.min.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('/css/plugins/bootstrap.min1.css') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/plugins/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/plugins/slick-theme.css') }}" />
    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('/fonts/flaticon/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('/fonts/flaticon-2/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('/fonts/font-awesome/css/all.min.css') }}" />

    <!-- Organicz Style sheet -->
    @if ($language == 'ENG')
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('/css/style_rtl.css') }}" />
    @endif

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#731313">
    <meta name="theme-color" content="#ffffff">

</head>

<body>

    @include('layouts.sidebar')

    @include('layouts.header')

    @yield('content')

    <!-- Instagram Start -->
    {{-- <div class="insta style-6 section">
        <div class="container">
            <div class="section-title-wrap section-header text-center">
                <span><i class="fab fa-instagram"></i></span>
                <h2 class="title">Follow Us</h2>
            </div>
            <div class="insta-slider">
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <ul class="comment-list">
                            <li>
                                <i class="fas fa-heart"></i>
                                18
                            </li>
                            <li>
                                <i class="fas fa-comment"></i>
                                12
                            </li>
                        </ul>
                        <img src="{{ asset('/img/ig/slider/1.jpg') }}" alt="insta" />
                    </div>
                </div>
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <ul class="comment-list">
                            <li>
                                <i class="fas fa-heart"></i>
                                15
                            </li>
                            <li>
                                <i class="fas fa-comment"></i>
                                19
                            </li>
                        </ul>
                        <img src="{{ asset('/img/ig/slider/2.jpg') }}" alt="insta" />
                    </div>
                </div>
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <ul class="comment-list">
                            <li>
                                <i class="fas fa-heart"></i>
                                15
                            </li>
                        </ul>
                        <img src="{{ asset('/img/ig/slider/3.jpg') }}" alt="insta" />
                    </div>
                </div>
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <ul class="comment-list">
                            <li>
                                <i class="fas fa-heart"></i>
                                22
                            </li>
                            <li>
                                <i class="fas fa-comment"></i>
                                12
                            </li>
                        </ul>
                        <img src="{{ asset('/img/ig/slider/4.jpg') }}" alt="insta" />
                    </div>
                </div>
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <ul class="comment-list">
                            <li>
                                <i class="fas fa-heart"></i>
                                30
                            </li>
                            <li>
                                <i class="fas fa-comment"></i>
                                15
                            </li>
                        </ul>
                        <img src="{{ asset('/img/ig/slider/5.jpg') }}" alt="insta" />
                    </div>
                </div>
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <ul class="comment-list">
                            <li>
                                <i class="fas fa-comment"></i>
                                15
                            </li>
                        </ul>
                        <img src="{{ asset('/img/ig/slider/6.jpg') }}" alt="insta" />
                    </div>
                </div>
                <div class="insta-item">
                    <div class="insta-item-inner">
                        <img src="{{ asset('/img/ig/slider/7.jpg') }}" alt="insta" />
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- Instagram End -->

    @include('layouts.footer')

    <!-- Vendor Scripts -->
    <script src="{{ asset('/js/plugins/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/waypoint.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery.slimScroll.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/slick.min.js') }}"></script>

    <!-- Organicz Scripts -->
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">
        // Update Cart Quantity
        function addToCart(product_id, qty, option1_value = null, option2_value = null, option3_value = null) {
            $("#full_page_loader").show();
            var currency = <?php echo json_encode(app('settings')->currency); ?>;
            $.ajax({
                url: "/add-to-cart",
                method: "POST",
                data: {
                    product_id,
                    'qty': qty,
                    option1_value,
                    option2_value,
                    option3_value
                },

                headers: {
                    'X-CSRF-Token': $('.csrf-token').val()
                },
                dataType: "json",
                success: function(data) {
                    $("#full_page_loader").hide();
                    // If the variant  we are updating has enough stock and is valid
                    if (data[0]["success"] == 1) {
                        $("#cart_total").html(data[1]);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Added to Cart'
                        })

                    }
                    // If the variant does not have enough stock
                    else {
                        // We do not add the quantity to the cart
                        Swal.fire({
                            title: "Error!",
                            text: "Maximum stock reached",
                            icon: "error",
                            confirmButtonText: "Back",
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#cart_total').html(data.cart_count);
                    $("#full_page_loader").hide();
                    console.log('Status:' + jqXHR.status);
                    console.log('Text status:' + textStatus);
                    console.log('Error Thrown:' + errorThrown);
                }

            });
        }
        $("#option1, #option2, #option3").children('a').on("click", function(event) {
            event.preventDefault()
            const url = new URL(window.location.href)
            const optionName = $(this).text()
            console.log(optionName)
            $(this).siblings("input").attr("value", optionName)
            $(this).siblings("a").removeClass("active")
            $(this).addClass("active")
            const data = {
                "option1_value": $("#option1_value").val(),
                "option2_value": $("#option2_value").val(),
                "option3_value": $("#option3_value").val(),
                'product_id': $(".cart-form input[name=product_id]").val(),
                'qty': $(".cart-form input[name=qty]").val(),
            };
            const headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            $.ajax({
                type: "post",
                url: '/api/GetProductVariant/' + data.product_id,
                data,
                headers,
                beforeSend: function() {
                    $("#full_page_loader").show()
                },
                success: function(response) {
                    console.log(response)
                    $("#full_page_loader").hide()
                    $price_tag = $(".product-price > .new")
                    if (response.success === 0) {
                        $(".product-price > .new-price").hide();
                        $price_tag.text("Product not available.")
                    } else if (response.success === 1) {
                        const variant = response.variant;
                        const price = variant.price;
                        $(".product-price > .new-price").hide();
                        $price_tag.text(price);

                    }
                    // $("#cart .cart-count span").text(response.cart_count) // for jimmy jims
                },
                error: function(error) {
                    console.log(error);
                    $("#full_page_loader").hide();
                    console.log('Status:' + jqXHR.status);
                    console.log('Text status:' + textStatus);
                    console.log('Error Thrown:' + errorThrown);
                    return
                }
            })
        })
        $("#submit_addtocart").click(function() {
            var qty = $(".cart-form input[name=qty]").val();
            var product_id = $(".cart-form input[name=product_id]").val();
            const option1_value = $("#option1_value").val()
            const option2_value = $("#option2_value").val()
            const option3_value = $("#option3_value").val()
            console.log(product_id, option1_value, option2_value, option3_value)
            addToCart(product_id, qty, option1_value, option2_value, option3_value);

        })
        $(document).ready(function() {
            $("img").on("error", function() {
                $(this).attr("src", "{{ asset('images/error/no-image.png') }}")
            })
        })
    </script>
</body>

</html>
