<?php
class Laureat
{
    static public function insert($user, $filliere, $moyenne)
    {
        $stm = DB::connect()->prepare("INSERT INTO `laureats`( `user_id`, `filliere_id`, `moyenne`, `annee`) VALUES (:u,:f,:m,:a)");
        $stm->bindParam(':u', $user);
        $stm->bindParam(':f', $filliere);
        $stm->bindParam(':m', $moyenne);
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm->execute();
        $res = $stm->rowCount();
        return $res;
    }
}
