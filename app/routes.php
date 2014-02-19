<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home'
));

Route::get('/user/{username}', array(
    'as' => 'profile-user',
    'uses' => 'ProfileController@user'
));

/*
 *     Add Functionality (GET)             
 */
Route::get('/add/bands', array(
    'as' => 'add-bands', // BANDS
    'uses' => 'AddController@getBands'
));

Route::get('/add/events', array(
    'as' => 'add-events', //EVENTS
    'uses' => 'AddController@getEvents'
));

Route::get('/add/musicians', array(
    'as' => 'add-musicians', //MUSICIANS
    'uses' => 'AddController@getMusicians'
));

Route::get('/add/stages', array(
    'as' => 'add-stages', //STAGES
    'uses' => 'AddController@getStages'
));

Route::get('/add/shops', array(
    'as' => 'add-shops', //SHOPS
    'uses' => 'AddController@getShops'
));

Route::get('/add/studios', array(
    'as' => 'add-studios', //STUDIOS
    'uses' => 'AddController@getStudios'
));

Route::get('/add/labels', array(
    'as' => 'add-labels', //Lables
    'uses' => 'AddController@getLables'
));

Route::get('/add/tutorials', array(
    'as' => 'add-tutorials', //TUTORIALS
    'uses' => 'AddController@getTutorials'
));

Route::get('/add/teachers', array(
    'as' => 'add-teachers', //TEACHERS
    'uses' => 'AddController@getTeachers'
));

Route::get('/add/youtube', array(
    'as' => 'add-youtube', //TEACHERS
    'uses' => 'AddController@getYouTube'
));

Route::get('/add/soundcloud', array(
    'as' => 'add-soundcloud', //TEACHERS
    'uses' => 'AddController@getSoundCloud'
));
Route::get('/add/media', array(
    'as' => 'add-media', // Youtube/SoundCloud
    'uses' => 'AddController@getMedia'
));

/*
 *     Authoticated group
 */

Route::group(array('before' => 'auth'), function() {
    /*
     *  CSRF protection group
     */

    Route::group(array('before' => 'csrf'), function() {

        Route::post('/account/change-password', array(
            'as' => 'change-password-account-post',
            'uses' => 'AccountController@postChangePassword'
        ));


        /*
         *     Add Functionality (POST)             
         */

        Route::post('/add/events', array(
            'as' => 'add-events-post', //EVENTS
            'uses' => 'AddController@postEvents'
        ));


        Route::post('/add/musicians', array(
            'as' => 'add-musicians-post', //MUSICIANS
            'uses' => 'AddController@postMusicians'
        ));


        Route::post('/add/bands', array(
            'as' => 'add-bands-post', // BANDS
            'uses' => 'AddController@postBands'
        ));


        Route::post('/add/stages', array(
            'as' => 'add-stages-post', //STAGES
            'uses' => 'AddController@postStages'
        ));

        Route::post('/add/shops', array(
            'as' => 'add-shops-post', //SHOPS
            'uses' => 'AddController@postShops'
        ));

        Route::post('/add/studios', array(
            'as' => 'add-studios-post', //STUDIOS
            'uses' => 'AddController@postStudios'
        ));

        Route::post('/add/labels', array(
            'as' => 'add-labels-post', //Lables
            'uses' => 'AddController@postLables'
        ));

        Route::post('/add/tutorials', array(
            'as' => 'add-tutorials-post', //TUTORIALS
            'uses' => 'AddController@postTutorials'
        ));

        Route::post('/add/teachers', array(
            'as' => 'add-teachers-post', //TEACHERS
            'uses' => 'AddController@postTeachers'
        ));

        Route::post('/add/youtube', array(
            'as' => 'add-youtube-post', //TEACHERS
            'uses' => 'AddController@postYouTube'
        ));

        Route::post('/add/soundcloud', array(
            'as' => 'add-soundcloud-post', //TEACHERS
            'uses' => 'AddController@postSoundCloud'
        ));
        Route::post('/add/media', array(
            'as' => 'add-media-post', // Youtube
            'uses' => 'AddController@postMedia'
        ));
    });

    /*
     *     Change password (GET)
     */
    Route::get('/account/change-password', array(
        'as' => 'change-password-account',
        'uses' => 'AccountController@getChangePassword'
    ));

    /*
     *     Sign out (GET)
     */

    Route::get('/account/sign-out', array(
        'as' => 'sign-out-account',
        'uses' => 'AccountController@getSignOut'
    ));
});


/*
 *     Unauthoticated group
 */
Route::group(array('before' => 'guest'), function() {
    /*
     *  CSRF protection group
     */
    Route::group(array('before' => 'csrf'), function() {
        /*
         * Create Account(POST) 
         */
        Route::post('/account/create', array(
            'as' => 'create-account-post',
            'uses' => 'AccountController@postCreate'
        ));

        /*
         * Sign in (POST)
         */
        Route::post('/account/signin', array(
            'as' => 'sign-in-account-post',
            'uses' => 'AccountController@postSignin'
        ));

        /*
         * Forgot Password(POST) 
         */
        Route::post('/forgot-password', array(
            'as' => 'forgot-password-post',
            'uses' => 'AccountController@postForgotPassword'
        ));
    });

    /*
     * Sign in (GET)
     */
    Route::get('/account/signin', array(
        'as' => 'sing-in-account',
        'uses' => 'AccountController@getSignin'
    ));

    /*
     * Create Account(GET) 
     */
    Route::get('/account/create', array(
        'as' => 'create-account',
        'uses' => 'AccountController@getCreate'
    ));
    /*
     * Forgot Password(GET) 
     */
    Route::get('/forgot-password', array(
        'as' => 'forgot-password',
        'uses' => 'AccountController@getForgotPassword'
    ));

    Route::get('/forgot-password/activate/{code}', array(
        'as' => 'activate-password',
        'uses' => 'AccountController@getRecoverPassword'
    ));
});

Route::get('/account/activate/{code}', array(
    'as' => 'activate-account',
    'uses' => 'AccountController@getActivate'
));
