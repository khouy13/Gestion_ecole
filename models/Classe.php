<?php
class Classe
{
  static public function get($id)
  {
    $stm = DB::connect()->prepare("SELECT * FROM classes WHERE class_id=:id");
    $stm->bindParam(':id', $id);
    $stm->execute();
    return $stm->fetch();
  }
  static public function getAllClasses()
  {
    $stm = DB::connect()->prepare('SELECT classes.*,filliere.filliere_name FROM classes,filliere WHERE classes.filliere_id = filliere.filliere_id ORDER BY niveau');
    $stm->execute();
    $employes = $stm->fetchAll();
    return $employes;
  }
  static public function Allclass($data)
  {
    $stm = DB::connect()->prepare('SELECT classes.*,filliere.filliere_name FROM classes,filliere WHERE classes.filliere_id = filliere.filliere_id  and filliere.filliere_id=:id');
    $stm->bindParam(':id', $data);
    $stm->execute();
    $employes = $stm->fetchAll();
    return $employes;
  }
  static public function ajouter($data)
  {
    $stm = DB::connect()->prepare('INSERT INTO classes (class_name,filliere_id,seuil,niveau) values(:val,:depart,:seuil,:n)');
    $stm->bindParam(':val', $data['class_name']);
    $stm->bindParam(':depart', $data['filliere_id']);
    $stm->bindParam(':seuil', $data['seuil']);
    $stm->bindParam(':n', $data['niveau']);
    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  static public function delete($data)
  {
    $stm = DB::connect()->prepare('DELETE FROM classes WHERE class_id=:val');
    $stm->bindParam(':val', $data);
    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  static public function getByName($name)
  {
    $stm = DB::connect()->prepare('SELECT * FROM classes where class_name =:f_name');
    $stm->bindParam(':f_name', $name);
    $stm->execute();
    if ($stm->rowCount() == 0) {
      return null;
    }
    return $stm->fetch();
  }
  static public function update($data)
  {
    $stm = DB::connect()->prepare('UPDATE `classes` SET `class_name`=:f_name,`filliere_id`=:d_id,seuil=:seuil,niveau=:n WHERE `class_id`=:id');
    $stm->bindParam(':f_name', $data['class_name']);
    $stm->bindParam(':d_id', $data['filliere_id']);
    $stm->bindParam(':id', $data['class_id']);
    $stm->bindParam(':seuil', $data['seuil']);
    $stm->bindParam(':n', $data['niveau']);
    $stm->execute();
    return $stm->rowCount();
  }
  static public function getOfProf($id)
  {
    $stm = DB::connect()->prepare("SELECT DISTINCT classes.class_name from modules,classes where modules.prof_id=:id and modules.class_id=classes.class_id");
    $stm->bindParam(':id', $id);
    $stm->execute();
    return $stm->fetchAll();
  }
  static public function getClassesLastYear()
  {
    $stm = DB::connect()->prepare("SELECT * FROM classes WHERE niveau=5  ");
    $stm->execute();
    return $stm->fetchAll();
  }
  static public function getClassByFilliereAndNiveau($filliere, $niveau)
  {
    $stm = DB::connect()->prepare("SELECT  * from classes where filliere_id=:filliere and niveau=:n");
    $stm->bindParam(':filliere', $filliere);
    $stm->bindParam(':n', $niveau);
    $stm->execute();
    return $stm->fetch();
  }
  static public function getAllClassessSaufLY()
  {
    $stm = DB::connect()->prepare("SELECT  * from classes where niveau!=5 ORDER BY `classes`.`niveau` DESC");
    $stm->execute();
    return $stm->fetchAll();
  }
  static public function get2Class()
  {
    $stm = DB::connect()->prepare("SELECT  * from classes where niveau=2");
    $stm->execute();
    return $stm->fetch();
  }
  static public function getSizeOfClass3()
  {
    $stm = DB::connect()->prepare("SELECT  * from classes where niveau=3 ORDER BY filliere_id");
    $stm->execute();
    return $stm->fetchAll();
  }
}
