<?php

namespace App\Http\Controllers;

use App\Models\NotificationSchedule;
use App\Models\User;
use App\Models\Customer;
use App\Models\Assigntask;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class NotificationScheduleController extends Controller
{
//    public function index(Request $request)
//    {
//        $keyword = $request->search;
//        $fromDate = $request->from_date;
//        $toDate = $request->to_date;
//
//        $notificationSchedules = NotificationSchedule::query();
//
//        if (isset($fromDate) && isset($toDate)) {
//            $fromDate = Carbon::parse($fromDate)->startOfDay();
//            $toDate = Carbon::parse($toDate)->endOfDay();
//
//            $notificationSchedules->where(function ($query) use ($fromDate, $toDate) {
//                $query->whereBetween('created_at', [$fromDate, $toDate]);
//            });
//        }
//
//        if (isset($keyword)) {
//            $notificationSchedules = $notificationSchedules->where(function ($query) use ($keyword) {
//                $query->where('id', 'like', "%" . $keyword . "%");
//                $query->orWhere('title', 'like', "%" . $keyword . "%");
//            });
//        }
//
//        $notificationSchedules = $notificationSchedules->orderBy('id', 'DESC')->paginate($request->limit ?: 10);
//
//        return view('admin.adminer.notification_schedules.index', compact('notificationSchedules'));
//    }
    public function listNotification()
    {
        $list  = NotificationSchedule::all();
        return view('admin.notification.index', ['list' => $list]);
    }

//    create
    public function createNotification()
    {
        return view('admin.notification.add');
    }

//    public function create()
//    {
//        return view('admin.adminer.notification_schedules.create');
//    }

    public function validateDateTime($request)
    {
        $rules = $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
                'type' => 'required',
                'recurring' => 'required',
            ],
            [
                'title.required' => 'Title is required',
                'content.required' => 'Content is required',
                'type.required' => 'Type is required',
                'recurring.required' => 'Recurring is required',
            ]
        );

        $recurring = $request->recurring;

        switch ($recurring) {
            case NotificationSchedule::RECURRING_TYPES['daily']:
                $hour = $request->daily_hour;
                $minute = $request->daily_minute;

                $send_time = $hour . ":" . $minute;

                $time = [
                    'send_time' => $send_time,
                    'daily_hour' => $hour,
                    'daily_minute' => $minute,
                ];

                break;

            case NotificationSchedule::RECURRING_TYPES['weekly']:
                $hour = $request->week_hour;
                $minute = $request->week_minute;

                $send_time = $hour . ":" . $minute;

                $time = [
                    'send_time' => $send_time,
                    'date_of_week' => $request->date_of_week,
                    'week_hour' => $hour,
                    'week_minute' => $minute,
                ];

                break;

            case NotificationSchedule::RECURRING_TYPES['monthly']:
                $hour = $request->month_hour;
                $minute = $request->month_minute;

                $send_time = $hour . ":" . $minute;

                $time = [
                    'send_time' => $send_time,
                    'day_of_month' => $request->day_of_month,
                    'month_hour' => $hour,
                    'month_minute' => $minute,
                ];
                break;

            default:
                $year = $request->send_year;
                $month = $request->send_month;
                $date = $request->date;
                $hour = $request->send_hour;
                $minute = $request->send_minute;

                if (!checkdate($month, $date, $year)) {
                    return false;
                }

                $send_date = $year . "-" . $month . "-" . $date;
                $send_time = $hour . ":" . $minute;

                $time = [
                    'send_year' => $year,
                    'send_month' => $month,
                    'date' => $date,
                    'send_hour' => $hour,
                    'send_minute' => $minute,
                    'send_date' => $send_date,
                    'send_time' => $send_time,
                ];

                break;
        }

        $type = $request->type;

        if (NotificationSchedule::TYPES['user'] == $type) {
            $countUser = User::active()->where('type', User::TYPES['user'])->count();
        } else {
            $countUser = User::active()->where('type', User::TYPES['staff'])->count();
        }

        $data = [
            "type" => $request->type,
            "title" => $request->title,
            "content" => $request->content,
            "time" => $time,
            "recurring" => $recurring,
            "countUser" => $countUser,

        ];

        return $data;
    }

    public function confirmCreateNotificationSchedule(Request $request)
    {
        $data = $this->validateDateTime($request);

        if (!$data) {
            $request->session()->flash('msgdate', trans('messages.date_not_valid'));

            return redirect()->route('admin.notification_schedules.create');
        }

        return view('admin.adminer.notification_schedules.confirm', compact('data'));
    }

    public function saveNotificationSchedules($notificationSchedule, $request)
    {
        $data = $this->validateDateTime($request);

        if (!$data) {
            return false;
        }

        $notificationSchedule->title = $data['title'];
        $notificationSchedule->content = $data['content'];
        $notificationSchedule->type = $data['type'];
        $recurring = $data['recurring'];

        switch ($recurring) {
            case NotificationSchedule::RECURRING_TYPES['daily']:
                $notificationSchedule->send_time = $data['time']['send_time'];
                $notificationSchedule->is_recurring = true;
                $notificationSchedule->recurring_type = 1;

                return $notificationSchedule;

                break;

            case NotificationSchedule::RECURRING_TYPES['weekly']:
                $notificationSchedule->send_time = $data['time']['send_time'];
                $notificationSchedule->date_of_week = $data['time']['date_of_week'];
                $notificationSchedule->is_recurring = true;
                $notificationSchedule->recurring_type = 2;

                return $notificationSchedule;

                break;

            case NotificationSchedule::RECURRING_TYPES['monthly']:
                $notificationSchedule->send_time = $data['time']['send_time'];
                $notificationSchedule->day_of_month = $data['time']['day_of_month'];
                $notificationSchedule->is_recurring = true;
                $notificationSchedule->recurring_type = 3;

                return $notificationSchedule;

                break;

            default:

                $notificationSchedule->send_date = $data['time']['send_date'];
                $notificationSchedule->send_time = $data['time']['send_time'];
                $notificationSchedule->is_recurring = false;
                $notificationSchedule->recurring_type = null;

                return $notificationSchedule;

                break;
        }
    }

    public function createDraftNotificationSchedules(Request $request)
    {
        $notificationSchedule = new NotificationSchedule;

        $result = $this->saveNotificationSchedules($notificationSchedule, $request);

        if (!$result) {
            $request->session()->flash('msgdate', trans('messages.date_not_valid'));

            return redirect()->route('admin.notification_schedules.create');
        }

        $notificationSchedule->status = 3;

        try {

            $notificationSchedule->save();

            return redirect()->route('admin.notification_schedules.index');
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    public function createNotification(Request $request)
    {
        $notificationSchedule = new NotificationSchedule;

        $result = $this->saveNotificationSchedules($notificationSchedule, $request);

        if (!$result) {
            $request->session()->flash('msgdate', trans('messages.date_not_valid'));

            return redirect()->route('admin.notification_schedules.create');
        }

        $notificationSchedule->status = 1;

        try {

            $notificationSchedule->save();

            return redirect()->route('admin.notification_schedules.index');
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    public function show(NotificationSchedule $notificationSchedule)
    {
        return view('admin.adminer.notification_schedules.show', compact('notificationSchedule'));
    }

    public function destroy($id)
    {
        try {
            $notificationSchedule = NotificationSchedule::find($id);

            $notificationSchedule->delete();

            return redirect()->route('admin.notification_schedules.index');
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    public function edit(NotificationSchedule $notificationSchedule)
    {
        return view('admin.adminer.notification_schedules.edit', compact('notificationSchedule'));
    }

    public function confirmNotificationSchedule(NotificationSchedule $notificationSchedule, Request $request)
    {
        $data = $this->validateDateTime($request);
        if (!$data) {
            $request->session()->flash('msgdate', trans('messages.date_not_valid'));

            return redirect()->route('admin.notification_schedules.edit', compact('notificationSchedule'));
        }

        return view('admin.adminer.notification_schedules.confirm', compact('notificationSchedule', 'data'));
    }

    public function draftNotificationSchedules(NotificationSchedule $notificationSchedule, Request $request)
    {
        $result = $this->saveNotificationSchedules($notificationSchedule, $request);

        if (!$result) {
            $request->session()->flash('msgdate', trans('messages.date_not_valid'));

            return redirect()->route('admin.notification_schedules.edit', compact('notificationSchedule'));
        }

        $notificationSchedule->status = 3;

        try {

            $notificationSchedule->save();

            return redirect()->route('admin.notification_schedules.index');
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    public function updateNotificationSchedules(NotificationSchedule $notificationSchedule, Request $request)
    {
        $result = $this->saveNotificationSchedules($notificationSchedule, $request);

        if (!$result) {
            $request->session()->flash('msgdate', trans('messages.date_not_valid'));

            return redirect()->route('admin.notification_schedules.edit', compact('notificationSchedule'));
        }

        $notificationSchedule->status = 1;

        try {

            $notificationSchedule->save();

            return redirect()->route('admin.notification_schedules.index');
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    
}
