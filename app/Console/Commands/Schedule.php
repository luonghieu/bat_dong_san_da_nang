<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\NotificationSchedule;
use Illuminate\Support\Facades\Mail;

class Schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends schedule';

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
        $notifications = NotificationSchedule::where('type', NotificationSchedule::TYPE['customer'])
        ->where('status', NotificationSchedule::STATUS['progressing'])->get();

        foreach ($notifications as $notification) {
           $time_data = [
            'date_of_week' => $notification->date_of_week,
            'day_of_month' => $notification->day_of_month,
            'send_time' => $notification->send_time,
            'send_date' => $notification->send_date,
        ];

        $timeSend = getSendNotificationScheduleTime($notification->recurring_type,$time_data);

        $today = Carbon::now()->format('Y-m-d H:i');

        if ($today == Carbon::parse($timeSend)->format('Y-m-d H:i')) {
            $mail = $notification->customer->email;
            Mail::send('mail', ['title'=> $notification->title,'content'=> $notification->content], function($message) use ($mail){
                $message->to($mail)->subject('Bất động sản Đà Nẵng!');
            });
            if ($notification->is_recurring == 0) {
                $notification->update(['status' => NotificationSchedule::STATUS['done']]);
            }
        }
    }
}
}