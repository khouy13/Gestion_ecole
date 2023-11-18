<?php
class NoteHistory
{
    public static function getLast2Years($user_id, $class_id1, $class_id2)
    {
        $stm1 = DB::connect()->prepare("SELECT * FROM historique_note WHERE student_id=:user and class_id=:class");
        $stm1->bindParam(':user', $user_id);
        $stm1->bindParam(':class', $class_id1);
        $stm1->execute();
        $note1 = ($stm1->rowCount() > 0) ? $stm1->fetch()['note_value'] : -1;
        $stm2 = DB::connect()->prepare("SELECT * FROM historique_note WHERE student_id=:user and class_id=:class");
        $stm2->bindParam(':user', $user_id);
        $stm2->bindParam(':class', $class_id2);
        $stm2->execute();
        $note2 = ($stm2->rowCount() > 0) ? $stm2->fetch()['note_value'] : -1;
        return [$note1, $note2];
    }
    public static function insert($user_id, $note, $class_id1)
    {
        $stm1 = DB::connect()->prepare("INSERT INTO `historique_note`( `student_id`, `note_value`, `annee`, `class_id`) VALUES (:u,:n,:a,:c)");
        $stm1->bindParam(':u', $user_id);
        $stm1->bindParam(':n', $note);
        $stm1->bindParam(':a', $_SESSION['annee_universitaire']);
        $stm1->bindParam(':c', $class_id1);
        $stm1->execute();
        $res = $stm1->rowCount();
        return $res;
    }
}
