<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * =================================================================================================
 *  CreateTasksTable (The "To-Do List" Blueprint)
 * =================================================================================================
 * 
 *  ANALOGY:
 *  This is the plan for storing your tasks.
 *  It defines what a "Task" looks like in the database.
 */
class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // The content of the task (e.g., "Walk the dog").
            $table->string('text');

            // 'boolean': True or False (TINYINT in MySQL).
            // 'default(false)': If we don't say otherwise, the task starts as NOT completed.
            $table->boolean('completed')->default(false);

            // Adds 'created_at' and 'updated_at'.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
