<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (The "Drive-Thru" or "Service Window")
|--------------------------------------------------------------------------
|
| ANALOGY:
| If "Web Routes" are for humans visiting the lobby, "API Routes" are for machines
| (or Vue.js components) placing orders at the service window.
|
| - We don't serve "HTML pages" (Decorated tables).
| - We serve "JSON" (Raw data wrapped in a bag).
| - Prefix: All URLs here automatically start with "/api" (e.g., mysite.com/api/tasks).
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Task API routes
// ACTION: When Vue asks for "/api/tasks", call the 'index' method on the Waiter (TaskController).
Route::get('/tasks', [TaskController::class, 'index']);

// ACTION: When Vue sends DATA to "/api/tasks" (POST), call 'store' to create a new task.
Route::post('/tasks', [TaskController::class, 'store']);

// ACTION: When Vue modifies a specific task (PUT /api/tasks/5), call 'update'.
Route::put('/tasks/{id}', [TaskController::class, 'update']);

// ACTION: When Vue wants to remove a task (DELETE /api/tasks/5), call 'delete'.
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);
