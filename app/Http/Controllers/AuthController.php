<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Artesaos\SEOTools\Facades\SEOMeta;

class AuthController extends Controller
{
    public function __construct()
    {
        // get all the currency global variable and bind it  in a container
        app()->singleton('settings', function () {
            return generalSettingsApi();
        });

        // get all the logo and bind it  in a container
        app()->singleton('logo', function () {
            return getPageData(17, $sorting = 'POS');
        });
    }

    /**
     * Shows the sign in screen
     *
     * @return Http Response
     */
    public function signin()
    {
        SEOMeta::setTitle('Sign In to our platform');
        SEOMeta::setDescription('Sign in to e-commerce');

        if (session()->get('user') != null) {
            abort(403, 'Forbidden - Access denied');
        }

        return view('user.sign-in');
    }

    /**
     * Shows the sign up screen
     *
     * @return Http Response
     */
    public function signup()
    {
        SEOMeta::setTitle('Sign Up & create an account');
        SEOMeta::setDescription('Create an account in our e-commerce platform');

        if (session()->get('user') != null) {
            abort(403, 'Forbidden - Access denied');
        }

        return view('user.sign-up');
    }

    /**
     * Shows the forget password screen
     *
     * @return Http Response
     */
    public function forgotPassword()
    {
        SEOMeta::setTitle('Forgot Password');
        SEOMeta::setDescription('Reset your password');

        if (session()->get('user') != null) {
            abort(403, 'Forbidden - Access denied');
        }

        return view('user.forgot-password');
    }

    /**
     * Check if Login Credentials are correct and returns the Data of the User connected
     * Synchronizes cart online and Offline if cart Online Exists
     *
     * @param $request
     * @return Http Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email:rfc,dns|required',
            'password' => 'required|min:6|max:20',
        ]);
        // Get the user Signed in Data
        $user = userSignIn($request->all());
        $cartGuest = getCartDataApi(session()->get('guest'));

        // If the credentials are correct and a user is returned
        if ($user != null) {
            // We create a session for the user
            session()->put('user', $user);
            session()->put('showPassord', 1);
            $response = deleteCheckoutApi(session()->get('user')->id);
            if ($cartGuest != null) {
                foreach ($cartGuest->items as $item) {
                    $response = addToCartApi(
                        session()->get('user')->id,
                        $item->variant_id,
                        $item->quantity
                    );
                }

                foreach ($cartGuest->orderBoxesItems as $box) {
                    $databox = addToCartBoxApi(
                        session()->get('user')->id,
                        $box->box_id
                    );
                    foreach ($box->boxItem as $item) {
                        $response = addToCartBoxItemApi(
                            $databox->original->id,
                            $item->variant_id,
                            $item->quantity
                        );
                    }
                }
            }
            // Delete the GUEST checkout once he has been converted to User Checkout
            $response = deleteCheckoutApi(session()->get('guest'));

            return redirect()->route('home_path');
        } else {
            session()->flash(
                'error',
                'Wrong credentials. Please check your email and password.'
            );
            return \Redirect::back();
        }
    }

    /**
     * Signs up new users and returns the data of the new signed up user
     * @param $request
     * @return Http Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:2|max:25',
            'lastname' => 'required|min:2|max:25',
            'email' => 'email:rfc,dns|required',
            'password' => 'required|min:6|max:20',
        ]);

        // Get the user Signed in Data
        $user = userSignUp($request->all());

        if ($user == 'user_already_exists') {
            session()->flash('error', 'This user already exists.');
            return \Redirect::back();
        } elseif ($user != null) {
            $cartGuest = getCartDataApi(session()->get('guest'));
            // We create a session for the user
            session()->put('user', $user);
            session()->put('showPassord', 1);
            if ($cartGuest != null) {
                foreach ($cartGuest->items as $item) {
                    $response = addToCartApi(
                        session()->get('user')->id,
                        $item->variant_id,
                        $item->quantity
                    );
                }

                foreach ($cartGuest->orderBoxesItems as $box) {
                    $databox = addToCartBoxApi(
                        session()->get('user')->id,
                        $box->box_id
                    );
                    foreach ($box->boxItem as $item) {
                        $response = addToCartBoxItemApi(
                            $databox->original->id,
                            $item->variant_id,
                            $item->quantity
                        );
                    }
                }
            }
            // Delete the GUEST checkout once he has been converted to User Checkout
            $response = deleteCheckoutApi(session()->get('guest'));

            return redirect()->route('home_path');
        } else {
            session()->flash(
                'error',
                'Wrong credentials. Please check your email and password.'
            );
            return \Redirect::back();
        }
    }

    /**
     * Reset password of the user (if he exists) and sends him an email with the new password.
     *
     * @param request
     * @return Http Response
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'email:rfc,dns|required',
        ]);

        // Get the user Signed in Data
        $reset = resetThePassword($request->all());

        if ($reset->success == 1) {
            session()->flash('message', $reset->message);
        } else {
            session()->flash('error', $reset->message);
        }

        return \Redirect::back();
    }

    /**
     * Update actual password
     * @param request
     * @param - Old Password
     * @param - New Password
     * @param - Confirm New Password
     * @param - User ID
     * @return Http Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:0|max:20',
            'new_password' => 'required|min:0|max:20',
            'confirm_password' => 'required|min:0|max:20',
        ]);

        $request->request->add(['user_id' => session()->get('user')->id]); //add request user id

        $response = updatePasswordApi($request->all());

        if ($response->success == 1) {
            session()->flash('message', $response->message);
        } else {
            session()->flash('error', $response->message);
        }

        return \Redirect::back();
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('home_path');
    }

    public function myAccount()
    {
        SEOMeta::setTitle('My Account | Manage your orders');
        SEOMeta::setDescription('Manage your addresses and orders');
        //check if the googleMaps is enabled
        $GoogleMaps = isEnabledFeature('Maps');
        if (session()->get('user') == null) {
            abort(403, 'Forbidden - Access denied');
        }

        // Get the addresses of the user logged in
        $addresses = getAllAddressDataApi(session()->get('user')->id);

        // Get the list of countries
        $countries = getCountriesDataApi();

        // Get the list of orders of a specif user
        $orders = getUserOrdersApi(session()->get('user')->id);
        rsort($orders);

        return view(
            'user.my-account',
            compact('addresses', 'countries', 'orders', 'GoogleMaps')
        );
    }

    /**
     * Creates a new address for the user
     * @param $request All Address information
     * @return Http Response
     */
    public function addUserAddress(Request $request)
    {
        $request->validate([
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
            'postal_code' =>
                'nullable|regex:/^[a-z0-9\- ]+$/i|max:' .
                app('settings')->environment->address_postal_code_max_char,
            'phone' =>
                'nullable|regex:/^[0-9+  s]+$/i|min:' .
                app('settings')->environment->user_phone_min_char .
                '|max:' .
                app('settings')->environment->user_phone_max_char,
        ]);
        addUserAddressApi($request->all());

        return redirect()->route('my_account_path');
    }

    /**
     * Delete a specific address from the user
     * @param $addressId Address ID that we want to delete
     * @return Http Response
     */
    public function deleteUserAddress($addressId)
    {
        // Delete Address from a specific user
        $response = deleteAddressApi($addressId, session()->get('user')->id);

        return \Redirect::back();
    }

    public function add_To_Wishlist(Request $request)
    {
        if (session()->get('user') != null) {
            add_To_WishList(
                session()->get('user')->id,
                $request->input('variant_id')
            );
            return 1;
        } else {
            return 0;
        }
    }

    public function remove_from_Wishlist(Request $request)
    {
        remove_Product_FromWishList(
            session()->get('user')->id,
            $request->input('variant_id')
        );
        return 1;
    }
}
