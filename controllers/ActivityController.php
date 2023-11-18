<?php
class ActivityController
{
    static public function getAll()
    {
        $activities = Activity::get();
        $datas = [];
        foreach ($activities as $activity) {
            $data = [];
            $data['id'] = $activity['activity_id'];
            $data['content'] = $activity['activity_content'];
            $data['time'] = ActivityController::time($activity['activity_date']);
            $data['fullname'] = $activity['fullname'];
            $datas[] = $data;
        }
        return $datas;
    }

    static public function time($date_str)
    {

        $current_date = new DateTime('now');
        $given_date = new DateTime($date_str);
        $diff = $given_date->diff($current_date);

        $total_seconds = ($diff->s + $diff->i * 60 + ($diff->h - 2) * 3600 + $diff->days * 86400);


        if ($total_seconds < 60) {
            return "Maintenant";
        }

        if ($total_seconds < 3600) {
            if ($diff->i == 1) {
                return "il y'a une minute";
            }
            return "il y' a " . floor($total_seconds / 60) . " minutes";
        }

        if ($total_seconds < 86400) {
            if ($diff->h == 1) {
                return "il y'a une heure";
            }
            return "il y' a " . floor($total_seconds / 3600) . " heures";
        }

        if ($total_seconds < 604800) {
            if ($diff->days == 1) {
                return "Hier";
            }
            return "il y' a " . floor($total_seconds / 86400) . " jours";
        }

        if ($total_seconds < 2592000) {
            if (floor($total_seconds / 604800) == 1) {
                return "il y' a une semaine";
            }
            return "il y' a " . floor($total_seconds / 604800) . " semaines";
        }

        if ($total_seconds < 31536000) {
            return "il y' a " . floor($total_seconds / 2592000) . " mois";
        } else {
            if ($diff->y == 1) {
                return "il y' a une année";
            }
            return "il y' a " . $diff->y . " années";
        }


        //end time function
    }
    static public function getActivityOfProf()
    {
        if ($_SESSION['user_info']['statut'] != 2) {
            Redirect::to('home');
        }
        $activities = Activity::getActivitiesOf($_SESSION['user_info']['user_id']);
        return $activities;
    }

static public function formatDateString($dateString)
{
    $timestamp = strtotime($dateString);
    
    $dayNames = array(
        'Sunday'    => 'dimanche',
        'Monday'    => 'lundi',
        'Tuesday'   => 'mardi',
        'Wednesday' => 'mercredi',
        'Thursday'  => 'jeudi',
        'Friday'    => 'vendredi',
        'Saturday'  => 'samedi'
    );

    $monthNames = array(
        'January'   => 'janvier',
        'February'  => 'février',
        'March'     => 'mars',
        'April'     => 'avril',
        'May'       => 'mai',
        'June'      => 'juin',
        'July'      => 'juillet',
        'August'    => 'août',
        'September' => 'septembre',
        'October'   => 'octobre',
        'November'  => 'novembre',
        'December'  => 'décembre'
    );

    $dayName = date("l", $timestamp);
    $dayNameFrench = $dayNames[$dayName];
    $day = date("d", $timestamp);
    $monthName = date("F", $timestamp);
    $monthNameFrench = $monthNames[$monthName];
    
    $formattedDate = $dayNameFrench . " " . $day . ", " . $monthNameFrench;
    return $formattedDate;
}
}
