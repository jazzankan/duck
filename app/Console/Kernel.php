<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\NeardeadProject;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $date = new \DateTime();
            $date = $date->add(new \DateInterval('P3D'));
            $date = $date->format('Y-m-d');
            $neardeadproj = Project::whereIn('deadline', [$date])->get();
            if ($neardeadproj) {
                foreach ($neardeadproj as $ndp) {
                    $u = $ndp->users()->wherePivot('project_id', $ndp->id)->get();
                            foreach ($u as $unote) {
                                sleep(5);
                                $unote->notify(new NeardeadProject($ndp));
                            }
                    }
        }
            })->daily();
     }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
