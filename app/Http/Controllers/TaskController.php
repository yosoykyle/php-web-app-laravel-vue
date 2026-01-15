<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

/**
 * =================================================================================================
 *  TaskController (The "Tasks Waiter")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  If your app is a restaurant, this Controller is the "Waiter" responsible for the "Tasks" section.
 *  
 *  When a customer (the web browser) asks for something related to tasks:
 *  1. This Waiter (Controller) takes the order (Request).
 *  2. It talks to the Kitchen (Model) to get or change the food (Data).
 *  3. It brings the food back to the customer on a plate (Response/JSON).
 */
class TaskController extends Controller
{
    /**
     *  GET /tasks
     *  The "Show Menu" Action
     * 
     *  ANALOGY:
     *  The customer asks: "What tasks do you have?"
     *  The waiter goes to the kitchen, gets all tasks sorted by newest first, and lists them out.
     */
    public function index()
    {
        // 1. Ask the 'Task' model to go to the database.
        // 2. 'orderBy': Sort them so the newest ones are on top.
        // 3. 'get': Actually fetch the list.
        $tasks = Task::orderBy('created_at', 'desc')->get();

        // 4. Return the list as JSON (a format the browser can easily read).
        return response()->json($tasks);
    }

    /**
     *  POST /tasks
     *  The "New Order" Action
     * 
     *  ANALOGY:
     *  The customer gives the waiter a note saying: "I want to create this new task."
     *  The waiter checks if the note is valid (Validation) before sending it to the kitchen.
     */
    public function store(Request $request)
    {
        // STEP 1: Validation (Quality Control)
        // Ensure the 'text' is there and isn't too long.
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        // STEP 2: Create the Task (Cooking)
        // Ask the Task model to create a new entry in the database.
        $task = Task::create([
            'text' => $validated['text'],
            // If 'completed' wasn't sent, default to false (not done).
            'completed' => $validated['completed'] ?? false,
        ]);

        // STEP 3: Response (Serving)
        // Return the newly created task with a 201 code (meaning "Created").
        return response()->json($task, 201);
    }

    /**
     *  PUT/PATCH /tasks/{id}
     *  The "Change Order" Action
     * 
     *  ANALOGY:
     *  The customer says: "Actually, change this task to 'completed'."
     *  The waiter finds the specific task ticket and updates it.
     */
    public function update(Request $request, $id)
    {
        // STEP 1: Find the Task
        // "findOrFail" tries to find the task by ID. If not found, it automatically complains (404 error).
        $task = Task::findOrFail($id);

        // STEP 2: Validate the Changes
        $validated = $request->validate([
            'text' => 'string|max:255',
            'completed' => 'boolean',
        ]);

        // STEP 3: Update the Task
        // Apply the valid changes to the task.
        $task->update($validated);

        // STEP 4: Return the updated task.
        return response()->json($task);
    }

    /**
     *  DELETE /tasks/{id}
     *  The "Cancel Order" Action
     * 
     *  ANALOGY:
     *  The customer says: "I don't need this task anymore, throw it away."
     */
    public function delete($id)
    {
        // STEP 1: Find the Task
        $task = Task::findOrFail($id);

        // STEP 2: Delete it
        $task->delete();

        // STEP 3: Confirm it's gone
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
