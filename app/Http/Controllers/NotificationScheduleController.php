<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use App\Models\NotificationSchedule;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationScheduleController extends Controller
{

    public function listNotification()
    {
        $objLogin = session()->get('objUser');

        if ($objLogin->role == User::ROLE['admin']) {
            $list  = NotificationSchedule::all();
        } else {
            $customerId = AssignTask::where('employee_id', $objLogin->employee->id)->pluck('id')->toArray();
            $list  = NotificationSchedule::where('reciever_id', $objLogin->id)->orWhereIn('reciever_id', $customerId)->orderBy('status', 'ASC')->orderBy('id', 'DESC')->get();
        }
        return view('admin.notification.index', ['list' => $list]);
    }

//    create
    public function createNotification($type)
    {
        if ($type == NotificationSchedule::TYPE['customer']) {
         $objLogin = session()->get('objUser');

         if ($objLogin->role == User::ROLE['admin']) {
            $listCustomer  = Customer::paginate(5);
        } else {
            $listCustomer = Customer::select('customers.*')
            ->join('assign_task', 'customers.id', 'assign_task.customer_id')
            ->where('employee_id', $objLogin->employee->id)
            ->paginate(5);
        }
    } else {
        $listCustomer = null;
    }
    return view('admin.notification.add', ['list' => $listCustomer]);
}

public function validateDateTime($request)
{
    $rules = $this->validate($request,
        [
            'title' => 'required',
            'content' => 'required',
            'recurring' => 'required',
        ],
        [
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
            'recurring.required' => 'Recurring is required',
        ]
    );

    $recurring = $request->recurring;

    switch ($recurring) {
        case NotificationSchedule::RECURRING_TYPES['daily']:
        $hour = $request->daily_hour;
        $minute = $request->daily_minute;
        if ($hour == '' || $minute == '') {
            return false;
        }

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
        if ($hour == '' || $minute == '') {
            return false;
        }

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
        if ($hour == '' || $minute == '') {
            return false;
        }

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

    $objUser =session()->get('objUser');

    $data = [
        "type" => $request->type,
        "title" => $request->title,
        "content" => $request->content,
        "time" => $time,
        "recurring" => $recurring,
        "reciever_id" => ($request->type == 1) ? $objUser->id : $request->selected,

    ];
    return $data;
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

        break;

        case NotificationSchedule::RECURRING_TYPES['weekly']:
        $notificationSchedule->send_time = $data['time']['send_time'];
        $notificationSchedule->date_of_week = $data['time']['date_of_week'];
        $notificationSchedule->is_recurring = true;
        $notificationSchedule->recurring_type = 2;

        break;

        case NotificationSchedule::RECURRING_TYPES['monthly']:
        $notificationSchedule->send_time = $data['time']['send_time'];
        $notificationSchedule->day_of_month = $data['time']['day_of_month'];
        $notificationSchedule->is_recurring = true;
        $notificationSchedule->recurring_type = 3;

        break;

        default:

        $notificationSchedule->send_date = $data['time']['send_date'];
        $notificationSchedule->send_time = $data['time']['send_time'];
        $notificationSchedule->is_recurring = false;
        $notificationSchedule->recurring_type = null;

        break;
    }
    if ($data['type'] == 1) {
        $notificationSchedule->reciever_id = $data['reciever_id'];
        $notificationSchedule->created_at = Carbon::now();
        $notificationSchedule->save();
    } else {
        foreach ($data['reciever_id'] as $id) {
            $notificationSchedule->reciever_id = $id;
            $notificationSchedule->created_at = Carbon::now();
            $notificationSchedule->save();
        }
    }

    

    return redirect()->route('admins.notification.list')->with('success', 'Success');

}

public function storeNotification(Request $request)
{
    $notificationSchedule = new NotificationSchedule;

    $result = $this->saveNotificationSchedules($notificationSchedule, $request);

    if (!$result) {
        // $request->session()->flash('msgdate', 'Date is not valid');

        // return redirect()->route('admins.notification.create', ['type']);
        return redirect()->back()->withInput()->with('msgdate', 'Date is not valid');
    }

    $notificationSchedule->status = 1;

    try {

        $notificationSchedule->save();

        return redirect()->route('admins.notification.list');
    } catch (\Exception $e) {
        return view('errors.500');
    }
}

public function delete($id)
{
    try {
        $notificationSchedule = NotificationSchedule::find($id);

        $notificationSchedule->delete();

        return redirect()->route('admins.notification.list');
    } catch (\Exception $e) {
        return view('errors.500');
    }
}

public function edit($id)
{
    $notificationSchedule = NotificationSchedule::find($id);
    return view('admin.notification.edit', compact('notificationSchedule'));
}

public function updateNotificationSchedules($id, Request $request)
{
    $notificationSchedule = NotificationSchedule::find($id);
    $result = $this->saveNotificationSchedules($notificationSchedule, $request);

    if (!$result) {
        $request->session()->flash('msgdate', trans('messages.date_not_valid'));

        return redirect()->route('admins.notification.edit', compact('notificationSchedule'));
    }

    $notificationSchedule->status = 1;

    try {

        $notificationSchedule->save();

        return redirect()->route('admins.notification.list');
    } catch (\Exception $e) {
        return view('errors.500');
    }
}

public function actionNotification(Request $request)
{
    $listObj = NotificationSchedule::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                $item->delete();
            }
            break;
        }
        return redirect()->route('admins.notification.list')->with('success', 'Success');
    } else {

    }
}

    // status
public function statusNotification(Request $request)
{
    $objUpdate = Notification::find($request->id);
    $objUpdate->update(['status' => $request->status]);
    echo json_encode('ok');
}
}
