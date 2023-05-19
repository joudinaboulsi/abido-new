<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use AuthenticatesUsers;
use Socialite;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback()
    { 
        $userData = Socialite::driver('google')->stateless()->user();
        $userData->option='google';
            $form_params= [ 
            'google_id' =>$userData->id,
            'email' =>$userData->email,
            'firstname'=>$userData->user['given_name'],
            'lastname'=>$userData->user['family_name'],
            'option'=>'google',
        ];
          $user = userSignUp_google_fb($form_params);  
          session()->put('user', $user);
          session()->put('showPassord',0);
         return redirect()->route('home_path');
      
    }


     public function handleFacebookCallback(){
       $userData = Socialite::driver('facebook')->stateless()->user();
       dd($userData);
     }

    
   








}
