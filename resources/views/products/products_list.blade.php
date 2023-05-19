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

<div class="col-md-4" id="checkName">
    <div class="ct-product">
        <div class="ct-product-thumbnail">
            <a href="{{ route('product_path', [$product->id, $seo_url]) }}">
                <img src="{{ $product->firstVariant->md_img }}"
                    onerror="this.onerror=null; this.src='images/error/no-image.png';" alt="{{ $product->title }}"
                    width="300" height="338" />
            </a>
            <div class="ct-product-controls">
                <a href="{{ route('product_path', [$product->id, $seo_url]) }}" class="btn-custom secondary">
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
            <h5 class="product-title"><a href="{{ route('product_path', [$product->id, $seo_url]) }}">
                    @if ($language == 'ENG')
                        {{ $product->title }}
                    @elseif($product->arabic != null)
                        {{ $product->arabic->title }}
                    @endif
                </a>
            </h5>
            @if ($product->firstVariant->compare_at_price != null)
                <div class="d-flex">
                    <p class="product-price custom-secondary">
                        {{ $product->firstVariant->compare_at_price * $rate }} {{ $currency_code }}</p>
                    <del class="old-price" style="padding:0 4px">
                        {{ $product->firstVariant->price * $rate }} {{ $currency_code }}</del>
                </div>
            @else
                <p class="product-price custom-secondary">
                    {{ $product->firstVariant->price * $rate }} {{ $currency_code }}</p>
            @endif
            <div class="product-label-group">
                @if ($product->inStock == 0)
                    @if ($language == 'ENG')
                        <p class="product-price custom-secondary">Out of Stock</p>
                    @else
                        <p class="product-price custom-secondary">إنتهى من المخزن</p>
                    @endif
                @elseif($product->firstVariant->compare_at_price != null)
                    <div class="d-flex">
                        @if ($language == 'ENG')
                            <p class="product-price custom-secondary"> Discount: {{ $sale_percentage }} % </p>
                        @else
                            <p class="product-price custom-secondary"> تخفيض</p> <span class="custom-secondary"
                                style="padding: 0 10px">
                                %{{ $sale_percentage }}</span>
                        @endif
                    </div>
                @endif
            </div>
            @if ($language == 'ENG')
                <p class="product-text">{!! substr(strip_tags($product->description), 0, 80) !!}...
                @else
                <p class="product-text">{!! substr(strip_tags($product->arabic->description), 0, 80) !!}...
            @endif
            </p>
        </div>
    </div>
</div>
