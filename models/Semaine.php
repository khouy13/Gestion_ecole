<?php
class Semaine{
    public static function getSemaine(){
        $database=DB::connect();
        $stm=$database->prepare("SELECT * FROM semaine");
        $stm->execute();
        return $stm->fetchAll();
    }
    public static function getNomJour($id){
        $database=DB::connect();
        $stm=$database->prepare("SELECT * FROM semaine WHERE id_jour=$id");
        $stm->execute();
        return $stm->fetch()['nom_jour'];
    }
}