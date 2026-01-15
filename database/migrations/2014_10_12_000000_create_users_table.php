<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * =================================================================================================
 *  CreateUsersTable (The "Blueprint")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  This is the "Blueprint" or "Architectural Plan" for the 'users' table in your database.
 *  When you run "php artisan migrate", Laravel looks at this plan and builds the actual table
 *  where user data will live.
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // The 'id' column: A unique number for each user (Primary Key).
            // Like a student ID number.
            $table->id();

            // 'string': A text field (VARCHAR).
            $table->string('name');

            // 'unique': No two users can share the same email.
            $table->string('email')->unique();

            // 'timestamp': Holds a date and time.
            // 'nullable': This field can be empty (null) if they haven't verified yet.
            $table->timestamp('email_verified_at')->nullable();

            // 'password': The encrypted password.
            $table->string('password');

            // 'rememberToken': A special random string for "Remember Me" functionality.
            $table->rememberToken();

            // 'timestamps': Automatically adds 'created_at' and 'updated_at' columns.
            // Useful for tracking when a user signed up.
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
        // "Down" methods are used to undo changes (rollback).
        // It says: "If we need to go back in time, delete this table."
        Schema::dropIfExists('users');
    }
}
