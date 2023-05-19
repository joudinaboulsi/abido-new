<?php
	// If we are in the checkout
	if(isset($checkoutData))
	{
		$discount = $checkoutData->discount_value;
		$tax = ($checkoutData->shipping_address == null) ? "Calculated at checkout" : $checkoutData->taxAmount;
		$shippingFees = $checkoutData->shipping_fees;
		$total = $checkoutData->total;
		$subTotal=$checkoutData->subTotal;
	}

	// If we are in the shopping cart
	else
	{
		$tax = "Calculated at checkout";
		$total =0;
		$subTotal=0;
	}
?>

<!-- Subtotals  -->
<div style="font-size: 14px;">
	Subtotal <span class="shopping_cart_subtotals">{{ $subTotal*app('currency')[2] }} <small>{{ app('currency')[0] }}</small></span><br>

	@if(isset($checkoutData) && $discount != 0)
		Discount <span class="shopping_cart_subtotals">{{ $discount }} <small>{{ app('currency')[0] }}</small></span><br>
	@endif

	@if(isset($checkoutData) && $checkoutData->tax != 0)
		Taxes <small>({{ $checkoutData->tax }}%)</small> <span class="shopping_cart_subtotals">{{ $tax }} <small>{{ app('currency')[0] }}</small></span> <br>
	@else
		Taxes <span class="shopping_cart_subtotals">{{ $tax }}</span><br>
	@endif

	@if(isset($checkoutData) && $checkoutData->shipping_fees_title != null)
		Shipping Fees <small>({{$checkoutData->shipping_fees_title}})</small> <span class="shopping_cart_subtotals">{{ $shippingFees }} <small>{{ app('currency')[0] }}</small></span><br>
	@else
		Shipping Fees <span class="shopping_cart_subtotals">Calculated at checkout</span><br>
	@endif
</div>

<hr>

<!-- Total  -->
@if($total_case==1)
<div style="font-size: 18px;">
	Total <span style="float: right;">{{ $subTotal*app('currency')[2] }} <small>{{ app('currency')[0] }}</small></span> <br> 
	<span class="checkout_additional_info"> </span>
</div> 
@elseif($total_case==2)
<div style="font-size: 18px;">
	Total <span style="float: right;">{{ $subTotal*app('currency')[2] +$tax }} <small>{{ app('currency')[0] }}</small></span> <br> 
	<span class="checkout_additional_info"> </span>
</div> 
@else 
<div style="font-size: 18px;">
	Total <span style="float: right;">{{ $subTotal*app('currency')[2] +$tax +$shippingFees}} <small>{{ app('currency')[0] }}</small></span> <br> 
	<span class="checkout_additional_info"> </span>
</div> 
@endif