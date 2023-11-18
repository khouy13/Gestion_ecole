<?php
class Activity
{
    static public function get()
    {
        $stm = DB::connect()->prepare('SELECT activities.*,users.fullname FROM `activities`,users WHERE activities.activity_person = users.user_id ORDER BY activities.activity_date DESC LIMIT 8');
        $stm->execute();
        $activities = $stm->fetchAll();
        return $activities;
    }
    static public function getActivitiesOf($id)
    {
        $stm = DB::connect()->prepare('SELECT * FROM `activities` WHERE activity_person=:id ORDER BY activity_date DESC LIMIT 8');
        $stm->bindParam(':id', $id);
        $stm->execute();
        $activities = $stm->fetchAll();
        return $activities;
    }

    static public function insert($data)
    {
        if ($_SESSION['user_info']['statut'] == 1) {
            $stm = DB::connect()->prepare('INSERT INTO `activities`( `activity_content`) VALUES (:val)');
        } else {
            $stm = DB::connect()->prepare('INSERT INTO `activities`( `activity_content`, activity_person) VALUES (:val,:id)');
            $stm->bindParam(':id', $_SESSION['user_info']['user_id']);
        }
        $stm->bindParam(':val', $data);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function delete($data)
    {
        $stm = DB::connect()->prepare('DELETE FROM activities WHERE activity_id=:val');
        $stm->bindParam(':val', $data);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
}
