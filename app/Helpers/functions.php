<?php
use App\Models\NotificationSchedule;
use App\Models\Transaction;

if (!function_exists('getNotificationScheduleTime')) {
    function getNotificationScheduleTime($value, $data = [])
    {
        switch ($value) {
            case NotificationSchedule::RECURRING_TYPES['daily']:
                return "Hằng ngày " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                break;
            case NotificationSchedule::RECURRING_TYPES['weekly']:
                switch ($data['date_of_week']) {
                    case (Carbon\Carbon::SUNDAY):
                        return "Chủ Nhật hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                    case (Carbon\Carbon::MONDAY):
                        return "Thứ hai hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                    case (Carbon\Carbon::TUESDAY):
                        return "Thứ ba hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                    case (Carbon\Carbon::WEDNESDAY):
                        return "Thứ tư hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                    case (Carbon\Carbon::THURSDAY):
                        return "Thứ năm hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                    case (Carbon\Carbon::FRIDAY):
                        return "Thứ sáu hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                    case (Carbon\Carbon::SATURDAY):
                        return "Thứ bảy hàng tuần " . Carbon\Carbon::parse($data['send_time'])->format('H:i');
                        break;
                }

            case NotificationSchedule::RECURRING_TYPES['monthly']:
                return "Hằng tháng, " . "ngày " .$data['day_of_month'] . ' '. Carbon\Carbon::parse($data['send_time'])->format('H:i');
                break;

            default: 
                return Carbon\Carbon::parse($data['send_date'] . " " . $data['send_time'])->format('Y/m/d H:i');
                break;
        }
    }
}

if (!function_exists('getNotificationScheduleType')) {
    function getNotificationScheduleType($type)
    {
        switch ($type) {
            case NotificationSchedule::TYPE['customer']:
                return "Customer";
                break;
            case NotificationSchedule::TYPE['employee']:
                return "Employee";
                break;
        }
    }
}

if (!function_exists('getNotificationScheduleStatus')) {
    function getNotificationScheduleStatus($status)
    {
        switch ($status) {
            case NotificationSchedule::STATUS['progressing']:
                return "In progress";
                break;
            case NotificationSchedule::STATUS['done']:
                return "Done";
                break;
        }
    }
}

if (!function_exists('getListNotificationScheduleStatus')) {
    function getListNotificationScheduleStatus()
    {
        return NotificationSchedule::STATUS;
    }
}

if (!function_exists('getTransactionStatus')) {
    function getTransactionStatus($status)
    {
        $list = array_flip(Transaction::STATUS);
        return $list[$status];

    }
}

if (!function_exists('getNotificationScheduleTime')) {
    function getSendNotificationScheduleTime($value, $data = [])
    {
        $today = Carbon::today();
        switch ($value) {
            case NotificationSchedule::RECURRING_TYPES['daily']:
                return Carbon\Carbon::parse($data['send_time']);
                break;
            case NotificationSchedule::RECURRING_TYPES['weekly']:
                switch ($data['date_of_week']) {
                    case (Carbon\Carbon::SUNDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::SUNDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                    case (Carbon\Carbon::MONDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::MONDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                    case (Carbon\Carbon::TUESDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::TUESDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                    case (Carbon\Carbon::WEDNESDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::WEDNESDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                    case (Carbon\Carbon::THURSDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::THURSDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                    case (Carbon\Carbon::FRIDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::FRIDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                    case (Carbon\Carbon::SATURDAY):
                        if ($today->dayOfWeek == Carbon\Carbon::SATURDAY) {
                            return Carbon\Carbon::parse($data['send_time']);
                        } else {
                            return false;
                        }
                        break;
                }

            case NotificationSchedule::RECURRING_TYPES['monthly']:
                return Carbon\Carbon::parse($data['send_time'])->month($data['day_of_month']);
                break;

            default:
                return Carbon\Carbon::parse($data['send_date'] . " " . $data['send_time']);
                break;
        }
    }
}