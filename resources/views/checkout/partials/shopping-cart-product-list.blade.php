<table class="shopping_cart_table">
  
	@foreach($checkoutData->orderItems as $item)
        <tr class="shopping_cart_item_{{$item->variant_id}} bg-light py-2">
		<!-- Product image -->
		<td>
			<!-- Image Display-->
			 <?php  
               $img = (empty($item->img)) ? "/img/empty.jpg" : $item->sm_img;
               ?>
            <img src="{{ $img }}" class="shopping_cart_img" onerror="imgError(this);">
		</td>

		<!-- Product description -->
		<td>
			<div class="shopping_cart_product_info">
				<!-- Product Name  -->
				<span class="shopping_cart_product_desc">
 
                        @if(app('language')=='ENG')
                        {{$item->product_title}}
                        @elseif(app('language')=='AR' && $item->product_title_ar !=null)
                        {{$item->product_title_ar}}
                        @elseif(app('language')=='FR' && $item->product_title_fr!=null)
                        {{$item->product_title_fr}}
                        @endif
					
				@if($item->variant_title != null)
					<small>[{{ $item->variant_title }}]</small>
				@endif
				</span><br>

				<!-- Unit Price  -->
				<span class="shopping_cart_unit_price">Unit: {{$item->price *app('currency')[2] }} <small>{{app('currency')[0]}}</small></span>

				<!-- Remove Link  -->
				<a href="#" onclick="removeItem({{$item->id}})" class="link_colors shopping_cart_remove_link">Remove</a>
			</div>
		</td>

		<!-- Product Qty -->
		<td>
			<small>Qty</small>
			<input type="number" value="{{$item->quantity}}" class="shopping_cart_item_qty form-control" data-variant="{{ $item->variant_id }}">
		</td>

		<td>
			<small>Total</small>
		<span class="shopping_cart_total_item_price">{{ $item->price * $item->quantity * app('currency')[2] }}</span>
			<small>{{app('currency')[0]}}</small>
		</td>
	</tr>
	@endforeach
</table>


<script>
    function imgError(image)
    {
        image.onerror = "";
        image.src = "{{ asset("images/error/no-image.jpg") }}";
        return true;
    }
</script>
