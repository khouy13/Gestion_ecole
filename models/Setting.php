<?php
class Setting
{
    static public function getAll()
    {
        $stm = DB::connect()->prepare("SELECT * FROM website_setting");
        $stm->execute();
        $datas = $stm->fetchAll();
        return $datas;
    }
    static public function changeSemestre($s)
    {
        $stm = DB::connect()->prepare("UPDATE `website_setting` SET `setting_value`=:s WHERE setting_label='current_semestre'");
        $stm->bindParam(':s', $s);
        $stm->execute();
        $result = $stm->rowCount();
        return $result;
    }
    static public function changeAnne()
    {
        $stm = DB::connect()->prepare("UPDATE `website_setting` SET `setting_value`=1 WHERE setting_label='current_semestre'");
        $stm->execute();
        $result = $stm->rowCount();
        $stm2 = DB::connect()->prepare("UPDATE `website_setting` SET `setting_value`=:a WHERE setting_label='annee_universitaire'");
        $anne = (int)$_SESSION['annee_universitaire'] + 1;
        $stm2->bindParam(':a', $anne);
        $stm2->execute();
        $result2 = $stm2->rowCount();
        SettingController::getCurrentSeasonAndSemestre();
        return ($result2 > 0 && $result > 0);
    }
}
