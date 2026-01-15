<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

/**
 * =================================================================================================
 *  UserController (The "User Waiter")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  This Controller is the "Waiter" responsible for "User" specific requests.
 *  Specifically here, it handles showing a user's profile.
 */
class UserController extends Controller
{
    /**
     *  Show the profile for a given user.
     * 
     *  ANALOGY:
     *  Customer: "Can I see the profile for user #123 (the ID)?"
     *  Waiter: "Sure, let me get that."
     */
    public function show(string $id): View
    {
        // 1. Find the user in the database (Kitchen). 
        //    If not found, fail loudly (404).
        $user = User::findOrFail($id);

        // 2. "view": Prepare the presentation (the Plate).
        //    'user.profile': The name of the specific plate design (Blade template).
        //    ['user' => ...]: Put the actual food (data) on the plate.
        return view('user.profile', [
            'user' => $user
        ]);
    }
}
