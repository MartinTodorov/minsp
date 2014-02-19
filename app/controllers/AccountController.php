<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountController
 *
 * @author karborator
 */
class AccountController extends BaseController {

    public function getSignin() {
        return View::make('layout.signin');
    }

    public function getSignOut() {
        Auth::logout();
        return Redirect::route('home');
    }

    public function getForgotPassword() {

        return View::make('layout.forgot');
    }

    public function getRecoverPassword($code) {
        $user = User::where('code', '=', $code)
                           ->where('password_temp', '!=', '');
        
        if($user->count()){
            
            $user = User::first();
            
            $user->password      = $user->password_temp;
            $user->code          = '';
            $user->password_temp = '';
            
            if($user->save()){
                return Redirect::route('home')
                       ->with('global','Your password was activated,now you can sign in and change it!');
            } else {
                return Redirect::route('home')
                       ->with('global', 'Password cant be change,check the activatated link is correct!');
            }
            
        } else {
            return Redirect::route('home')
                   ->with('global', 'Password cant be change!');
        }
    }
    
    public function postForgotPassword() {
        $validator = Validator::make(Input::all(), array(
                    'email' => 'required|email'
        ));

        if ($validator->fails()) {
            return Redirect::route('forgot-password')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            //Is register the email
            $email = Input::get('email');
            $user = User::where('email', '=', $email);

            if ($user->count()) {
                // Generate code and password
                $user = $user->first();
                $code = str_random(60);
                $password = str_random(10);

                $user->code = $code;
                $user->password_temp = Hash::make($password);

                if ($user->save()) {
                    Mail::send('emails.auth.forgot', array('link' => URL::route('activate-password',$code), 'real_name' => $user->real_name, 'password' => $password), function($message) use ($user) {
                        $message->to($user->email, $user->real_name)->subject('Your new password');
                    });
                    return Redirect::route('home')
                           ->with('global','Good,new password will be send to this email,you must change it after you activate the account!');
                } else {
                    return 'Problem with forgot password';
                }
            } else {
                return 'Nope,the email is not registerd!';
            }
            //return 'Good,new password will be send to this email,you must change it after you activate the account!';
        }
    }

    public function postSignin() {
        $validator = Validator::make(Input::all(), array(
                    'email' => 'required|email',
                    'password' => 'required'
        ));

        if ($validator->fails()) {
            // Redirect to Sign in page
            return Redirect::route('sing-in-account')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $remember = Input::has('remember') ? true : false;

            $auth = Auth::attempt(array(
                        'email' => Input::get('email'),
                        'password' => Input::get('password'),
                        'active' => 1
                            ), $remember);

            if ($auth) {
                // Redirect to intended page
                return Redirect::intended('/');
            } else {
                return Redirect::route('sing-in-account')
                                ->with('global', 'Email/Password wrong, or account not activated!');
            }
        }
        return Redirect::route('sing-in-account')
                        ->with('global', 'There is a problem wtih signing you in.');
    }

    public function getCreate() {
        return View::make('account.create');
    }

    public function postCreate() {
        $Validator = Validator::make(Input::all(), array(
                    'email' => 'required|max:50|email|unique:users',
                    'real_name' => 'required|min:2',
                    'password' => 'required|min:6|max:20',
                    'password_again' => 'required|same:password'
        ));

        if ($Validator->fails()) {
            return Redirect::route('create-account')->
                            withErrors($Validator)->
                            withInput();
        } else {
            $email = Input::get('email');
            $FirstName = Input::get('real_name');
            $password = Input::get('password');

            //Activate code
            $code = str_random(60);

            // Create account
            $user = User::create(array(
                        'email' => $email,
                        'real_name' => $FirstName,
                        'password' => Hash::make($password),
                        'code' => $code,
                        'active' => 0
            ));

            if ($user) {

                Mail::send('emails.auth.activate', array('link' => URL::route('activate-account', $code), 'real_name' => $FirstName), function($message) use ($user) {
                    $message->to($user->email, $user->first_name)->subject('Activate your account');
                });

                return Redirect::route('home')->
                                with('global', 'Your account has been created! We have sent you activation email.');
            }
        }
    }

    /*
     * Change password      
     */

    public function getChangePassword() {
        return View::make('account.passwordChange');
    }

    public function postChangePassword() {
        $validator = Validator::make(Input::all(), array(
                    'old_password' => 'required',
                    'password' => 'required|min:6',
                    'password_again' => 'required|same:password',
        ));

        if ($validator->fails()) {
            return Redirect::route('change-password-account')
                            ->withErrors($validator);
        } else {
            $user = User::find(Auth::user()->id);

            $old_password = Input::get('old_password');
            $password = Input::get('password');

            if (Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($password);

                if ($user->save()) {
                    return Redirect::route('home')
                                    ->with('global', 'Your password was changed!');
                } else {
                    return Redirect::route('home')
                                    ->with('global', 'Your password cant be changed!');
                }
            } else {
                return Redirect::route('change-password-account')
                                ->with('global', 'Your old password is incorrect.');
            }
            return Redirect::route('change-password-account')
                            ->with('global', 'Your password could not be changed.');
        }
    }

    public function getActivate($code) {
        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if ($user->count()) {
            $user = $user->first();

            // Update user to active state

            $user->active = 1;
            $user->code = '';

            if ($user->save()) {
                return Redirect::route('home')->
                                with('global', 'Activated! Now you can sign in!');
            }
        }
        return Redirect::route('home')->
                        with('global', 'We could not activate your account.Try again later!');
    }

}
