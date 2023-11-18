<?php
class NextSemestreController
{
    static public function NextSemestre()
    {
        if (!isset($_SESSION['admin_id'])) {
            Redirect::to('home');
        }
        $CheckNotes = NextYearController::CheckNotesForSemestre(1);
        if (!empty($CheckNotes)) {
            Redirect::to('home');
        }
        Setting::changeSemestre(2);
        SettingController::getCurrentSeasonAndSemestre();
        Redirect::to('home');
    }
}
