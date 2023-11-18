<?php
class Contact
{
    static public function AddMessage($message)
    {
        $user = $_SESSION['user_info']['fullname'];
        $stm = DB::connect()->prepare("INSERT INTO `messages`( `message_content`, `message_user`) VALUES (:msg,:usr)");
        $stm->bindParam(':usr', $user);
        $stm->bindParam(':msg', $message);
        $stm->execute();
        return $stm->rowCount() > 0;
    }
    public static function getAllMessage()
    {
        $stm = DB::connect()->prepare("SELECT messages.*,users.* FROM messages,users WHERE users.fullname=messages.message_user and users.statut=2  ORDER BY messages.message_date DESC");
        $stm->execute();
        $messagesProf = $stm->fetchAll();
        $stm = DB::connect()->prepare("SELECT messages.*,users.* FROM messages,users WHERE users.fullname=messages.message_user and users.statut=3  ORDER BY messages.message_date DESC");
        $stm->execute();
        $messagesStudents = $stm->fetchAll();
        return [$messagesProf, $messagesStudents];
    }
    public static function update($id)
    {
        $stm = DB::connect()->prepare("UPDATE  messages SET message_statut=1 WHERE message_id=:id");
        $stm->bindParam(':id', $id);
        $stm->execute();

        return $stm->rowCount();
    }
    public static function delete($id)
    {
        $stm = DB::connect()->prepare("DELETE FROM  messages WHERE message_id=:id");
        $stm->bindParam(':id', $id);
        $stm->execute();

        return $stm->rowCount();
    }
}
