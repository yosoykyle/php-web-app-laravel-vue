<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * =================================================================================================
 *  Base Controller (The "Department Manager")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  Think of this class as the "Department Manager". 
 *  It doesn't do the specific work itself (like cooking or serving), but it handles 
 *  all the common paperwork and permissions.
 * 
 *  All other controllers (TaskController, UserController) report to this manager 
 *  (inherit from it) so they automatically get these shared abilities without 
 *  having to learn them from scratch.
 */
class Controller extends BaseController
{
    // TRAITS: 
    // - AuthorizesRequests: Checks if a user is allowed to do something (security guard).
    // - DispatchesJobs: Sends heavy tasks to be done later in the background (delegation).
    // - ValidatesRequests: Checks if the data sent by users is correct (quality control).
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
