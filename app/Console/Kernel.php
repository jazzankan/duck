<?php

namespace App\Console;

use App\Notifications\NeardeadTodo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\NeardeadProject;
use App\Project;
use App\User;
use App\Todo;
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
            $latedate = $date->add(new \DateInterval('P3D'));
            $latedate = $latedate->format('Y-m-d');
            $neardeadproj = Project::where('deadline', $latedate)->get();
            if ($neardeadproj) {
                foreach ($neardeadproj as $ndp) {
                    $u = $ndp->users()->wherePivot('project_id', $ndp->id)->get();
                            foreach ($u as $unote) {
                                sleep(5);
                                $unote->notify(new NeardeadProject($ndp));
                            }
                    }
        }
            $today = new \DateTime();
            $today = $today->format('Y-m-d');
            $neardeadtodo = Todo::where('status','!=','d')->where('deadline', $today)->get();
            if ($neardeadtodo) {
                foreach ($neardeadtodo as $ndt) {
                    $project = Project::where('id', $ndt->project_id)->first();
                    $u = $project->users()->wherePivot('project_id',$ndt->project_id)->get();
                    foreach ($u as $unote) {
                        sleep(5);
                        $unote->notify(new NeardeadTodo($ndt));
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
