<?php
class Notification
{
    static public function getNumberNotificationsNonSeen()
    {
        $stm = DB::connect()->prepare("SELECT * FROM `notifications` WHERE notification_receptor='" . $_SESSION['user_info']['user_id'] . "' and notification_statut='0'");
        $stm->execute();
        return $stm->rowCount();
    }
    static public function getNotificationsNonSeen($receptor)
    {
        $stm = DB::connect()->prepare("SELECT * FROM `notifications` WHERE notification_receptor='$receptor' and notification_statut='0'");
        $stm->execute();
        return $stm->fetchAll();
    }
    static public function makeNotificationsSeen($receptor, $module)
    {
        $stm = DB::connect()->prepare("UPDATE `notifications` SET `notification_statut`='1' WHERE notification_receptor='$receptor' and notification_module='$module';");
        $stm->execute();
        return $stm->rowCount();
    }
    static public function AddNotification($content, $receptor, $module)
    {
        $stm = DB::connect()->prepare("INSERT INTO `notifications`( `notification_content`, `notification_receptor`,  `notification_module`) VALUES ('$content','$receptor','$module')");
        $stm->execute();
        return $stm->rowCount();
    }
}
