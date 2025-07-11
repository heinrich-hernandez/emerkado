<?php

namespace App\Helpers;
use Illuminate\Support\Carbon;
// app/Helpers/helpers.php

class Functions
{

    public static function IDGenerator($model, $trow, $prefix, $id, $length = 5)
    {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            //$actual_last_number = ($code/1)*1;  intval($code);
            $actual_last_number = intval($code);
            $increment_last_number = $actual_last_number + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }

        return $prefix . '-' . $zeros . $last_number;
    }

    //STATUS COLOR
    public static function status_color($status)
    {
        switch ($status) {
            case 'Approved':
                return 'badge-success';
            case 'For approval':
                return 'badge-warning';
            case 'Disapproved':
                return 'badge-danger';
            default:
                return 'badge-secondary';
        }
    }

    //STATUS COLOR
    public static function userrole_color($status)
    {
        switch ($status) {
            case 'Coop':
                return 'coop-color';
            case 'Merchant':
                return 'merchant-color';
            case 'Buyer':
                return 'buyer-color';
            default:
                return 'badge-dark';
        }
    }

    /*  if (! function_exists('show')) {
        function show() {
            echo('asdasd');
        }
    }*/

    //start // Create_at interval
    //switch case argument instead of if else
    public static function interval_status($interval) {
        switch (true) {
            case ($interval < 60):
                return "Just now";
            case ($interval < 1440):
                return "Less than a day ago";
            case ($interval < 2880):
                return "1 day ago";
            case ($interval < 4320):
                return "2 days ago";
            case ($interval < 5760):
                return "3 days ago";
            case ($interval < 7200):
                return "4 days ago";
            case ($interval < 8640):
                return "5 days ago";
            case ($interval < 10080):
                return "6 days ago";
            default:
                return "More than a week ago";
        }
    }

    public static function GetDateInterval($date) {
        $created_at = Carbon::parse($date);
        $date_now = Carbon::now();

        $interval = $created_at->diffInMinutes($date_now);

        $status = self::interval_status($interval);

        return $status;
    }

     // end // Create_at interval
}
