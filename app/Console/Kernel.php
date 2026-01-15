<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// =================================================================================================
// Console/Kernel.php (The "Task Scheduler" or "Automation Robot")
// =================================================================================================
//
// ANALOGY:
// While "Http/Kernel.php" handles requests from HUMANS (web browsers),
// this file handles requests from TIME (the clock) or administrators running commands.
// It's like setting an alarm clock to do chores automatically (e.g., "Clean database at midnight").
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * ANALOGY: "The Daily Agenda"
     * This is where you tell the robot WHAT to do and WHEN.
     * Example: $schedule->command('emails:send')->daily();
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
