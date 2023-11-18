<?php
class Temps{
    public static function getTemps(){
        $database=DB::connect();
        $stm=$database->prepare("SELECT * FROM temps");
        $stm->execute();
        return $stm->fetchAll();
    }
    public static function getNomTemps($id){
        $database=DB::connect();
        $stm=$database->prepare("SELECT * FROM temps where id=$id");
        $stm->execute();
        return $stm->fetch()['name_temps'];
    }

}