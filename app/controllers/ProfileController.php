<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileController
 *
 * @author karborator
 */
class ProfileController extends BaseController {

    public function user($username) {
        $user = User::where('first_name', '=', $username);

        if ($user->count()) {
            $user = $user->first();
            return View::make('user.profile')
                   ->with('user', $user);            
        }
        
        return App::abort(404);
    }

}
