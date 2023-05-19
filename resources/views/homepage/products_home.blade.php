<section class="section section-padding pt-0">
    <div class="insta style-6 section">

        <div class="container">
            <div class="section-title-wrap section-header">
                @if ($language == 'ENG')
                    <h2 class="title">{{ $data->components->product_title->value }}</h2>
                @elseif ($data->components->product_title_ar->value)
                    <h2 class="title" style="float: right;">{{ $data->components->product_title_ar->value }}</h2>
                @endif
                @if ($language == 'ENG')
                    <p class="subtitle">
                        {{ $data->components->product_subtitle->value }}</p>
                @elseif($data->components->product_subtitle_ar->value)
                    <p class="subtitle">
                        {{ $data->components->product_subtitle_ar->value }}</p>
                @endif

            </div>

            <div class="insta-slider" style="direction:ltr">
                @foreach ($products as $product)
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

                    <div class="col-lg-4 col-md-6">
                        <div class="ct-product">
                            <div class="ct-product-thumbnail">
                                <a href="{{ route('product_path', [$product->id, $seo_url]) }}"><img
                                        src="{{ $product->firstVariant->md_img }}" alt="product" /></a>
                                <div class="ct-product-controls">
                                    @if ($language == 'ENG')
                                        <a href="{{ route('product_path', [$product->id, $seo_url]) }}"
                                            class="btn-custom secondary">Buy Now <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('product_path', [$product->id, $seo_url]) }}"
                                            class="btn-custom secondary">اشتري الآن<i class="fas fa-arrow-left"></i>
                                        </a>
                                    @endif

                                </div>
                            </div>
                            <div class="ct-product-body">
                                <h5 class="product-title"><a
                                        href="{{ route('product_path', [$product->id, $seo_url]) }}">
                                        @if ($language == 'ENG')
                                            {{ $product->title }}
                                        @elseif($product->arabic != null)
                                            {{ $product->arabic->title }}
                                        @endif
                                    </a></h5>
                                @if ($product->firstVariant->compare_at_price != null)
                                    <div class="d-flex">
                                        <p class="product-price custom-secondary">

                                            {{ $product->firstVariant->compare_at_price * $rate }}
                                            {{ $currency_code }}
                                        </p>
                                        <del class="old-price"
                                            style="padding:0 4px">{{ $product->firstVariant->price * $rate }}
                                            {{ $currency_code }}</del>
                                    </div>
                                @else
                                    <p class="product-price custom-secondary">
                                        {{ $product->firstVariant->price * $rate }} {{ $currency_code }}
                                    </p>
                                @endif

                                </p>

                                @if ($language == 'ENG')
                                    <p class="product-text">
                                        {!! substr(strip_tags($product->description), 0, 80) !!}...
                                    </p>
                                @elseif($product->arabic != null)
                                    <p class="product-text" style="direction:rtl">
                                        {!! substr(strip_tags($product->arabic->description), 0, 80) !!}...</p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
</section>
