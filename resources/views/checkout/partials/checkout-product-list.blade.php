
<table class="shopping_cart_table">

	@foreach($checkoutData->orderItems as $item)
	<tr class="shopping_cart_item_{{$item->variant_id}} bg-light py-2">

		<!-- Product image -->
		<td>
			<!-- Image Display-->
            	<?php  
               $img = (empty($item->img)) ? "/img/empty.jpg" : $item->sm_img;
               ?>
            <img src="{{ $img }}" class="shopping_cart_img">
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
			</div>
		</td>

		<td>
			<span style="font-size: 13px; display: block; line-height: 1.3;">Total</span>
			<span class="shopping_cart_total_item_price">{{ $item->price * $item->quantity * app('currency')[2] }}</span>
            <small>{{app('currency')[0]}}</small>
		</td>
	</tr>
	@endforeach

	
</table>
<table class="shopping_cart_table">
    @foreach($checkoutData->orderBoxesItems as $box)
        <tr class="shopping_cart_item_{{$box->id}} bg-light py-2">
		<!-- Product image -->
		<td>
			<!-- Image Display-->
	            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="191.903" height="165.414" viewBox="0 0 191.903 165.414">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <rect id="Rectangle_1412" data-name="Rectangle 1412" width="154.86"
                                                height="134.414" fill="none" />
                                        </clipPath>
                                    </defs>
                                   <!--  <text id="Pack_of_6_bottles" data-name="Pack of 6 bottles"
                                        transform="translate(3.403 147.414)" fill="#708c9b" font-size="18"
                                        font-family="Helvetica" letter-spacing="-0.03em">
                                        <tspan x="-62.218" y="14">Pack of 6 bottles</tspan>
                                    </text> -->
                                    <g id="Group_12443" data-name="Group 12443" transform="translate(-543.347 -444.565)">
                                        <g id="Group_12441" data-name="Group 12441"
                                            transform="translate(543.347 444.565)">
                                            <g id="Group_12389" data-name="Group 12389" clip-path="url(#clip-path)">
                                                <path id="Path_401" data-name="Path 401"
                                                    d="M169.606,8.955V124.6L68.729,136V15.6Z"
                                                    transform="translate(-15.136 -1.972)" fill="#708c9b" stroke="#708c9b"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    opacity="0.111" />
                                                <path id="Path_402" data-name="Path 402"
                                                    d="M53.7,14.747.5,5.074V117.815l53.2,17.327Z"
                                                    transform="translate(-0.11 -1.118)" fill="#6b8594" stroke="#708c9b"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    opacity="0.277" />
                                                <path id="Path_403" data-name="Path 403"
                                                    d="M154.58,7.093,95.533.5.5,4.067l53.2,9.674Z"
                                                    transform="translate(-0.11 -0.11)" fill="#708c9b" stroke="#708c9b"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    opacity="0.51" />
                                            </g>
                                        </g>
                                        <text id="x6" transform="translate(563.25 514.734)" fill="#708c9b"
                                            font-size="40" font-family="Helvetica-Bold, Helvetica" font-weight="700"
                                            letter-spacing="-0.07em">
                                            <tspan x="-20.846" y="31">x{{$box->size}}</tspan>
                                        </text>
                                    </g>
                                    <g id="Group_12448" data-name="Group 12448" transform="translate(65.019 59.459)">
                                        <g id="Group_12382" data-name="Group 12382" transform="translate(0 0)">
                                            <path id="Path_304" data-name="Path 304"
                                                d="M9.066,5.678V3.617s.369-.273,0-.747V1.5s.2-1,1.763-1h5.781S17.748.6,17.8,1.354V2.812s-.332.484,0,.816v2.05Z"
                                                transform="translate(-6.15 -0.331)" fill="none" stroke="#2e613a"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_305" data-name="Path 305"
                                                d="M17.461,20.483v-4.17l.334-.6H9.065l.484.557v4.218"
                                                transform="translate(-6.149 -10.361)" fill="#708c9b" stroke="#708c9b"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                opacity="0.153" />
                                            <path id="Path_306" data-name="Path 306"
                                                d="M11.812,29.733V35c0,.98,1.277,1.842,1.277,1.842a7.963,7.963,0,0,1,2.645,5.473V71.35c0,2.111-1.32,2.338-1.32,2.338H2.2C.469,73.687.5,71.35.5,71.35V42.542a7.391,7.391,0,0,1,2.187-5.09A4.856,4.856,0,0,0,3.9,35.491V29.733"
                                                transform="translate(-0.5 -19.611)" fill="#708c9b" stroke="#708c9b"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                opacity="0.278" />
                                            <path id="Path_307" data-name="Path 307"
                                                d="M9.066,6.642a14.555,14.555,0,0,1,4.365-.422,26.934,26.934,0,0,1,4.365.233"
                                                transform="translate(-6.15 -4.103)" fill="none" stroke="gray"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_308" data-name="Path 308"
                                                d="M15.942,95.119H7.687a1.22,1.22,0,0,1-1.22-1.22V70.244a1.22,1.22,0,0,1,1.22-1.22h8.254a1.22,1.22,0,0,1,1.22,1.22V93.9a1.22,1.22,0,0,1-1.22,1.22"
                                                transform="translate(-4.436 -45.527)" fill="#f8fcfd" opacity="0.997" />
                                            <path id="Path_409" data-name="Path 409"
                                                d="M1.4,0H9.3a1.4,1.4,0,0,1,1.4,1.4V24.7a1.4,1.4,0,0,1-1.4,1.4H1.4A1.4,1.4,0,0,1,0,24.7V1.4A1.4,1.4,0,0,1,1.4,0Z"
                                                transform="translate(2.031 23.497)" fill="none" />
                                            <path id="Path_309" data-name="Path 309"
                                                d="M12.854,86.987a.236.236,0,0,0-.145-.069.543.543,0,0,0-.114.449.334.334,0,0,1,.259-.381"
                                                transform="translate(-8.472 -57.329)" fill="#708c9b"
                                                fill-rule="evenodd" />
                                            <path id="Path_310" data-name="Path 310"
                                                d="M28.667,83.046c-.046.112-.141.114-.276.052a.563.563,0,0,0,.151.07.173.173,0,0,0,.1-.054.1.1,0,0,1-.071.062.579.579,0,0,0,.06.012.134.134,0,0,0,.038-.141"
                                                transform="translate(-18.896 -54.775)" fill="#708c9b" />
                                            <path id="Path_311" data-name="Path 311"
                                                d="M32.155,77.931a.4.4,0,0,1,.147.082.431.431,0,0,0-.247-.154l-.085.068a.5.5,0,0,1,.185,0"
                                                transform="translate(-21.257 -51.355)" fill="#708c9b" />
                                            <path id="Path_312" data-name="Path 312"
                                                d="M31.252,78.16c-.013.125-.125.208-.2.326a.172.172,0,0,0,.1.288.443.443,0,0,0,.193-.47.429.429,0,0,1-.144.478.915.915,0,0,1-.592.157l0,.051a.967.967,0,0,0,.594-.144c.042.067.112.1.225.048.205-.088.19-.624-.168-.735"
                                                transform="translate(-20.354 -51.552)" fill="#708c9b" />
                                            <path id="Path_313" data-name="Path 313"
                                                d="M26.329,81.691c-.114-.142.131-.326.055-.512a.264.264,0,0,0-.035-.06.422.422,0,0,0-.371-.223.405.405,0,0,0-.4.277l-.216-.216h-.313V81h.139v1.886l.237.237h-.375v.045h.7v-.045h-.139l0-1.648c.044-.427.3-.454.3-.454a.4.4,0,0,1,.217.006.371.371,0,0,1,.151.233c.019.131-.04.117,0,.356a.913.913,0,0,1-.026-.332.337.337,0,0,0-.157-.241.316.316,0,0,0,0,.541.443.443,0,0,0,.14.084.288.288,0,0,0,.1.02"
                                                transform="translate(-16.69 -53.357)" fill="#708c9b" />
                                            <path id="Path_314" data-name="Path 314"
                                                d="M30.367,83.267a.791.791,0,0,0,.349-.08.91.91,0,0,0,.295-.233l.031.027a.941.941,0,0,1-.3.243.814.814,0,0,1-.373.087.868.868,0,0,1-.339-.071l-.492-.492a1.257,1.257,0,0,1-.125-.554,1.233,1.233,0,0,1,.076-.436,1.172,1.172,0,0,1,.206-.355.956.956,0,0,1,.3-.239.816.816,0,0,1,.371-.087.716.716,0,0,1,.342.082.854.854,0,0,1,.266.224,1.03,1.03,0,0,1,.172.329,1.27,1.27,0,0,1,.06.394H29.84a1.183,1.183,0,0,0,0,.2c0,.065.011.13.02.192a1.539,1.539,0,0,0,.071.31,1.119,1.119,0,0,0,.116.244.571.571,0,0,0,.15.161.294.294,0,0,0,.172.058m0-2.145a.311.311,0,0,0-.194.071.627.627,0,0,0-.161.2,1.312,1.312,0,0,0-.114.3,1.988,1.988,0,0,0-.058.369h.943a2.754,2.754,0,0,0-.031-.36,1.349,1.349,0,0,0-.078-.3.58.58,0,0,0-.129-.2.247.247,0,0,0-.177-.076"
                                                transform="translate(-19.569 -53.476)" fill="#708c9b" />
                                            <path id="Path_315" data-name="Path 315"
                                                d="M18.423,88.028a.913.913,0,0,1-.71.5.164.164,0,0,1-.061.023.188.188,0,0,1-.033.025l-.012.011a.962.962,0,0,0,.854-.513.256.256,0,0,1-.037-.041"
                                                transform="translate(-11.783 -58.061)" fill="#708c9b" />
                                            <path id="Path_316" data-name="Path 316"
                                                d="M14.732,88.469a1.135,1.135,0,0,1-1.273-.01c-.165-.225-.56-.421-.649-.657.172.261.517.412.674.619.069-.422-.488-.452-.729-.794a.367.367,0,0,0-.042.133.77.77,0,0,0,.367.758.336.336,0,0,0,.33-.014,1.185,1.185,0,0,0,1.351-.007"
                                                transform="translate(-8.553 -57.797)" fill="#708c9b"
                                                fill-rule="evenodd" />
                                            <path id="Path_317" data-name="Path 317"
                                                d="M16.253,88.256a.364.364,0,0,0-.069.114c.217-.072.326.3.579.289a.317.317,0,0,0,.295-.249.465.465,0,0,1-.343.078c-.162-.034-.12-.1-.418-.158a1.134,1.134,0,0,1,.4.115.423.423,0,0,0,.353-.079.4.4,0,0,0-.638-.237.554.554,0,0,0-.161.128m.006-.051c-.133.133-.171.245-.059.348a.168.168,0,0,1-.149-.106.718.718,0,0,1,.04-.066.124.124,0,0,0,.042.111.218.218,0,0,1-.021-.14.713.713,0,0,1,.149-.148"
                                                transform="translate(-10.756 -58.074)" fill="#708c9b"
                                                fill-rule="evenodd" />
                                            <path id="Path_318" data-name="Path 318"
                                                d="M14.01,81.788a1.169,1.169,0,0,0,.779.469,1.136,1.136,0,0,0,1.327-1.1v-3.01l-.236-.24h.765s.544.078.544.832a.808.808,0,0,1-.788.886v.044a1.22,1.22,0,0,0,.182.014,1.019,1.019,0,0,0,1.077-.944.917.917,0,0,0-.953-.877H15.555V77.9h.138v2.533a.956.956,0,0,1,.355.734,1.085,1.085,0,0,1-1.13,1.033,1.163,1.163,0,0,1-.925-.438Z"
                                                transform="translate(-9.4 -51.355)" fill="#708c9b" />
                                            <path id="Path_319" data-name="Path 319"
                                                d="M19.626,87.561a1.047,1.047,0,0,1-.2.273L19.39,87.8a.609.609,0,0,0,.174-.218.556.556,0,0,0,.046-.247.444.444,0,0,0-.006-.07,1.07,1.07,0,0,1,.022.292"
                                                transform="translate(-12.959 -57.56)" fill="#708c9b" />
                                            <path id="Path_320" data-name="Path 320"
                                                d="M18.15,85.432a.825.825,0,0,1,.348.676.791.791,0,0,1-.779.756s.711-.1.826-.614a.808.808,0,0,0-.291-.806Z"
                                                transform="translate(-11.857 -56.349)" fill="#708c9b"
                                                fill-rule="evenodd" />
                                            <path id="Path_321" data-name="Path 321"
                                                d="M16.595,84.84a.535.535,0,0,1,.2,0,.41.41,0,0,1,.156.087.456.456,0,0,0-.262-.163l-.09.073"
                                                transform="translate(-11.116 -55.91)" fill="#708c9b" />
                                            <path id="Path_322" data-name="Path 322"
                                                d="M14.2,82.439c-.014.132-.131.221-.214.347a.182.182,0,0,0,.107.3.47.47,0,0,0,.2-.5.573.573,0,0,1-.025.361h0a.911.911,0,0,1-.3.233.791.791,0,0,1-.349.08.294.294,0,0,1-.172-.058.582.582,0,0,1-.15-.161,1.111,1.111,0,0,1-.116-.244,1.562,1.562,0,0,1-.071-.31q-.013-.094-.02-.192a1.266,1.266,0,0,1,0-.2h1.369a1.27,1.27,0,0,0-.061-.394,1.023,1.023,0,0,0-.172-.329.85.85,0,0,0-.266-.224.712.712,0,0,0-.342-.083.823.823,0,0,0-.371.087.964.964,0,0,0-.3.239,1.172,1.172,0,0,0-.206.355,1.234,1.234,0,0,0-.076.436,1.258,1.258,0,0,0,.125.554l.112.112.38.38a.864.864,0,0,0,.34.071A.818.818,0,0,0,14,83.223a.942.942,0,0,0,.129-.081c.042.087.118.133.252.075.217-.094.2-.662-.181-.778m-1.043-.75a1.306,1.306,0,0,1,.114-.3.626.626,0,0,1,.161-.2.311.311,0,0,1,.194-.071.248.248,0,0,1,.177.076.589.589,0,0,1,.13.2,1.376,1.376,0,0,1,.078.3,2.753,2.753,0,0,1,.031.36H13.1a2.016,2.016,0,0,1,.058-.369"
                                                transform="translate(-8.53 -53.474)" fill="#708c9b" />
                                            <path id="Path_323" data-name="Path 323"
                                                d="M10.782,77.9h-.375l.237.241V81.12h.139v.045h-.7V81.12h.375l-.237-.237V77.9H10.08v-.045h.7Z"
                                                transform="translate(-6.819 -51.351)" fill="#708c9b" />
                                            <path id="Path_324" data-name="Path 324"
                                                d="M21.369,89.281a.2.2,0,0,1-.153-.055l.053-.053a.137.137,0,0,0,.1.035c.048,0,.074-.018.074-.052a.047.047,0,0,0-.013-.035.062.062,0,0,0-.037-.015l-.05-.007a.141.141,0,0,1-.081-.035.112.112,0,0,1-.03-.082.129.129,0,0,1,.146-.127.18.18,0,0,1,.135.049l-.052.051a.116.116,0,0,0-.086-.029c-.044,0-.065.024-.065.053a.04.04,0,0,0,.012.03.073.073,0,0,0,.039.016l.049.007a.139.139,0,0,1,.08.032.117.117,0,0,1,.032.089c0,.081-.067.127-.155.127"
                                                transform="translate(-14.164 -58.607)" fill="#708c9b" />
                                            <rect id="Rectangle_1397" data-name="Rectangle 1397" width="0.082"
                                                height="0.419" transform="translate(7.443 30.252)" fill="#708c9b" />
                                            <path id="Path_325" data-name="Path 325"
                                                d="M23.069,89.127h-.081v.158h-.082v-.419h.162a.131.131,0,1,1,0,.261m0-.188h-.077v.115h.077a.057.057,0,1,0,0-.115"
                                                transform="translate(-15.279 -58.614)" fill="#708c9b" />
                                            <path id="Path_326" data-name="Path 326"
                                                d="M24.052,89.281a.2.2,0,0,1-.153-.055l.053-.053a.137.137,0,0,0,.1.035c.048,0,.074-.018.074-.052a.047.047,0,0,0-.013-.035.062.062,0,0,0-.037-.015l-.05-.007a.141.141,0,0,1-.081-.035.112.112,0,0,1-.03-.082.129.129,0,0,1,.146-.127.18.18,0,0,1,.135.049l-.052.051a.116.116,0,0,0-.086-.029c-.044,0-.065.024-.065.053a.04.04,0,0,0,.012.03.073.073,0,0,0,.039.016l.049.007a.138.138,0,0,1,.08.032.117.117,0,0,1,.032.089c0,.081-.067.127-.155.127"
                                                transform="translate(-15.933 -58.607)" fill="#708c9b" />
                                            <path id="Path_327" data-name="Path 327"
                                                d="M25.674,89.235a.162.162,0,0,1-.226,0c-.043-.042-.041-.095-.041-.167s0-.125.041-.167a.162.162,0,0,1,.226,0c.042.042.042.095.042.167s0,.125-.042.167m-.061-.285a.068.068,0,0,0-.052-.022.069.069,0,0,0-.053.022c-.016.018-.02.037-.02.118s0,.1.02.117a.069.069,0,0,0,.053.022.068.068,0,0,0,.052-.022c.016-.018.02-.037.02-.117s0-.1-.02-.118"
                                                transform="translate(-16.927 -58.607)" fill="#708c9b" />
                                            <path id="Path_328" data-name="Path 328"
                                                d="M26.658,88.938v.1h.165v.073h-.165v.17h-.082v-.419h.276v.073Z"
                                                transform="translate(-17.699 -58.614)" fill="#708c9b" />
                                            <path id="Path_329" data-name="Path 329"
                                                d="M28.26,89.284l-.166-.257v.257h-.082v-.419h.073l.166.256v-.256h.082v.419Z"
                                                transform="translate(-18.646 -58.614)" fill="#708c9b" />
                                            <path id="Path_330" data-name="Path 330"
                                                d="M29.406,89.284l-.025-.074h-.149l-.026.074h-.085l.152-.419h.064l.153.419Zm-.1-.3-.053.153h.1Z"
                                                transform="translate(-19.378 -58.613)" fill="#708c9b" />
                                            <path id="Path_331" data-name="Path 331"
                                                d="M30.371,88.938v.346h-.082v-.346h-.11v-.073h.3v.073Z"
                                                transform="translate(-20.076 -58.614)" fill="#708c9b" />
                                            <path id="Path_332" data-name="Path 332"
                                                d="M31.409,89.287a.146.146,0,0,1-.154-.147v-.275h.082v.272a.073.073,0,1,0,.145,0v-.272h.081v.275a.146.146,0,0,1-.154.147"
                                                transform="translate(-20.785 -58.613)" fill="#708c9b" />
                                            <path id="Path_333" data-name="Path 333"
                                                d="M32.667,89.285l-.082-.167h-.059v.167h-.082v-.419h.164a.127.127,0,0,1,.136.128.114.114,0,0,1-.077.11l.094.18Zm-.064-.346h-.077v.111H32.6a.055.055,0,1,0,0-.111"
                                                transform="translate(-21.569 -58.614)" fill="#708c9b" />
                                            <path id="Path_334" data-name="Path 334"
                                                d="M33.591,89.284v-.419h.276v.073h-.194v.1h.165v.073h-.165v.1h.194v.073Z"
                                                transform="translate(-22.326 -58.614)" fill="#708c9b" />
                                            <path id="Path_335" data-name="Path 335"
                                                d="M9.066,5.678V3.617s.369-.273,0-.747V1.5s.2-1,1.763-1h5.781S17.748.6,17.8,1.354V2.812s-.332.484,0,.816v2.05Z"
                                                transform="translate(-6.15 -0.331)" fill="#2e613a" />
                                            <path id="Path_336" data-name="Path 336" d="M19.614,0V10.7H16.56V0"
                                                transform="translate(-11.093 -0.001)" fill="#fff" opacity="0.996" />
                                            <path id="Path_337" data-name="Path 337" d="M19.614,0V10.7H16.56V0"
                                                transform="translate(-11.093 -0.001)" fill="none" />
                                        </g>
                                    </g>
                                </svg>
                            </td>
		<!-- Product description -->
        <td>
            <small>Qty:</small>{{$box->totalQty}}/{{$box->size}}
        </td>
		<td>
			<div class="shopping_cart_product_info">
				 <small>Total:</small>
		         <span class="shopping_cart_total_item_price">{{$box->total*app('currency')[2]}} {{app('currency')[0]}}</span>
				
			</div>
		</td>
		<!-- Product Qty -->
		

		<td>
			
		</td>
	</tr>
	@endforeach
</table>