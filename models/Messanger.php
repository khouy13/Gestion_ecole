<?php
class Messanger
{
    static public function getProfilesMessanger($id, $list)
    {
        $stm = DB::connect()->prepare("SELECT * FROM `users` WHERE  (class='" . $_SESSION['user_info']["class"] . "' or user_id in  $list ) and user_id!='$id' ;");
        $stm->execute();
        return $stm->fetchAll();
    }

    static public function getMessagesBetween($id1, $id2)
    {
        $statement = $database = DB::connect()->prepare("SELECT * FROM `messanger` WHERE (message_sender='$id1' and message_receptor='$id2') or (message_sender='$id2' and message_receptor='$id1')");

        $statement->execute();
        return $statement->fetchAll();
    }
    static public function AddMessgeInMessanger($sender, $receptor, $message_content)
    {
        $statement  = DB::connect()->prepare("INSERT INTO `messanger`(`message_id`, `message_content`, `message_sender`, `message_receptor`) VALUES (NULL,'$message_content','$sender','$receptor') ");

        $statement->execute();
        return $statement->rowCount() > 0;
    }
    static public function isHereMessage($message_id)
    {
        $statement = DB::connect()->prepare("SELECT * FROM `messanger` WHERE message_id = '$message_id'");
        $statement->execute();
        return $statement->fetch()['message_sender'] == $_SESSION['user_info']['user_id'];
    }
    static public function deleteMessageFromDB($message_id)
    {
        $statement = DB::connect()->prepare("DELETE FROM `messanger` WHERE message_id = '$message_id' ");

        $statement->execute();
        return $statement->rowCount() > 0;
    }
    static public function makeMessagesSeen($sender, $receptor)
    {
        $statement = DB::connect()->prepare("UPDATE `messanger` SET `message_isSeen`='1' WHERE message_sender='$sender' and message_receptor='$receptor';");

        $statement->execute();
        return $statement->rowCount() > 0;
    }
    static public function getNumberMessagesNonSeen($receptor)
    {
        $statement = DB::connect()->prepare("SELECT * FROM `messanger` WHERE message_receptor='$receptor' and message_isSeen='0'");

        $statement->execute();
        return $statement->rowCount();
    }
    static public function getLastMessageBetween($id1, $id2)
    {
        $statement = DB::connect()->prepare("SELECT * FROM `messanger` WHERE (message_sender='$id1' and message_receptor='$id2') or (message_sender='$id2' and message_receptor='$id1') ORDER BY `messanger`.`message_time` DESC LIMIT 1");

        $statement->execute();
        return $statement->fetch();
    }
    static public function MessagesNoSeen($sender, $receptor)
    {
        $statement = DB::connect()->prepare("SELECT * FROM `messanger` WHERE message_sender='$sender' and message_receptor='$receptor' and message_isSeen='0';");

        $statement->execute();
        return $statement->rowCount();
    }
    static public function getLastMessages()
    {
        $statement = DB::connect()->prepare("SELECT DISTINCT messanger.message_sender,messanger.message_receptor  FROM `messanger` where message_receptor='" . $_SESSION['user_info']['user_id'] . "' or message_sender='" . $_SESSION['user_info']['user_id'] . "'
        ORDER BY `messanger`.`message_time` DESC;");

        $statement->execute();
        $messages = $statement->fetchAll();
        return $messages;
    }
}
