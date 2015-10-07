<?php namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\DropDatabase;
use App\Console\Commands\Inspire;
use App\Services\ReportService;
use App\Services\EmailService;
use App\Models\BusinessCommenter;
use App\Models\Business;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Inspire::class,
        DropDatabase::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $this->reportBusinessesByFrequency(Business::CONFIG_NOTIFICATIONS_FREQUENCY_HOURLY);
        })->hourly();
        $schedule->call(function () {
            $this->reportBusinessesByFrequency(Business::CONFIG_NOTIFICATIONS_FREQUENCY_DAILY);
        })->daily();
        $schedule->call(function () {
            $this->reportBusinessesByFrequency(Business::CONFIG_NOTIFICATIONS_FREQUENCY_WEEKLY);
        })->weekly();
        $schedule->call(function () {
            $this->reportBusinessesByFrequency(Business::CONFIG_NOTIFICATIONS_FREQUENCY_MONTHLY);
        })->monthly();
        $schedule->call(function () {
            $this->automaticFeedbackRequest();
        })->weekly();
    }

    protected function reportBusinessesByFrequency($frequency)
    {
        $json_frequency    = '"frequency":' . $frequency;
        $json_send_reports = '"send_reports":true';
        $businesses        = Business::where(DB::raw("INSTR(data, '{$json_frequency}')"), '<>',
            0)->where(DB::raw("INSTR(data, '{$json_send_reports}')"), '<>', 0)->get();

        foreach ($businesses as $business) {
            EmailService::instance()->performanceReport(ReportService::basicPerformanceReport($business->id));
        }
    }

    protected function automaticFeedbackRequest()
    {
        $business_commenters = BusinessCommenter::whereRequestFeedbackAutomatically(true)->get();

        foreach ($business_commenters as $business_commenter) {
            EmailService::instance()->requestFeedback($business_commenter);
        }
    }
}
