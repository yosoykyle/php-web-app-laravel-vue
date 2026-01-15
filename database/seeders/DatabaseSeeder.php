<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * =================================================================================================
 *  DatabaseSeeder (The "Gardener")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  If your database is a garden, this class is the "Gardener" that plants the initial seeds.
 *  
 *  When you start a new project, your database is empty (barren soil).
 *  You run this seeder to automatically plant some "starter plants" (dummy data) 
 *  so you don't have to manually type in 50 fake users just to test your app.
 */
class DatabaseSeeder extends Seeder
{
    /**
     *  Seed the application's database.
     * 
     *  ANALOGY:
     *  "Start planting now!"
     *
     * @return void
     */
    public function run()
    {
        // EXAMPLE:
        // "Hey User Factory, please create 10 fake users for me right now."
        // \App\Models\User::factory(10)->create();
    }
}
