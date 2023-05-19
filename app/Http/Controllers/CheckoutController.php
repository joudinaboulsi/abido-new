<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // get all the currency global variable and bind it  in a container
        app()->singleton('settings', function () {
            return generalSettingsApi();
        });
        // dd(app('settings'));

        app()->singleton('notification', function () {
            return confirmNotificationApi();
        });

        // Create a Guest session for the user
        if (session()->get('guest') === null) {
            session()->put('guest', hexdec(uniqid()));
        }
        // get the language we selected
        app()->singleton('language', function () {
            $language = session('lang');
            if ($language == '') {
                $language = 'ENG';
            }
            return $language;
        });
        // get the currency we selected
        app()->singleton('currency', function () {
            $currency = [];
            $currency[0] = session('currency_code');
            $currency[1] = session('currency_id');
            $currency[2] = session('currency_rate');
            if ($currency[1] == '') {
                $currency[0] = app('settings')->currency;
                $currency[1] = app('settings')->currency_id;
                $currency[2] = 1;
            }
            return $currency;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | SHOPPING CART ACTIONS (ADD/EDIT/DELETE)
    |--------------------------------------------------------------------------
    */

    /**
     * Add item to Cart. or add item to cart
     *
     * @param $request->variant_id   Variant that we are adding to cart
     * @param $request->qty  Qty of the variant we are adding to cart
     * @param $request->box_id   box that we are adding to cart
     * @param $request->qty  Qty of the variant we are adding to box
     * @return $data  Array containing:
     * - the item that we want to add to cart (variant_id)
     * - the item quantity in the cart
     * -data includes message to display in the ajax alert
     */

    public function addToCart(Request $request)
    {
        Log::debug(json_encode($request->input(), JSON_PRETTY_PRINT));
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $product = getProductData($request->product_id);

        // debug_ajax($product);

        $variants = array_values((array) $product->variants);
        //debug_ajax($variants);

        if (
            $request->option1_value === null &&
            $request->option2_value === null &&
            $request->option3_value === null
        ) {
            $filtered = [$variants[0]];
        } else {
            $filtered = array_filter($variants, function ($el) use ($request) {
                return $el->option1_value === $request->option1_value &&
                    $el->option2_value === $request->option2_value &&
                    $el->option3_value === $request->option3_value;
            });
        }

        if ($filtered == null) {
            return response()->json([
                'success' => 0,
                'message' => 'This combination is not available in our stock.',
            ]);
        }

        $variant = array_values($filtered)[0];
        //return response()->json($filtered);

        //Get the data of the variant we are adding to cart
        $variant = getVariantData($variant->id);
        $data = [];
        $data[0] = addToCartApi($user_id, $variant->id, $request->qty);
        $checkoutData = getCartDataApi($user_id);
        $counter = session()->put('counter', $checkoutData->counter);
        $data[1] = $checkoutData->counter;
        //Log::debug(prettify($response));
        return response()->json($data);
    }

    public function addToCartBox(Request $request)
    {
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $data = addToCartBoxApi($user_id, $request->box_id);
        $checkoutData = getCartDataApi($user_id);
        $counter = session()->put('counter', $checkoutData->counter);
        return response()->json($data);
    }

    public function addToCartBoxItem($box_id, $variant_id, $qty)
    {
        $data = addToCartBoxItemApi($box_id, $variant_id, $qty);
        return response()->json($data);
    }

    /**
     * Edit Cart Quantity.
     *
     * @param $request->variant_id   Variant that we are adding to cart
     * @param $request->qty  Qty of the variant we are adding to cart
     *
     * @return $data  Array containing:
     * -data includes message to display in the ajax alert (success or failure)
     */

    public function editCartQty(Request $request)
    {
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $data = updateCartQtyApi($user_id, $request->variant_id, $request->qty);
        return response()->json($data);
    }

    public function updateCartQtyBox(Request $request)
    {
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $data = updateCartQtyBoxApi(
            $user_id,
            $request->variant_id,
            $request->qty
        );
        return response()->json($data);
    }

    /**
     * DELETE Item from Cart.
     * @param $request->variant_id   Variant that we are deleting from cart
     * @param $request->box_id       box that we are deleting  from cart
     * @return $data  Array containing:
     * -data includes message to display in the ajax alert (success or failure)
     */

    public function removeItem(Request $request)
    {
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $data = removeItemApi($user_id, $request->item_id);
        $counter = session()->put('counter', session()->get('counter') - 1);
        return response()->json($data);
    }

    public function removeBox(Request $request)
    {
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $data = removeBoxApi($user_id, $request->box_id);
        $counter = session()->put('counter', session()->get('counter') - 1);
        return response()->json($data);
    }

    public function removeBoxItem(Request $request)
    {
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        // If the user is GUEST
        $data = removeBoxItemApi($user_id, $request->box_id, $request->item_id);
        return response()->json($data);
    }

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT PROCESS
    |--------------------------------------------------------------------------
    */

    /**
     * STEP 1 - Displays the Shopping cart
     *
     * @return Http Response
     */
    public function shoppingCart()
    {
        SEOMeta::setTitle(
            app('settings')->store_address->store_name .
                ' | Shopping Cart - Purchase your products'
        );
        SEOMeta::setDescription('Manage your shopping cart');
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $total_case = 1;
        $checkoutData = getCartDataApi($user_id);
        // dd($checkoutData);
        // $checkoutData = getCheckoutDataApi($user_id);
        return view(
            'checkout.shopping-cart',
            compact('checkoutData', 'total_case')
        );
    }

    /**
     * STEP 2 - Displays the Checkout information
     *
     * @return Http Response
     */
    public function checkoutInfo()
    {
        SEOMeta::setTitle(
            app('settings')->store_address->store_name .
                ' | Checkout - Information about you'
        );
        SEOMeta::setDescription('Fill your checkout information');
        $total_case = 1;
        $userAddresses = '';
        //check if the googleMaps is enabled
        $GoogleMaps = isEnabledFeature('Maps');

        // Get the list of countries
        $countries = getCountriesDataApi();

        // Init User Email of checkout
        $userEmail = '';

        // If the user is signed in we set his Email and search for his addresses
        if (session()->get('user') !== null) {
            // Get Email of the signed in user
            $userEmail = session()->get('user')->email;

            // Get the user list of addresses
            $userData = getUserDataApi(session()->get('user')->id);
            $userAddresses = $userData->info->user_addresses;

            // Get all information fron Signed In checkout
            // $checkoutData = getCheckoutDataApi(session()->get('user')->id);
            $checkoutData = getCartDataApi(session()->get('user')->id);
        }

        // If the user buys as a GUEST we have to get the Checkout info
        else {
            $checkoutData = getCartDataApi(session()->get('guest'));
        }
        // $checkoutData = getCheckoutDataApi(session()->get('guest'));
        // If the cart is empty redirect to shopping cart
        if (!isset($checkoutData)) {
            return redirect()->route('shopping_cart_path');
        }

        return view(
            'checkout.information',
            compact(
                'userEmail',
                'countries',
                'checkoutData',
                'total_case',
                'GoogleMaps',
                'userAddresses'
            )
        );
    }

    /**
     * STEP 3 - Display Shipping rates in checkout
     * @return Http Response
     */
    public function checkoutShipping()
    {
        SEOMeta::setTitle(
            app('settings')->store_address->store_name .
                ' | Checkout | Shipping methods'
        );
        SEOMeta::setDescription('Select your shipping method');
        $total_case = 3;
        // Get the list of countries
        $countries = getCountriesDataApi();

        // Init User Email of checkout
        $userEmail = '';

        // If the user is signed in we set his Email and search for his addresses
        if (session()->get('user') !== null) {
            // Get Email of the signed in user
            $userEmail = session()->get('user')->email;

            // Get all information fron Signed In checkout
            $checkoutData = getCartDataApi(session()->get('user')->id);
            // $checkoutData = getCheckoutDataApi(session()->get('user')->id);

            // Get the list of shipping rates
            $shippingRates = getShippingRatesApi(session()->get('user')->id);
        }
        // If the user buys as a GUEST we have to get the Checkout info
        else {
            // Get all information fron Guest checkout
            // $checkoutData = getCheckoutDataApi(session()->get('guest'));
            $checkoutData = getCartDataApi(session()->get('guest'));

            // Get the list of shipping rates
            $shippingRates = getShippingRatesApi(session()->get('guest'));
        }
        // If the cart is empty redirect to shopping cart
        if (!isset($checkoutData)) {
            return redirect()->route('shopping_cart_path');
        }

        if (!isset($checkoutData)) {
            abort(403, 'Forbidden - Access denied');
        }
        // dd($shippingRates);
        return view(
            'checkout.shipping',
            compact(
                'userEmail',
                'countries',
                'checkoutData',
                'shippingRates',
                'total_case'
            )
        );
    }

    /**
     * STEP 4 - Display Payment methods for checkout
     * @return Http Response
     */
    public function payment()
    {
        SEOMeta::setTitle(
            app('settings')->store_address->store_name .
                ' | Checkout | Payment method'
        );
        SEOMeta::setDescription('Choose your payment method');
        $total_case = 3;

        // Get the list of countries
        $countries = getCountriesDataApi();

        // Init User Email of checkout
        $userEmail = '';

        // If the user is signed in we set his Email and search for his addresses
        if (session()->get('user') !== null) {
            // Get Email of the signed in user
            $userEmail = session()->get('user')->email;

            // Get all information fron Signed In checkout
            // $checkoutData = getCheckoutDataApi(session()->get('user')->id);
            $checkoutData = getCartDataApi(session()->get('user')->id);
        }

        // If the user buys as a GUEST we have to get the Checkout info
        else {
            $checkoutData = getCartDataApi(session()->get('guest'));
        }
        // $checkoutData = getCheckoutDataApi(session()->get('guest'));

        // If the cart is empty redirect to shopping cart
        if (!isset($checkoutData)) {
            return redirect()->route('shopping_cart_path');
        }

        if ($checkoutData->shipping_fees_title == null) {
            abort(403, 'Forbidden - Access denied');
        }

        return view(
            'checkout.payment',
            compact('userEmail', 'countries', 'checkoutData', 'total_case')
        );
    }

    public function removeAllSession()
    {
        session()->put('lat', app('settings')->environment->latitude);
        session()->put('lng', app('settings')->environment->longitude);
        session()->put('counter', 0);
        session()->forget('title');
        session()->forget('firstname');
        session()->forget('lastname');
        session()->forget('shippingAddress');
        session()->forget('apartment');
        session()->forget('city');
        session()->forget('postal_code');
        session()->forget('country_id');
        session()->forget('phone');
        session()->forget('province');
        session()->forget('province_id');
    }

    /**
     * STEP 5 - Confirm the payment and proceed to checkout via CASH ON DELIVERY
     * @param user_id   ID of the user that is doing the order.
     * @param payment_method   Payment method used by the user
     * @return Http Response
     */
    public function cashOnDelivery(Request $request)
    {
        $this->removeAllSession();

        // Validation form
        $request->validate([
            'payment_method' => 'required',
        ]);

        SEOMeta::setTitle(
            app('settings')->store_address->store_name .
                ' | Thank you for your order'
        );
        SEOMeta::setDescription('Order confirmed');

        // Get the user ID
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');
        $checkoutData = getCartDataApi($user_id);
        // $checkoutData = getCheckoutDataApi($user_id);

        // If the cart is empty redirect to shopping cart
        if (!isset($checkoutData)) {
            return redirect()->route('shopping_cart_path');
        }

        // We convert the order to a real order with the cash on delivery payment method
        $result = convertOrderApi($user_id, $cash_on_delivery = 1, 'null');

        // If the conversion was successful we reset the cart and the guest session
        // if($result->error == '')
        // {
        session()->forget('guest');
        session()->forget('selected_address');
        // }

        return view('checkout.thank-you');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAGE SHIPPING AND BILLING ADDRESSES
    |--------------------------------------------------------------------------
    */

    /**
     * Update the checkout information of the user
     * @param $request  Full Address of the user with his email and subscription to newsletters
     * @return Http Response
     */
    public function updateCheckoutInfo(Request $request)
    {
        // return $request;
        // Validation form
        $request->validate([
            'email' => 'email:rfc,dns|required',
            'title' =>
                'required_if:select_title,0|max:' .
                app('settings')->environment->address_title_max_char,
            'firstname' =>
                'required|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_firstname_max_char,
            'lastname' =>
                'required|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_lastname_max_char,
            'address' =>
                'required|max:' .
                app('settings')->environment->address_max_char,
            'apartment' =>
                'nullable|max:' .
                app('settings')->environment->address_apartment_max_char,
            'city' =>
                'required|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_city_max_char,
            'country_id' => 'required',
            'province_id' => 'required',
            'postal_code' =>
                'nullable|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_postal_code_max_char,
            'phone' =>
                'nullable|regex:/^[0-9+  s]+$/i|min:' .
                app('settings')->environment->user_phone_min_char .
                '|max:' .
                app('settings')->environment->user_phone_max_char,
        ]);

        // If the user is a guest
        if (session()->get('user') === null) {
            $request->request->add(['user_id' => session()->get('guest')]);
        }

        // If user is signed in
        else {
            $request->request->add(['user_id' => session()->get('user')->id]); //add request user id

            // If the user decided to add a new address, we save it.
            if ($request->select_title == 0) {
                addUserAddressApi($request->all());
            }

            //If the user decided to update an existing address. We update it.
            else {
                updateUserAddressApi($request->all());
            }

            // Create a session to remember the address selected by the user in the checkout
            session()->put('selected_address', $request->select_title);
        }

        //Update shipping information in checkout
        $response = updateShippingInfoApi($request->all());
        return redirect()->route('checkout_shipping_path');
    }

    /**
     * Update the shipping address of the user
     * @param $request  Full Address of the user
     * @return Http Response
     */
    public function updateShippingAddress(Request $request)
    {
        // Validation form
        $request->validate([
            'address' =>
                'required|max:' .
                app('settings')->environment->address_max_char,
            'apartment' =>
                'nullable|max:' .
                app('settings')->environment->address_apartment_max_char,
            'city' =>
                'required|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_city_max_char,
            'country_id' => 'required',
            'province_id' => 'required',
            'postal_code' =>
                'nullable|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_postal_code_max_char,
            'phone' =>
                'nullable|regex:/^[0-9+  s]+$/i|min:' .
                app('settings')->environment->user_phone_min_char .
                '|max:' .
                app('settings')->environment->user_phone_max_char,
        ]);

        //Get User ID
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');

        // Assign user to request
        $request->request->add(['user_id' => $user_id]);

        //Update shipping information in checkout
        $response = updateShippingInfoApi($request->all());

        return \Redirect::back();
    }

    /**
     * Update the billing address of the user
     * @param $request  Full Address of the user
     * @return Http Response
     */
    public function updateBillingAddress(Request $request)
    {
        // Validation form
        $request->validate([
            'address' =>
                'required|max:' .
                app('settings')->environment->address_max_char,
            'apartment' =>
                'nullable|max:' .
                app('settings')->environment->address_apartment_max_char,
            'city' =>
                'required|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_city_max_char,
            'country_id' => 'required',
            'province_id' => 'required',
            'postal_code' =>
                'nullable|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_postal_code_max_char,
            'phone' =>
                'nullable|regex:/^[0-9+  s]+$/i|min:' .
                app('settings')->environment->user_phone_min_char .
                '|max:' .
                app('settings')->environment->user_phone_max_char,
        ]);

        //Get User ID
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');

        // Assign user to request
        $request->request->add(['user_id' => $user_id]);

        //Update shipping information in checkout
        $response = updateBillingInfoApi($request->all());

        return \Redirect::back();
    }

    /**
     * AJAX - Get Address info of the selected address
     * @param address_id  Id of the address we want to get
     * @return $address Details of the address we selected
     */
    public function showCheckoutAddress(Request $request)
    {
        $address = getAddressDataApi(
            $request->address_id,
            session()->get('user')->id
        );

        if ($address != null) {
            session()->put('lat', $address->lat);
            session()->put('lng', $address->long);
            session()->put('title', $address->title);
            session()->put('firstname', $address->firstname);
            session()->put('lastname', $address->lastname);
            session()->put('shippingAddress', $address->address);
            session()->put('apartment', $address->apartment);
            session()->put('city', $address->city);
            session()->put('postal_code', $address->postal_code);
            session()->put('country_id', $address->country_id);
            session()->put('phone', $address->phone);
            session()->put('province', $address->province);
            session()->put('province_id', $address->province_id);
        } else {
            $this->removeAllSession();
        }
        session()->put('selected_address', $request->address_id);

        return response()->json($address);
    }

    /*
    |--------------------------------------------------------------------------
    | MANAGE SHIPPING RATES
    |--------------------------------------------------------------------------
    */

    /**
     * Update the shipping rate of the user's checkout order
     * @param $userId   ID of the user that is doing the order.
     * @param rate_name   Name of the rate selected by the user.
     * @param rate_value   Value of the rate selected by the user.
     * @return Http Response
     */
    public function updateShippingRate(Request $request)
    {
        // Validation form
        $request->validate([
            'shipping_rate' => 'required',
            'notes' => 'max:250',
        ]);

        //Get User ID who is paying
        $user_id =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');

        // Assign user to request
        $request->request->add(['user_id' => $user_id]);

        // Update the Notes of the order
        $response = updateNotesApi($request->all());

        //Update shipping information in checkout
        $response = updateShippingRateApi($request->all());

        return redirect()->route('checkout_payment_path');
    }

    /*
    |--------------------------------------------------------------------------
    | Provinces Languages Currencies
    |--------------------------------------------------------------------------
    */

    // get the Provinces related the selected country
    public function getProvinces(Request $request)
    {
        $provinces = provinces($request->input('data'));
        $size = count($provinces);
        $output = '';

        $output1 = '<select name="province_id" class="form-control checkout_select_inputs select_address required" required>
         <option value="0" selected disabled>Select province</option>';
        if ($size > 0) {
            foreach ($provinces as $p) {
                $output1 .=
                    '<option value="' . $p->id . '">' . $p->name . '</option>';
            }
            $output1 .= '</select>';
            $output = $output1;
        } else {
            $output .=
                ' <input type="text" name="province" placeholder="province" class="form-control checkout_inputs" value="' .
                $request->input('province_name') .
                '"
                        required><input type="hidden" value="no_id" name="province_id" />';
        }
        return $output;
    }

    public function change_currency(Request $request)
    {
        session()->put('currency_rate', $request->rate);
        session()->put('currency_code', $request->currency_code);
        session()->put('currency_id', $request->currency_id);
        $response['status'] = true;
        return $response;
    }

    public function change_language(Request $request)
    {
        session()->put('lang', $request->lang_code);
        $response['status'] = true;
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | PROMO CODE
    |--------------------------------------------------------------------------
    */

    /**
     * Apply promo code to the checkout of the user
     * @param promo_code  Promo code that we are applying to the checkout
     * @return Http Response
     */
    public function applyPromoCode(Request $request)
    {
        // Validation form
        $request->validate(['promo_code' => 'required']);

        $userId =
            session()->get('user') !== null
                ? session()->get('user')->id
                : session()->get('guest');

        $msg = applyPromoCodeApi($request->promo_code, $userId);

        // If the promo code is not valid
        if ($msg->success == 0) {
            session()->flash('error', $msg->message);
        }

        return \Redirect::back();
    }

    /**
     * Remove promo code from checkout
     * @param promoCode  Promo code Id that we are applying to the checkout
     * @return Http Response
     */
    public function removePromoCode($promoCode)
    {
        removePromoCodeApi($promoCode, session()->get('user')->id);

        return \Redirect::back();
    }
}
