<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// search page
Route::post('/search', [
    'as' => 'search_path',
    'uses' => 'PagesController@getSearchData',
]);

// =============================== Home Page Start
Route::get('/', 'PagesController@index')->name('home_path');

// =============================== About Page Start
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/history', 'PagesController@history')->name('history');
Route::get('/team', 'PagesController@team')->name('team');

// =============================== Products Page Start

//product list Page
Route::get('/shop/category-{category_id}-{category_name}', [
    'as' => 'category_products_path',
    'uses' => 'PagesController@categoryProducts',
]);

// product details page
Route::get('/product-{product_id}-{product_name}', [
    'as' => 'product_path',
    'uses' => 'PagesController@productDetails',
]);

Route::get('/products/spices', 'PagesController@products_spices')
    ->name('products_spices')
    ->name('products_mixes');
Route::get(
    '/products/miscellaneous',
    'PagesController@products_miscellaneous'
)->name('products_miscellaneous');
//shop Page
Route::get('/shop', [
    'as' => 'shop_path',
    'uses' => 'PagesController@shop',
]);

// =============================== Recipes Page Start
Route::get('/recipes', 'PagesController@recipes')->name('recipes');
Route::get('/recipe-detail/{id?}', 'PagesController@recipe_details')->name(
    'recipe_details'
);

// =============================== Packing Page Start
Route::get('/packing', 'PagesController@packing')->name('packing');

// =============================== Faq Page Start
Route::get('/faqs', 'PagesController@faq')->name('faq');

// =============================== Terms and conditions Page Start
Route::get('/terms&conditions', 'PagesController@terms')->name('terms');

// =============================== Terms and conditions Page Start
Route::get('/privacy-policy', 'PagesController@privacy')->name('privacy');

// =============================== Contact Page Start
Route::get('/contact', 'PagesController@contact')->name('contact_path');

Route::get('add-To-Wishlist', 'AuthController@add_To_Wishlist');
Route::get('remove-from-Wishlist', 'AuthController@remove_from_Wishlist');
Route::get('smart-search', 'PagesController@smart_search');
/*
|--------------------------------------------------------------------------
| PAYMENTS
|--------------------------------------------------------------------------
*/

Route::post('/twocheckout', 'TwoCheckoutController@payTwoCheckout')->name(
    'two_checkout_path'
);

Route::post('/stripe', 'StripePaymentController@stripePost')->name(
    'stripe.post'
);

Route::post('/paypal', 'PaypalController@payWithpaypal')->name('payWithpaypal');

Route::get('/paypal-success', 'PaypalController@paypalSuccess')->name(
    'paypalSuccess'
);

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Sign In Page
Route::get('/sign-in', 'AuthController@signin')->name('sign_in_path');

// Sign Up Page
Route::get('/sign-up', 'AuthController@signup')->name('sign_up_path');

// Forget Password Page
Route::get('/forgot-password', 'AuthController@forgotPassword')->name(
    'forgot_password_path'
);

// Sign In User AND Synchronizes cart online and Offline if cart Online Exists
Route::post('/login', 'AuthController@login')->name('login_path');

// Sign Up User
Route::post('/register', 'AuthController@register')->name('register_path');

// Reset User password
Route::post('/reset-password', 'AuthController@resetPassword')->name(
    'reset_password_path'
);

// Logout user
Route::get('/logout', 'AuthController@logout')->name('logout_path');

// My Account
Route::get('/my-account', 'AuthController@myAccount')->name('my_account_path');

/**
 * Creates a new address for the user
 * @param $request All Address information
 * @return Http Response
 */
Route::post(
    '/my-account-add-user-address',
    'AuthController@addUserAddress'
)->name('my_account_add_user_address');

/**
 * Creates a new address for the user
 * @param $request All Address information
 * @return Http Response
 */
Route::get(
    '/my-account-delete-user-address-{address_id}',
    'AuthController@deleteUserAddress'
)->name('my_account_delete_user_address');

/**
 * Update actual password
 * @param request
 * @param - Old Password
 * @param - New Password
 * @param - Confirm New Password
 * @return Http Response
 */
Route::post(
    '/my-account-delete-user-address',
    'AuthController@updatePassword'
)->name('my_account_update_user_password');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

/**
 * STEP 1 - Displays the Shopping cart
 *
 * @return Http Response
 */
Route::get('/shopping-cart', 'CheckoutController@shoppingCart')->name(
    'shopping_cart_path'
);

Route::get('/country/provinces', 'CheckoutController@getProvinces');
Route::post('currency_load', 'CheckoutController@change_currency')->name(
    'currency.load'
);
Route::post('language_load', 'CheckoutController@change_language')->name(
    'language.load'
);

/**
 * STEP 2 - Displays the Checkout information
 *
 * @return Http Response
 */
Route::get('/checkout/', 'CheckoutController@checkoutInfo')->name(
    'checkout_info_path'
);

/**
 * STEP 3 - Display Shipping rates in checkout
 * @return Http Response
 */
Route::get('/checkout-shipping', 'CheckoutController@checkoutShipping')->name(
    'checkout_shipping_path'
);

/**
 * STEP 4 - Display Payment methods for checkout
 * @return Http Response
 */
Route::get('/payment', 'CheckoutController@payment')->name(
    'checkout_payment_path'
);

/**
 * STEP 5 - Proceed to payment
 * @return Http Response
 */
Route::post('/payment', 'CheckoutController@cashOnDelivery')->name(
    'checkout_cash_on_delivery'
);

/*
|--------------------------------------------------------------------------
| AREEBA
|--------------------------------------------------------------------------
*/

Route::post('/areeba-payment', 'AreebaController@areebaPayment')->name(
    'areeba_payment'
);

/**
 * Thank you page from areeba payment
 * @return Http Response
 */
Route::get(
    '/thank-you-areeba-payment-{bank_order_id}',
    'AreebaController@thankYou'
)->name('checkout_thank_you_areeba');

/**
 * Add item to Cart.
 *
 * @param $request->variant_id   Variant that we are adding to cart
 * @param $request->qty  Qty of the variant we are adding to cart
 *
 * @return $data  Array containing:
 * - the item that we want to add to cart (variant_id)
 * - the item quantity in the cart
 * - the total number of items in the cart
 * - the cart subtotal
 * - the validity of the item we are adding to cart
 */
Route::post('/add-to-cart', 'CheckoutController@addToCart')->name(
    'add_to_cart_path'
);

/**
 * Edit Cart Quantity.
 *
 * @param $request->variant_id   Variant that we are adding to cart
 * @param $request->qty  Qty of the variant we are adding to cart
 *
 * @return $data  Array containing:
 * - the item that we want to add to cart (variant_id)
 * - the total number of items in the cart
 * - the cart subtotal
 */
// Route::post('/edit-cart-qty', 'CheckoutController@editCartQty')->name('edit_cart_qty_path');

/**
 * Remove Item Qty from Cart.
 *
 * @param $request->variant_id   Variant that we are adding to cart
 * @param $request->qty  Qty of the variant we are adding to cart
 *
 * @return $data  Array containing:
 * - the item that we want to add to cart (variant_id)
 * - the total number of items in the cart
 * - the cart subtotal
 */
Route::post('/remove-qty-from-cart', 'CheckoutController@removeCartQty')->name(
    'remove_cart_qty_path'
);

/**
 * Get Data Address Information of a specific address
 *
 * @param $address_id
 * @return Address
 */
Route::post(
    '/checkout-user-addresses',
    'CheckoutController@showCheckoutAddress'
)->name('show_checkout_user_addresses_path');

/**
 * Update the checkout information of the user
 * @param $request  Full Address of the user with his email and subscription to newsletters
 * @return Http Response
 */
Route::post(
    '/update-checkout-info',
    'CheckoutController@updateCheckoutInfo'
)->name('update_checkout_info');

/**
 * Update the shipping address of the user
 * @param $request  Full Shipping Address
 * @return Http Response
 */
Route::post(
    '/update-shipping-address',
    'CheckoutController@updateShippingAddress'
)->name('update_shipping_address');

/**
 * Update the billing address of the user
 * @param $request  Full Shipping Address
 * @return Http Response
 */
Route::post(
    '/update-billing-address',
    'CheckoutController@updateBillingAddress'
)->name('update_billing_address');

/**
 * Update the shipping rate of the user's checkout order
 * @param $userId   ID of the user that is doing the order.
 * @param rate_name   Name of the rate selected by the user.
 * @param rate_value   Value of the rate selected by the user.
 * @return Http Response
 */
Route::post(
    '/update-shipping-rate',
    'CheckoutController@updateShippingRate'
)->name('update_shipping_rate');

/**
 * Apply promo code to the checkout of the user
 * @param promo_code  Promo code that we are applying to the checkout
 * @return Http Response
 */
Route::post('/apply-promo-code', 'CheckoutController@applyPromoCode')->name(
    'checkout_apply_promo_code'
);

/**
 * Remove promo code from checkout
 * @param promoCode  Promo code Id that we are applying to the checkout
 * @return Http Response
 */
Route::get(
    '/remove-promo-code/{promoCode}',
    'CheckoutController@removePromoCode'
)->name('checkout_remove_promo_code');

//google login
Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name(
    'login.google'
);
Route::get(
    'login/google/callback',
    'Auth\LoginController@handleGoogleCallback'
);

//facebook login
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name(
    'login.facebook'
);
Route::get(
    'login/facebook/callback',
    'Auth\LoginController@handleFacebookCallback'
);

/*
    |--------------------------------------------------------------------------
    | SHOPPING CART ACTIONS (ADD/EDIT/DELETE)
    |--------------------------------------------------------------------------
 */

Route::post('/add-to-cart', 'CheckoutController@addToCart')->name(
    'add_to_cart_path'
);
Route::post('/edit-cart-qty', 'CheckoutController@editCartQty')->name(
    'edit_cart_qty_path'
);
Route::post('/edit-cart-qty-box', 'CheckoutController@updateCartQtyBox')->name(
    'edit_cart_qty_box_path'
);
Route::post('/remove-item', 'CheckoutController@removeItem')->name(
    'remove_item'
);
Route::post('/remove-box', 'CheckoutController@removeBox')->name('remove_box');
Route::post('/remove-box-item', 'CheckoutController@removeBoxItem')->name(
    'remove_box_item'
);

/*
    |--------------------------------------------------------------------------
    | Provinces Languages Currencies
    |--------------------------------------------------------------------------
*/

Route::get('/country/provinces', 'CheckoutController@getProvinces');
Route::post('change_currency', 'CheckoutController@change_currency')->name(
    'change_currency'
);
Route::post('change_language', 'CheckoutController@change_language')->name(
    'change.language'
);