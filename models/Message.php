<?php
class Message{
     public static function getAllMessage($data){
        $stm=DB::connect()->prepare("SELECT * FROM message WHERE module_id=:id ORDER BY date_pub DESC");
        $stm->bindParam(':id',$data);
        $stm->execute();
        return $stm->fetchAll();
        }
    public static function inserer($data){
    $stm=DB::connect()->prepare("INSERT INTO message (message_content,module_id) values(:m,:i)");
    $stm->bindParam(':m',$data['message_content']);
    $stm->bindParam(':i',$data['module_id']);
    if($stm->execute()){
        return 'ok';
    }
    else{
        return 'error';
    }
    }
    public static function suprimer($data){
        $stm=DB::connect()->prepare("DELETE FROM message WHERE message_id=:id");
        $stm->bindParam(':id',$data);
        if($stm->execute()){
            return 'ok';
        }
        else{
            return 'error';
        }
     }
}