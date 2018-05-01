<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\NotificationSchedule;

class HappyBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a Happy birthday message to users via SMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notification = NotificationSchedule::where('type', NotificationSchedule::TYPES['customer'])
            ->where('status', NotificationSchedule::STATUS['progressing']);

        $time_data = [
            'date_of_week' => $notification->date_of_week,
            'day_of_month' => $notification->day_of_month,
            'send_time' => $notification->send_time,
            'send_date' => $notification->send_date,
        ];

        $timeSend = getSendNotificationScheduleTime($notification->recurring_type,$time_data);

        $today = Carbon::now();
        if ($today->eq($timeSend)) {
            Mail::send('mail', ['title'=> $notification->title,'content'=> $notification->content], function($message) {
                $message->to('luonghieu.t3@gmail.com', 'Viblo')->subject('Welcome to the Viblo!');
            });
        }
    }
}
