<?php
class Absence
{
    static public function get()
    {
        $stm = DB::connect()->prepare('SELECT * FROM `absence` WHERE 1');
        $stm->execute();
        $absences = $stm->fetchAll();
        return $absences;
    }
    static public function getAll($id)
    {
        $stm = DB::connect()->prepare('SELECT * FROM `absence` WHERE absence_module=:module and absence_annee=:a');
        $stm->bindParam(':module', $id);
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm->execute();
        $absences = $stm->fetchAll();
        return $absences;
    }
    static public function getAllSchool()
    {
        $stm = DB::connect()->prepare("SELECT users.*, COALESCE(nombre_absences, 0) AS nombre_absences, classes.class_name
        FROM users
        JOIN classes ON users.class = classes.class_id
        LEFT JOIN (
            SELECT absence_user, COUNT(*) AS nombre_absences
            FROM absence
            WHERE absence_annee = :a
            GROUP BY absence_user
        ) AS subquery ON users.user_id = subquery.absence_user ORDER BY nombre_absences DESC;
        ");
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm->execute();
        $users = $stm->fetchAll();
        return $users;
    }
    static public function getAllOfClass($id)
    {
        $stm = DB::connect()->prepare("SELECT users.*, COALESCE(nombre_absences, 0) AS nombre_absences, classes.class_name
        FROM users
        JOIN classes ON users.class = classes.class_id
        LEFT JOIN (
            SELECT absence_user, COUNT(*) AS nombre_absences
            FROM absence
            WHERE absence_annee = :a
            GROUP BY absence_user
        ) AS subquery ON users.user_id = subquery.absence_user
        WHERE classes.class_id = :class ORDER BY nombre_absences DESC;
        ");
        $stm->bindParam(":class", $id);
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm->execute();
        $users = $stm->fetchAll();
        return $users;
    }
    static public function get_module_month_user($module, $month, $user)
    {
        $stm = DB::connect()->prepare(' SELECT * FROM `absence` WHERE absence_module=:module and MONTH(absence_date) =:mois and absence_user=:user and absence_annee=:a');
        $stm->bindParam(':module', $module);
        $stm->bindParam(':mois', $month);
        $stm->bindParam(':user', $user);
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm->execute();
        $absences = $stm->fetchAll();
        return $absences;
    }



    static public function insert($user, $seance, $date, $module)
    {
        if ($date == null) {
            $date = date("Y-m-d");
        }
        $stm = DB::connect()->prepare('INSERT INTO `absence`( `absence_user`,`absence_date`,`id_seance`,absence_module,absence_annee) VALUES (:usr,:dat,:seance,:module,:a)');
        $stm->bindParam(':usr', $user);
        $stm->bindParam(':dat', $date);
        $stm->bindParam(':seance', $seance);
        $stm->bindParam(':module', $module);
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm->execute();
        return $stm->rowCount();
    }
    static public function delete($data)
    {
        $stm = DB::connect()->prepare('DELETE * FROM absence WHERE absence_id=:val');
        $stm->bindParam(':val', $data);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function update($user, $seance, $date, $id)
    {

        $stm = DB::connect()->prepare("UPDATE `absence` SET `absence_user`=:usr,`absence_date`=:dat,`absence_seance`=:seance WHERE absence_id=:id");
        $stm->bindParam(':usr', $user);
        $stm->bindParam(':dat', $date);
        $stm->bindParam(':seance', $seance);
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->rowCount();
    }
    static public function delete_month_module($month, $module)
    {
        $stm = DB::connect()->prepare('DELETE FROM absence WHERE MONTH(absence_date) = :mois and absence_module=:module;');
        $stm->bindParam(':module', $module);
        $stm->bindParam(':mois', $month);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
}
