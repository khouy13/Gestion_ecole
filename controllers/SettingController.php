<?php
class SettingController
{
    static public function getAll()
    {
        $datas = Setting::getAll();
    }
    static public function getCurrentSeasonAndSemestre()
    {
        $datas = Setting::getAll();
        foreach ($datas as $data) {
            if ($data['setting_label'] == "current_semestre") {
                $_SESSION['current_semestre'] = $data['setting_value'];
            } else if ($data['setting_label'] == "annee_universitaire") {
                $_SESSION['annee_universitaire'] = $data['setting_value'];
            }
        }
    }
}
