<?php

namespace App\Console;

use App\Mail\RecapEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            try {
                Mail::to('arhamfaisal780@gmail.com')->send(new RecapEmail());
            } catch (\Exception $e) {
                Log::error('Failed to send recap email: ' . $e->getMessage());
            }
        })->everyMinute();

        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
