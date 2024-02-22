<?php

// Namespace declaration for the App\Console class
namespace App\Console;

// Importing Illuminate\Console\Scheduling\Schedule and Illuminate\Foundation\Console\Kernel
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Defining the Kernel class which extends ConsoleKernel
class Kernel extends ConsoleKernel
{
    // Define the application's command schedule
    protected function schedule(Schedule $schedule): void
    {
        // Commented out code for a sample command that runs the 'inspire' command every hour
        // $schedule->command('inspire')->hourly();
    }

    // Register the commands for the application
    protected function commands(): void

