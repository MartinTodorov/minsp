<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddController
 *
 * @author karborator
 */
class AddController extends BaseController {
    /*
     * Add Functionality modul (GET)
     */

    public function getEvents() {
        return View::make('addModule.events');
    }

    public function getBands() {
        return View::make('addModule.bands');
    }

    public function getMusicians() {
        return View::make('addModule.musicians');
    }

    public function getStages() {
        return View::make('addModule.stages');
    }

    public function getStudios() {
        return View::make('addModule.studios');
    }

    public function getLables() {
        return View::make('addModule.labels');
    }

    public function getShops() {
        return View::make('addModule.shops');
    }

    public function getTutorials() {
        return View::make('addModule.tutorials');
    }

    public function getTeachers() {
        return View::make('addModule.teachers');
    }

    public function getMedia() {
        return View::make('addModule.youtube');
    }

    /*
     * Add Functionality modul (POST)
     */

    public function postEvents() {

        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'evCat' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'date' => 'required',
                    'country' => 'required',
                    'genre' => 'required',
                    'other_genre' => 'required_if:genre,7',
        ));

        if ($validator->fails()) {
            return Redirect::route('add-events')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;
            /*
             * Genarating Hashtag
             */

            function randStrGen($len) {
                $result = "";
                $chars = 'abcdefghijklmnopqrstuvwxyz$_?!-0123456789';
                $charArray = str_split($chars);
                for ($i = 0; $i < $len; $i++) {
                    $randItem = array_rand($charArray);
                    $result .= "" . $charArray[$randItem];
                }
                return $result;
            }

            if (Input::get('evCat') == 2) {
                $hashtag = '#';
                $unicString = randStrGen(9);
                $hashtag.=$unicString;
                $users = User::where('hashtag', '=', $hashtag);
                if ($users) {
                    $hashtag = '#';
                    $unicString = randStrGen(9);
                    $hashtag.=$unicString;
                }
            } else {
                $hashtag = '@';
                $unicString = randStrGen(9);
                $hashtag.=$unicString;
                $users = User::where('hashtag', '=', $hashtag);
                if ($users) {
                    $hashtag = '@';
                    $unicString = randStrGen(9);
                    $hashtag.=$unicString;
                }
            }
            /*
             * Genre/Other_genre unite
             */
            if (Input::get('other_genre')) {
                $genre = Input::get('other_genre');
            } else {
                $genre = Input::get('genre');
            }

            $artists = Events::create(array(
                        'name' => Input::get('name'),
                        'location' => Input::get('location'),
                        'description' => Input::get('description'),
                        'date' => Input::get('date'),
                        'country' => Input::get('country'),
                        'owner' => $id,
                        'cat' => Input::get('evCat'),
                        'hashtag' => $hashtag,
                        'genre' => $genre
            ));
            if ($artists->save()) {
                /*
                 * Upload avatar
                 */

                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/events/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 8,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-events')
                                ->with('global', 'You add event,wait administrator to activate it!');
            } else {
                return Redirect::route('add-events')
                                ->with('global', 'Fail to add new event,please try again later!');
            }
        }
    }

    public function postBands() {
        $validator = Validator::make(Input::all(), array(
                    'bandName' => 'required',
                    'members' => 'required',
                    'contact' => 'required',
                    'genre' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'performance' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-bands')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Artists::create(array(
                        'id' => $id,
                        'name' => Input::get('bandName'),
                        'location' => Input::get('location'),
                        'description' => Input::get('description'),
                        'performance' => Input::get('performance'),
                        'contact' => Input::get('contact'),
                        'genre' => Input::get('genre'),
                        'members' => Input::get('members'),
                        'type' => 1,
            ));

            if ($artists->save()) {

                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/bands/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 1,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-bands')
                                ->with('global', 'You was add as a band,wait administrator to activate it!');
            } else {
                return Redirect::route('add-bands')
                                ->with('global', 'Fail to add new band,please try again later!');
            }
        }
    }

    public function postMusicians() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'contact' => 'required',
                    'genre' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'performance' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-musicians')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Artists::create(array(
                        'id' => $id,
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'performance' => Input::get('performance'),
                        'contact' => Input::get('contact'),
                        'genre' => Input::get('genre'),
                        'location' => Input::get('location'),
                        'type' => 2,
            ));

            if ($artists->save()) {

                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/musicians/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 2,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-musicians')
                                ->with('global', 'You was add as a musician,wait administrator to activate it!');
            } else {
                return Redirect::route('add-musicians')
                                ->with('global', 'Fail to add you like musician,please try again later!');
            }
        }
    }

    public function postStages() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'contact' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'price' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-stages')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Business::create(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'contact' => Input::get('contact'),
                        'location' => Input::get('location'),
                        'price' => Input::get('price'), // TODO ban , use only .
                        'type' => 3,
            ));

            if ($artists->save()) {

                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/stages/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 3,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-stages')
                                ->with('global', 'You add a stage,wait administrator to activate it!');
            } else {
                return Redirect::route('add-stages')
                                ->with('global', 'Fail to add stage,please try again later!');
            }
        }
    }

    public function postStudios() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'contact' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'price' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-studios')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Business::create(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'contact' => Input::get('contact'),
                        'location' => Input::get('location'),
                        'price' => Input::get('price'), // TODO ban , use only .
                        'type' => 4,
            ));

            if ($artists->save()) {

                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/studios/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 4,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-studios')
                                ->with('global', 'You add a stage,wait administrator to activate it!');
            } else {
                return Redirect::route('add-studios')
                                ->with('global', 'Fail to add stage,please try again later!');
            }
        }
    }

    public function postLables() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'contact' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'price' => 'required',
        ));

        if ($validator->fails()) {
            return Redirect::route('add-studios')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Business::create(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'contact' => Input::get('contact'),
                        'location' => Input::get('location'),
                        'price' => Input::get('price'), // TODO ban , use only .
                        'type' => 5,
            ));

            if ($artists->save()) {

                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/labels/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 5,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-labels')
                                ->with('global', 'You add a stage,wait administrator to activate it!');
            } else {
                return Redirect::route('add-labels')
                                ->with('global', 'Fail to add stage,please try again later!');
            }
        }
    }

    public function postShops() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'contact' => 'required',
                    'description' => 'required',
                    'location' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-shops')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Business::create(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'contact' => Input::get('contact'),
                        'location' => Input::get('location'),
                        'type' => 6,
            ));

            if ($artists->save()) {

                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/shops/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 6,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-shops')
                                ->with('global', 'You add a stage,wait administrator to activate it!');
            } else {
                return Redirect::route('add-shops')
                                ->with('global', 'Fail to add stage,please try again later!');
            }
        }
    }

    public function postTutorials() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'description' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-tutorials')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Learn::create(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'type' => 1,
                        'owner' => $id,
            ));

            if ($artists->save()) {
                return Redirect::route('add-tutorials')
                                ->with('global', 'You add a tutorials,wait administrator to activate it!');
            } else {
                return Redirect::route('add-tutorials')
                                ->with('global', 'Fail to add tutorials,please try again later!');
            }
        }
    }

    public function postTeachers() {
        $validator = Validator::make(Input::all(), array(
                    'name' => 'required',
                    'description' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-teachers')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $id = Auth::user()->id;

            $artists = Learn::create(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'type' => 2,
                        'owner' => $id,
            ));

            if ($artists->save()) {
                /*
                 * Upload avatar
                 */
                $input = Input::file('avatar');
                if ($input) {
                    if (Input::file('avatar')->move('img/teachers/' . $id . '/')) {
                        $pictures = Pictures::create(array(
                                    'name' => $input,
                                    'cat' => 7,
                                    'folder' => $id,
                                    'owner' => $id,
                        ));
                    }
                }
                return Redirect::route('add-teachers')
                                ->with('global', 'You add a tutorials,wait administrator to activate it!');
            } else {
                return Redirect::route('add-teachers')
                                ->with('global', 'Fail to add tutorials,please try again later!');
            }
        }
    }

    public function postMedia() {
        $id = Auth::user()->id;
        $validator = Validator::make(Input::all(), array(
                    'link' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('add-media')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            //Youtube or SoundCloud link check
            $linkType = Input::get('link');
            if (strpos($linkType, 'https://www.youtube.com/watch?v=') !== FALSE) {
                $name = substr($linkType, 32);   // name of the video after v= ....  FROM Youtube                                                               
                //Get Likes
                $curlhandle = curl_init();
                curl_setopt($curlhandle, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos/$name?v=2&alt=json");
                curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($curlhandle);
                curl_close($curlhandle);

                $json = json_decode($response);

                $likes = $json->entry->{'yt$rating'}->numLikes; //Get likes

                $media = Media::create(array(
                            'url' => $name,
                            'owner' => $id,
                            'video_cat' => Input::get('video_cat'),
                            'hashtag' => Input::get('hashtag'),
                            'likes' => $likes,
                            'media' => 1
                ));
                return Redirect::route('add-media')
                                ->with('global', 'You add a media,wait administrator to activate it!');
            } elseif (strpos($linkType, 'http://www.youtube.com/watch?v=') !== FALSE) {
                if (!strstr($linkType, 'list')) {
                    $name = substr($linkType, 31);
                    //Get Likes

                    $curlhandle = curl_init();
                    curl_setopt($curlhandle, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos/$name?v=2&alt=json");
                    curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);

                    $response = curl_exec($curlhandle);
                    curl_close($curlhandle);

                    $json = json_decode($response);

                    $likes = $json->entry->{'yt$rating'}->numLikes;

                    $media = Media::create(array(
                                'url' => $name,
                                'owner' => $id,
                                'video_cat' => Input::get('video_cat'),
                                'hashtag' => Input::get('hashtag'),
                                'likes' => $likes,
                                'cat' => 1
                    ));
                    return Redirect::route('add-media')
                                    ->with('global', 'You add a media,wait administrator to activate it!');
                } else {
                    echo 'Play list ar not available!';
                }
            } else {
                if ($linkType != 'http://www.youtube.com/watch?v=') {
                    if (strpos($linkType, 'https://soundcloud.com') !== FALSE) {
                        $soundcloud = new Services_Soundcloud('f2bfe9a60d962e87a7fe19954710fca7', 'b7e9006ba03568c6613d35d746b80168');
                        $song = explode('/', $linkType);
                        try {
                            $response = json_decode($soundcloud->get('tracks/' . $song[4]), true);
                        } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
                            exit($e->getMessage());
                        }
                        // echo '<pre>' . print_r($response['favoritings_count'], true) . '</pre>';
                        $likes = $response['favoritings_count'];

                        $media = Media::create(array(
                                    'url' => $linkType,
                                    'song' => $song[4],
                                    'owner' => $id,
                                    'hashtag' => Input::get('hashtag'),
                                    'likes' => $likes,
                                    'cat' => 2
                        ));
                        return Redirect::route('add-media')
                                        ->with('global', 'You add a media,wait administrator to activate it!');
                    }
                }
            }
        }
        return Redirect::route('add-media')
                        ->with('global', 'Fail to add a media,please try again later!');
    }

}
