<?php
class Cour
{
    static public function getCour($id)
    {
        $stm = DB::connect()->prepare("SELECT * FROM cours WHERE cour_id='$id'");
        
        $stm->execute();
        $task = $stm->fetch();
        return $task;
    }
    static public function getCourofModule($data)
    {
        $stm = DB::connect()->prepare("SELECT * FROM cours WHERE module_id=:id and cour_annee=:annee ORDER BY `cours`.`date_pub` DESC");
        $stm->bindparam(':id', $data);
        $stm->bindParam(':annee', $_SESSION['annee_universitaire']);
        $stm->execute();
        $cours = $stm->fetchAll();
        return $cours;
    }
    static public function supprimer($data)
    {
        $stm = DB::connect()->prepare('DELETE FROM cours WHERE cour_id=:id');
        $stm->bindParam(':id', $data);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function ajouterCour($name, $prof, $module, $files)
    {

        $target_dirP = "assets/Cours/";
        $nameImage = basename(rand(0, 100000000000) . "_" . str_replace('\'', '_', $files["file"]["name"]));
        $target_image = $target_dirP . $nameImage;
        $uOk = 1;

        $database = DB::connect();
        $stm = DB::connect()->prepare('INSERT INTO cours (cour_name,filename,module_id,prof_id,cour_annee)values(:c,:f,:m,:p,:a)');
        $stm->bindParam(':c', $name);
        $stm->bindParam(':f', $target_image);
        $stm->bindParam(':m', $module);
        $stm->bindParam(':p', $prof);
        $stm->bindParam(':a', $$_SESSION['annee_universitaire']);
        $stm->execute();

        //#################################"   Upload file  ###############################"
        if (move_uploaded_file($files["file"]["tmp_name"], $target_image) && $stm->rowCount() > 0) {
            return 'ok';
        } else {
            return 'A probleme was happen';
        }
    }
}
