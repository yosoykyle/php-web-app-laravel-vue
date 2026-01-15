<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (The "Front Desk" or "Reception")
|--------------------------------------------------------------------------
|
| ANALOGY:
| Think of this as the main entrance to a hotel.
| When a user types a URL in their browser (like "mysite.com/"), they are walking
| into the lobby.
|
| We typically return "Views" (HTML pages) from here.
|
*/

Route::get('/', function () {
    return view('welcome');
});
