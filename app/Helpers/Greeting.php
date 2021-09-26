<?php

namespace App\Helpers;

class Greeting
{
    public static function greeting()
    {

        $hour      = date('H');

        $greetings='';
        if ($hour >= 20) {
            $greetings = "Good Night";
        } elseif ($hour > 17) {
            $greetings = "Good Evening";
        } elseif ($hour > 11) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = "Good Morning";
        }
        return $greetings;


//        if(now()->hour > 12) {
//            return 'Good morning';
//        } elseif (now()->hour > 19) {
//            return 'Good evening';
//        }
//        return 'Good afternoon';
    }
}
