<?php
use App\Models\NotificationSchedule;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

if (!function_exists('isLogin')) {
    function isLogin()
    {
        $objUser = session()->get('objUser');
        if ($objUser != null) {
            return true;
        }
        return false;
    }
}

if (!function_exists('getUserLogin')) {
    function getUserLogin()
    {
        $objUser = session()->get('objUser');
        return $objUser;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        $objUser = session()->get('objUser');
        if (isset($objUser) && $objUser->role == User::ROLE['admin']) {
            return true;
        }
        return false;
    }
}

if (!function_exists('isManager')) {
    function isManager()
    {
        $objUser = session()->get('objUser');
        if (isset($objUser) && $objUser->role == User::ROLE['leader']) {
            return true;
        }
        return false;
    }
}

if (!function_exists('isEmployee')) {
    function isEmployee()
    {
        $objUser = session()->get('objUser');
        if (isset($objUser) && $objUser->role == User::ROLE['sale']) {
            return true;
        }
        return false;
    }
}

if (!function_exists('getNotificationScheduleTime')) {
    function getNotificationScheduleTime($value, $data = [])
    {
        switch ($value) {
            case NotificationSchedule::RECURRING_TYPES['daily']:
            return "Hằng ngày " . Carbon::parse($data['send_time'])->format('H:i');
            break;
            case NotificationSchedule::RECURRING_TYPES['weekly']:
            switch ($data['date_of_week']) {
                case (Carbon::SUNDAY):
                return "Chủ Nhật hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
                case (Carbon::MONDAY):
                return "Thứ hai hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
                case (Carbon::TUESDAY):
                return "Thứ ba hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
                case (Carbon::WEDNESDAY):
                return "Thứ tư hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
                case (Carbon::THURSDAY):
                return "Thứ năm hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
                case (Carbon::FRIDAY):
                return "Thứ sáu hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
                case (Carbon::SATURDAY):
                return "Thứ bảy hàng tuần " . Carbon::parse($data['send_time'])->format('H:i');
                break;
            }

            case NotificationSchedule::RECURRING_TYPES['monthly']:
            return "Hằng tháng, " . "ngày " .$data['day_of_month'] . ' '. Carbon::parse($data['send_time'])->format('H:i');
            break;

            default:
            return Carbon::parse($data['send_date'] . " " . $data['send_time'])->format('Y/m/d H:i');
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

if (!function_exists('getTransactionStatusVN')) {
    function getTransactionStatusVN($status)
    {
        switch ($status) {
            case 0:
            return "Đang xử lý";
            break;
            case 1:
            return "Đã đăng ký";
            break;
            case 2:
            return "Đã đặt cọc";
            break;
            case 3:
            return "Đã thanh toán";
            break;
        }

    }
}

if (!function_exists('getSendNotificationScheduleTime')) {
    function getSendNotificationScheduleTime($value, $data = [])
    {
        $today = Carbon::today();
        switch ($value) {
            case NotificationSchedule::RECURRING_TYPES['daily']:
            return Carbon::parse($data['send_time']);
            break;
            case NotificationSchedule::RECURRING_TYPES['weekly']:
            switch ($data['date_of_week']) {
                case (Carbon::SUNDAY):
                if ($today->dayOfWeek == Carbon::SUNDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
                case (Carbon::MONDAY):
                if ($today->dayOfWeek == Carbon::MONDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
                case (Carbon::TUESDAY):
                if ($today->dayOfWeek == Carbon::TUESDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
                case (Carbon::WEDNESDAY):
                if ($today->dayOfWeek == Carbon::WEDNESDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
                case (Carbon::THURSDAY):
                if ($today->dayOfWeek == Carbon::THURSDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
                case (Carbon::FRIDAY):
                if ($today->dayOfWeek == Carbon::FRIDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
                case (Carbon::SATURDAY):
                if ($today->dayOfWeek == Carbon::SATURDAY) {
                    return Carbon::parse($data['send_time']);
                } else {
                    return false;
                }
                break;
            }

            case NotificationSchedule::RECURRING_TYPES['monthly']:
            return Carbon::parse($data['send_time'])->month($data['day_of_month']);
            break;

            default:
            return Carbon::parse($data['send_date'] . " " . $data['send_time']);
            break;
        }
    }

    if (!function_exists('getNameCookie')) {
        function getNameCookie($name, $id)
        {
            $ipAddress = str_replace('.','',$_SERVER['REMOTE_ADDR']);
            return $name . '-' . $ipAddress . '-' . $id;
        }
    }

    if (!function_exists('checkCookie')) {
        function checkCookie($name)
        {
            if(isset($_COOKIE[$name])) {
                return true;
            }
            return false;
        }
    }

    if (!function_exists('getStatusProjectVN')) {
        function getStatusProjectVN($status)
        {
            switch ($status) {
                case 1:
                return "Sẵn sàng";
                break;
                case 2:
                return "Đang bán";
                break;
                case 3:
                return "Sắp mở bán";
                break;
                case 4:
                return "Ngừng bán";
                break;
            }
        }
    }

    if (!function_exists('getListStatusProjectVN')) {
        function getListStatusProjectVN()
        {
            return [
                'Sẵn sàng' => 1,
                'Đang bán' => 2,
                'Sắp mở bán' => 3,
                'Ngừng bán' => 4,
            ];
        }
    }

    if (!function_exists('getListStatusTransactionVN')) {
        function getListStatusTransactionVN()
        {
            return [
                'Đang xử lý' => 0,
                'Đã đăng ký' => 1,
                'Đã đặt cọc' => 2,
                'Đã thanh toán' => 3,
            ];
        }
    }


    if (!function_exists('getMap')) {
        function getMap($address)
        {
            try {
                $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address) . "&sensor=false";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $responseJson = curl_exec($ch);
                curl_close($ch);

                $response = json_decode($responseJson);

                if ($response->status == 'OK') {
                    $latitude = $response->results[0]->geometry->location->lat;
                    $longitude = $response->results[0]->geometry->location->lng;
                    return [
                        'latitude' => $latitude,
                        'longitude' =>  $longitude
                    ];
                } else {
                    return [
                        'latitude' => '16067476',
                        'longitude' =>  '108197696'
                    ];
                }
            }catch (Exception $e) {
                return [
                    'latitude' => '16067476',
                    'longitude' =>  '108197696'
                ];
            }
        }
    }

}