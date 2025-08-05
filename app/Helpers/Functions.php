<?php

namespace App\Helpers;
use Illuminate\Support\Carbon;
// app/Helpers/helpers.php

class Functions
{
    public static function IDGenerator($model, $user_id, $prefix, $length,$id)
    {
        // Directly use the provided ID
        $length = 5;
        $last_number = $id;
    
        // Determine the length of the numeric part
        $last_number_length = strlen($last_number);
        $og_length = $length - $last_number_length;
    
        // Ensure $og_length is not negative
        if ($og_length < 0) {
            $og_length = 0;
        }
    
        // Add leading zeros to maintain the desired length
        $zeros = str_repeat("0", $og_length);
    
        // Return the generated ID with the prefix
        return $prefix . '-' . $zeros . $last_number;
    }

    //STATUS COLOR
    public static function status_color($status)
    {
        switch ($status) {
            case '1':
                return 'badge-success';
            case '0':
                return 'badge-warning';
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

    //REVIEW STATUS
    public static function review_status($status)
    {
        switch ($status) {
            case 'For Review':
                return 'fa-magnifying-glass-chart';
            case 'Approved':
                return 'fa-check-circle';
            case 'In Progress':
                return 'fa-circle';
            default:
                return 'badge-dark';
        }
    }

    public static function review_status_color($status)
    {
        switch ($status) {
            case 'For Review':
                return 'color-disabled';
            case 'Approved':
                return 'color-success';
            case 'In Progress':
                return 'color-in_progress';
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
            case ($interval < 10080 * 2):
                return "A week ago";
            case ($interval < 10080 * 3):
                return "More than a week ago";
            case ($interval < 10080 * 4):
                return "More than 2 weeks ago";
            case ($interval < 10080 * 5):
                return "More than 3 weeks ago";
            case ($interval < 10080 * 6):
                return "More than 4 weeks ago";
            default:
                return "More than a month ago";
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
