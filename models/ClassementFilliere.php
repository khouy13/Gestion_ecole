<?php
class ClassementFilliere
{
    static public function get($id)
    {
        $stm = DB::connect()->prepare("SELECT * FROM classement_filliere WHERE user_id=:id ");
        $stm->bindParam(':id', $id);
        $stm->execute();
        $data = $stm->fetch();
        return $data;
    }
    static public function insert($id, $classement, $annee)
    {
        $stm = DB::connect()->prepare("INSERT INTO `classement_filliere`( `user_id`, `classement_value`, `annee`) VALUES (:u,:c,:a)");
        $stm->bindParam(':u', $id);
        $stm->bindParam(':c', $classement);
        $stm->bindParam(':a', $annee);
        $stm->execute();
        $res = $stm->rowCount();
        return $res;
    }
    static public function update($id, $classement, $annee, $c_id)
    {
        $stm = DB::connect()->prepare("UPDATE `classement_filliere` SET `user_id`=:u,`classement_value`=:c,`annee`=:a WHERE classement_id=:id");
        $stm->bindParam(':u', $id);
        $stm->bindParam(':c', $classement);
        $stm->bindParam(':a', $annee);
        $stm->bindParam(':id', $c_id);
        $stm->execute();
        $res = $stm->rowCount();
        return $res;
    }
}
