<?php
class MessageController{
public static function getAllMessage(){
    if(isset($_POST['submit']) && isset($_POST['module_id'])){
        $_SESSION['module_id']=$_POST['module_id'];
     return Message::getAllMessage($_SESSION['module_id']);
    }
    if(isset($_SESSION['module_id'])){
        return Message::getAllMessage($_SESSION['module_id']);
    }
}
public static function inserer(){
    if(isset($_POST['ajouter']) && isset($_POST['module_id'])){
        $data=[
            'message_content'=>$_POST['message_content'],
            'module_id'=>$_POST['module_id']
        ];
       $res= Message::inserer($data);
       if($res=='ok'){
        Redirect::to('message');
       }
       else{
        echo 'error';
       }
    }
}
public static function suprimer(){
    if(isset($_POST['suprimer'])&& isset($_POST['message_id'])){
    $res=Message::suprimer($_POST['message_id']);
    if($res=='ok'){
        Redirect::to('message');
    }
}
}
public static function DesactiveNbrMessage(){
    if(isset($_POST['module_id'])&& isset($_POST['submit'])){
      Message::desactiver($_POST['module_id']);
    }
}
}