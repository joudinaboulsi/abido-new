@extends('layouts.app')
@section('content')
    <?php
    if ($product->seo_url) {
        $seo_url = str_replace(' ', '-', preg_replace('/[^a-z0-9]/', '-', strtolower($product->seo_url)));
    } else {
        $seo_url = str_replace(' ', '-', preg_replace('/[^a-z0-9]/', '-', strtolower($product->title)));
    }
    
    if ($product->firstVariant->compare_at_price != null) {
        $sale_percentage = (1 - $product->firstVariant->price / $product->firstVariant->compare_at_price) * 100;
        $sale_percentage = number_format($sale_percentage, 2, '.', "'");
        $sale_percentage = strpos($sale_percentage, '.') !== false ? rtrim(rtrim($sale_percentage, '0'), '.') : $sale_percentage;
    }
    ?>

    <?php
    $language = session('lang');
    if ($language == '') {
        $language = 'ENG';
    }
    ?>

    <?php
    $currency_code = session('currency_code');
    $currency_id = session('currency_id');
    $rate = session('currency_rate');
    if ($currency_id == '') {
        $currency_code = app('settings')->currency;
        $currency_id = app('settings')->currency_id;
        $rate = 1;
    }
    ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Subheader Start -->
    <div class="subheader bg-cover dark-overlay dark-overlay-2"
        style="background-image: url('{{ asset('/img/subheader.jpg') }}');">
        <div class="absolute-subheader">
            <div class="container">
                <div class="subheader-inner">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @if ($language == 'ENG')
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('shop_path') }}">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('shop_path') }}">تسوق</a></li>
                                <li class="breadcrumb-item active" aria-current="page">تفاصيل المنتج</li>
                            @endif

                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <section class="section product-single extra-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <!-- Main Thumb -->
                    <div class="product-thumb">
                        @if (!empty($product->photoGallery))
                            @foreach ($product->photoGallery as $g)
                                <img src="{{ $g->lg_img }}" data-zoom-image="{{ $g->lg_img }}"
                                    alt="{{ $product->title }}" width="800" height="900">
                            @endforeach
                        @else
                            @include('layouts.no-image')
                        @endif

                    </div>
                    <!-- /Main Thumb -->
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="product-content">
                        <!-- Product Title -->
                        <h2 class="title">

                            @if ($language == 'ENG')
                                {{ $product->title }}
                            @elseif($product->arabic != null)
                                {{ $product->arabic->title }}
                            @endif
                        </h2>
                        <!-- /Product Title -->

                        <!-- Price -->
                        <div class="price-wrapper d-flex">
                            @if ($product->firstVariant->compare_at_price != null)
                                <p class="product-price custom-secondary">

                                    {{ $product->firstVariant->compare_at_price * $rate }} {{ $currency_code }}
                                </p>
                                <del class="old-price" style="padding:0 5px">{{ $product->firstVariant->price * $rate }}
                                    {{ $currency_code }}</del>
                            @else
                                <p class="product-price custom-secondary">{{ $product->firstVariant->price * $rate }}
                                    {{ $currency_code }}</p>
                            @endif
                        </div>
                        <!-- /Price -->

                        <!-- Product Short Description -->
                        <p>
                            @if ($language == 'ENG')
                                {!! $product->description !!}
                            @elseif($product->arabic != null)
                                {!! $product->arabic->description !!}
                            @endif
                        </p>
                        <!-- /Product Short Description -->
                        @if ($product->firstVariant->continue_selling != 0 || $product->inStock != 0)
                            <!-- Variations -->

                            @if (!empty($options['option1_name']['options']))
                                <div class="form-group product-form product-variation-form product-option1-swatch"
                                    style="clear: both;">
                                    @if ($language == 'ENG')
                                        <label>{{ $options['option1_name']['name'] }} </label>
                                    @else
                                        <label style="float: right">حجم</label>
                                    @endif
                                    <div id="option1">
                                        <select class="form-control">
                                            @foreach ($options['option1_name']['options'] as $key => $o)
                                                @if (!empty($o))
                                                    <option value="{{ $o }}">
                                                        <a href="#"> {{ $o }}</a>
                                                    </option>
                                                @endif
                                            @endforeach
                                            <input hidden name="option1_value" id="option1_value"
                                                value="{{ $options['option1_name']['options'][$key] }}">
                                        </select>
                                    </div>

                                </div>
                            @endif

                            @if (!empty($options['option2_name']['options']))
                                <div
                                    class="product-form
                                            product-variation-form product-option2-swatch">
                                    <label>{{ $options['option2_name']['name'] }} </label>
                                    <div class="flex-wrap d-flex align-items-center product-variations" id="option2">
                                        @foreach ($options['option2_name']['options'] as $o)
                                            @if (!empty($o))
                                                <a href="#">{{ $o }}</a>
                                            @endif
                                        @endforeach
                                        <input hidden name="option2_value" id="option2_value"
                                            value="{{ $options['option2_name']['options'][0] }}">
                                    </div>
                                </div>
                            @endif

                            @if (!empty($options['option3_name']['options']))
                                <div class="product-form product-variation-form product-option3-swatch">
                                    <label class="mb-1">{{ $options['option3_name']['name'] }} :</label>
                                    <div class="flex-wrap d-flex align-items-center product-variations"id="option3">
                                        @foreach ($options['option3_name']['options'] as $o)
                                            @if (!empty($o))
                                                <a href="#">{{ $o }}</a>
                                            @endif
                                        @endforeach
                                        <input hidden name="option3_value" id="option3_value"
                                            value="{{ $options['option3_name']['options'][0] }}">
                                    </div>
                                </div>
                            @endif
                            <!-- /Variations -->
                            <form class="atc-form cart-form">
                                <input class="csrf-token" type="hidden" name="_token" value="{{ csrf_token() }}">

                                <!-- Add To Cart Form -->
                                <div class="form-group">
                                    @if ($language == 'ENG')
                                        <label>Quantity</label>
                                    @else
                                        <label style="float:right">الكمية</label>
                                    @endif

                                    <input type="number" class="qty form-control" name="qty" id="add_to_cart_qty"
                                        value="1" />
                                </div>
                                <input type="hidden" name="product_id" id="add_to_cart_variant_id"
                                    value="{{ $product->id }}">

                                <button type="submit" name="button" class="btn-custom secondary" id="submit_addtocart">
                                    @if ($language == 'ENG')
                                        Add
                                        to Cart
                                    @else
                                        أضف إلى السلة
                                    @endif
                                    <i class="flaticon-shopping-basket"></i>
                                </button>
                            </form>
                            <!-- /Add To Cart Form -->
                        @else
                            <div class="product-variations-wrapper">
                                <div class="form-group d-flex">
                                    <span><b>Out of Stock</b></span>

                                </div>
                            </div>

                        @endif

                        <!-- Product Meta -->
                        <ul class="product-meta">
                            <li>
                                @if ($product->firstVariant->compare_at_price != null)
                                    @if ($language == 'ENG')
                                        <span class="product-category">Discount : </span>
                                    @else
                                        <span class="product-category">تخفيض : </span>
                                    @endif

                                    <div class="product-meta-item">
                                        @if ($product->firstVariant->compare_at_price != null)
                                            <span class="product-label label-discount"
                                                style="padding: 0 10px">{{ $sale_percentage }} %</span>
                                        @else
                                            <span style="padding: 0 10px">N/A</span>
                                        @endif
                                    </div>
                                @endif
                            </li>
                            <li>
                                @if ($language == 'ENG')
                                    <span>Categories: </span>
                                @else
                                    <span>فئات: </span>
                                @endif
                                <div class="product-meta-item">

                                    @foreach ($product->categories as $c)
                                        @if ($language == 'ENG')
                                            {{ $c->title }}
                                        @elseif($c->arabic != null)
                                            <span style="padding: 0 10px"> {{ $c->arabic->title }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                            <li>
                                @if ($language == 'ENG')
                                    <span class="product-category">Tags : </span>
                                @else
                                    <span class="product-category">العلامات:</span>
                                @endif
                                <div class="product-meta-item">
                                    @if ($product->tags)
                                        @foreach ($product->tags as $c)
                                            @if ($language == 'ENG')
                                                <span class="product-category">
                                                    {{ $c->title }}</span>
                                            @elseif($c->arabic != null)
                                                <span class="product-category" style="padding:0 10px">
                                                    {{ $c->arabic->title }} </span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span style="padding: 0 10px">N/A</span>
                                    @endif
                                    {{-- <a href="#">Spice</a>, <a href="#">Spiceie</a>,
                                <a href="#">Kitchen Ware</a> --}}
                                </div>
                            </li>
                            <li>
                                @if ($language == 'ENG')
                                    <span>SKU : </span>
                                @else
                                    <span style="padding: 0 10px">SKU : </span>
                                @endif


                                <div class="product-meta-item">
                                    @if ($product->firstVariant->sku)
                                        <span>{{ $product->firstVariant->sku }}</span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <!-- /Product Meta -->
                    </div>
                </div>
            </div>

            <!-- Additional Information -->

            <div class="product-additional-info">
                <ul class="nav" id="bordered-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-product-desc-tab" data-toggle="pill" href="#tab-product-desc"
                            role="tab" aria-controls="tab-product-desc" aria-selected="true">
                            @if ($language == 'ENG')
                                Description
                            @else
                                الوصف
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-product-info-tab" data-toggle="pill" href="#tab-product-info"
                            role="tab" aria-controls="tab-product-info" aria-selected="false">
                            @if ($language == 'ENG')
                                Additional Information
                            @else
                                معلومات إضافية
                            @endif
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="bordered-tabContent">
                    <div class="tab-pane fade show active" id="tab-product-desc" role="tabpanel"
                        aria-labelledby="tab-product-desc-tab">
                        @if ($language == 'ENG')
                            @if (
                                $product->more_description_title_1 ||
                                    $product->more_description_title_2 ||
                                    $product->more_description_title_3 ||
                                    $product->more_description_title_4)
                            @endif
                        @else
                            @if (
                                $product->arabic->more_description_title_1 ||
                                    $product->arabic->more_description_title_2 ||
                                    $product->arabic->more_description_title_3 ||
                                    $product->arabic->more_description_title_4)
                            @endif

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @if ($product->more_description_title_1)
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home"
                                            aria-selected="true">
                                            @if ($language == 'ENG')
                                                {{ $product->more_description_title_1 }}
                                            @elseif($product->arabic != null)
                                                {{ $product->arabic->more_description_title_1 }}
                                            @endif
                                        </a>
                                    @endif
                                    @if ($product->more_description_title_2)
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                            href="#nav-profile" role="tab" aria-controls="nav-profile"
                                            aria-selected="false">
                                            @if ($language == 'ENG')
                                                {{ $product->more_description_title_2 }}
                                            @elseif($product->arabic != null)
                                                {{ $product->arabic->more_description_title_2 }}
                                            @endif
                                        </a>
                                    @endif
                                    @if ($product->more_description_title_3)
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                            href="#nav-contact" role="tab" aria-controls="nav-contact"
                                            aria-selected="false">
                                            @if ($language == 'ENG')
                                                {{ $product->more_description_title_3 }}
                                            @elseif($product->arabic != null)
                                                {{ $product->arabic->more_description_title_3 }}
                                            @endif
                                        </a>
                                    @endif
                                    @if ($product->more_description_title_4)
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                            href="#nav-desc" role="tab" aria-controls="nav-contact"
                                            aria-selected="false">
                                            @if ($language == 'ENG')
                                                {{ $product->more_description_title_4 }}
                                            @elseif($product->arabic != null)
                                                {{ $product->arabic->more_description_title_4 }}
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    @if ($product->more_description_1)
                                        @if ($language == 'ENG')
                                            {!! $product->more_description_1 !!}
                                        @elseif($product->arabic != null)
                                            {!! $product->arabic->more_description_1 !!}
                                        @endif
                                    @endif
                                </div>


                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    @if ($product->more_description_2)
                                        @if ($language == 'ENG')
                                            {!! $product->more_description_2 !!}
                                        @elseif($product->arabic != null)
                                            {!! $product->arabic->more_description_2 !!}
                                        @endif
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    @if ($product->more_description_3)
                                        @if ($language == 'ENG')
                                            {!! $product->more_description_3 !!}
                                        @elseif($product->arabic != null)
                                            {!! $product->arabic->more_description_3 !!}
                                        @endif
                                    @endif
                                </div>


                                <div class="tab-pane fade" id="nav-desc" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    @if ($product->more_description_4)
                                        @if ($language == 'ENG')
                                            {!! $product->more_description_4 !!}
                                        @elseif($product->arabic != null)
                                            {!! $product->arabic->more_description_4 !!}
                                        @endif
                                    @endif
                                </div>

                            </div>

                        @endif
                    </div>

                    <div class="tab-pane fade" id="tab-product-info" role="tabpanel"
                        aria-labelledby="tab-product-info-tab">
                        @if ($language == 'ENG')
                            <h4>Additional Information</h4>

                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Attributes</th>
                                        <th scope="col">Values</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>{{ $options['option1_name']['name'] }} </strong></td>
                                        @if (!empty($options['option1_name']['options']))
                                            <td>
                                                @foreach ($options['option1_name']['options'] as $o)
                                                    @if (!empty($o))
                                                        {{ $o }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endif

                                    </tr>

                                </tbody>
                            </table>
                        @else
                            <h4>معلومات إضافية</h4>

                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">صفات</th>
                                        <th scope="col">قيم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>حجم </strong></td>
                                        @if (!empty($options['option1_name']['options']))
                                            <td>
                                                @foreach ($options['option1_name']['options'] as $o)
                                                    @if (!empty($o))
                                                        {{ $o }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endif

                                    </tr>

                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Additional Information -->
        </div>
    </section>

    <!-- Related Products Start -->

    @if ($related_products)
        <section class="section section-pading pt-0 related">
            <div class="insta style-6 section">
                <div class="container">
                    @if ($language == 'ENG')
                        <h4>Related Products</h4>
                    @else
                        <h4>منتجات ذات صله</h4>
                    @endif
                    <div class="insta-slider" style="direction:ltr">
                        @foreach ($related_products as $product)
                            <div class="col">
                                <div class="ct-product">
                                    <div class="ct-product-thumbnail">
                                        <a href=""><img src="{{ asset('/img/products/2.png') }}"
                                                alt="product" /></a>
                                        <div class="ct-product-controls">
                                            <a href="{{ route('product_path', [$product->id, $seo_url]) }}"
                                                class="btn-custom secondary">

                                                @if ($language == 'ENG')
                                                    Buy Now
                                                    <i class="fas fa-arrow-right"></i>
                                                @else
                                                    اشتري الآن
                                                    <i class="fas fa-arrow-left"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ct-product-body">
                                        @if ($language == 'ENG')
                                            <h5 class="product-title"><a href="">{{ $product->title }}</a></h5>
                                        @else
                                            <h5 class="product-title"><a href="">{{ $product->arabic->title }}</a>
                                            </h5>
                                        @endif
                                        @if ($product->firstVariant->compare_at_price != null)
                                            @if ($language == 'ENG')
                                                <div class="d-flex" style="direction:ltr">
                                                    <p class="product-price custom-secondary">

                                                        {{ $product->firstVariant->compare_at_price * $rate }}
                                                        {{ $currency_code }}</p>
                                                    <del class="old-price"
                                                        style="padding:0 4px">{{ $product->firstVariant->price * $rate }}
                                                        {{ $currency_code }}</del>
                                                </div>
                                            @else
                                                <div class="d-flex" style="direction: rtl">
                                                    <p class="product-price custom-secondary">

                                                        {{ $product->firstVariant->compare_at_price * $rate }}
                                                        {{ $currency_code }}</p>
                                                    <del class="old-price"
                                                        style="padding:0 4px">{{ $product->firstVariant->price * $rate }}
                                                        {{ $currency_code }}</del>
                                                </div>
                                            @endif
                                        @else
                                            <p class="product-price custom-secondary">
                                                {{ $product->firstVariant->price * $rate }} {{ $currency_code }}
                                            </p>
                                        @endif
                                        <div class="product-label-group">
                                            @if ($product->inStock == 0)
                                                @if ($language == 'ENG')
                                                    <p class="product-price custom-secondary">Out of Stock</p>
                                                @else
                                                    <p class="product-price custom-secondary">إنتهى من المخزن</p>
                                                @endif
                                            @elseif($product->firstVariant->compare_at_price != null)
                                                <span class="product-price custom-secondary"> Discount :
                                                    {{ $sale_percentage }} %</span>
                                            @endif
                                        </div>
                                        @if ($language == 'ENG')
                                            <p class="product-text"> {!! substr(strip_tags($product->description), 0, 80) !!}...</p>
                                        @else
                                            <p class="product-text" style="text-align: right;direction:rtl">
                                                {!! substr(strip_tags($product->arabic->description), 0, 80) !!}...
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </section>
    @endif
    <!-- Related Products End -->
@endsection
