<?php
class Ajourne
{
    static public function insert($user, $class, $anne)
    {
        $stm = DB::connect()->prepare("INSERT INTO `ajoune`( `user_id`, `class_id`, `anne`) VALUES (:u,:c,:a)");
        $stm->bindParam(':u', $user);
        $stm->bindParam(':c', $class);
        $stm->bindParam(':a', $anne);
        $stm->execute();
        $res = $stm->rowCount();
        return $res;
    }
}
