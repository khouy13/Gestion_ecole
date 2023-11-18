<?php
class Module
{
  public static function getModuleById($id){
    $stm = DB::connect()->prepare("SELECT * FROM modules where module_id=$id");
    $stm->execute();
    $res=$stm->fetch();
    return $res['module_name'];
  }
  static public function get($id)
  {
    $stm = DB::connect()->prepare("SELECT modules.*,classes.class_name,users.fullname FROM modules,classes,users WHERE modules.class_id = classes.class_id and users.user_id = modules.prof_id and module_id = '$id' ");
    $stm->execute();
    $module = $stm->fetch();
    return $module;
  }
  static public function all($semestre = null)
  {
    if ($semestre == null) {
      $stm = DB::connect()->prepare('SELECT modules.*,classes.class_name,users.fullname FROM modules,classes,users WHERE modules.class_id = classes.class_id and users.user_id = modules.prof_id ');
    } else {
      $stm = DB::connect()->prepare('SELECT modules.*,classes.class_name,users.fullname FROM modules,classes,users WHERE modules.class_id = classes.class_id and users.user_id = modules.prof_id and modules.semestre=:s');
      $stm->bindParam(':s', $semestre);
    }
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }
  static public function allModules($data)
  {
    $stm = DB::connect()->prepare('SELECT modules.*,classes.class_name,users.fullname FROM modules,classes,users WHERE modules.class_id = classes.class_id and users.user_id = modules.prof_id and classes.class_id=:id');
    $stm->bindParam(':id', $data);
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }
  static public function allModulesOfSemestre($data, $semestre)
  {
    if ($semestre == 0) {
      $stm = DB::connect()->prepare('SELECT modules.*,classes.class_name,users.fullname FROM modules,classes,users WHERE modules.class_id = classes.class_id and users.user_id = modules.prof_id and classes.class_id=:id ');
    } else {
      $stm = DB::connect()->prepare('SELECT modules.*,classes.class_name,users.fullname FROM modules,classes,users WHERE modules.class_id = classes.class_id and users.user_id = modules.prof_id and classes.class_id=:id and modules.semestre=:s');
      $stm->bindParam(':s', $semestre);
    }
    $stm->bindParam(':id', $data);
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }
  static public function ajouter($data)
  {
    $stm = DB::connect()->prepare('INSERT INTO modules (module_name,class_id,prof_id,semestre) values(:val,:depart,:prof,:s)');
    $stm->bindParam(':val', $data['module_name']);
    $stm->bindParam(':depart', $data['class_id']);
    $stm->bindParam(':prof', $data['prof_id']);
    $stm->bindParam(':s', $data['semestre']);
    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  static public function delete($data)
  {
    $stm = DB::connect()->prepare('DELETE FROM modules WHERE module_id=:val');
    $stm->bindParam(':val', $data);
    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  static public function getModuleProf($data, $semestre = null)
  {
    if ($semestre == null) {
      $semestre = $_SESSION['current_semestre'];
    }
    $stm = DB::connect()->prepare("SELECT modules.*,classes.class_name FROM modules,classes WHERE modules.class_id = classes.class_id and modules.prof_id=:id and modules.semestre=:semestre");
    $stm->bindParam(':id', $data);
    $stm->bindParam(':semestre', $semestre);
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }
  static public function getAllModules_S1_S2Prof($data)
  {

    $stm = DB::connect()->prepare("SELECT modules.*,classes.class_name FROM modules,classes WHERE modules.class_id = classes.class_id and modules.prof_id=:id ");
    $stm->bindParam(':id', $data);
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }
  static public function getAllModules_S1_S2Etudiant($data)
  {
    $stm = DB::connect()->prepare("SELECT * FROM modules WHERE class_id=:id ");
    $stm->bindParam(':id', $data);
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }

  static public function getModuleEtudiant($data, $semestre = null)
  {
    if ($semestre == null) {
      $semestre = $_SESSION['current_semestre'];
    }
    $stm = DB::connect()->prepare("SELECT * FROM modules WHERE class_id=:id and semestre=:semestre");
    $stm->bindParam(':id', $data);
    $stm->bindParam(':semestre', $semestre);
    $stm->execute();
    $modules = $stm->fetchAll();
    return $modules;
  }
  static public function getModuleOfNote($data)
  {
    $stm = DB::connect()->prepare("SELECT modules.*,classes.class_name FROM modules,classes WHERE modules.module_id=:id and modules.class_id=classes.class_id");
    $stm->bindParam(':id', $data);
    $stm->execute();
    $res = $stm->fetch();
    return $res;
  }
  static public function getByName($name)
  {
    $stm = DB::connect()->prepare('SELECT * FROM modules where module_name =:f_name');
    $stm->bindParam(':f_name', $name);
    $stm->execute();
    if ($stm->rowCount() == 0) {
      return null;
    }
    return $stm->fetch();
  }
  static public function update($data)
  {
    $stm = DB::connect()->prepare('UPDATE `modules` SET `module_name`=:f_name,`class_id`=:d_id,prof_id=:prof_id,semestre=:s WHERE `module_id`=:id');
    $stm->bindParam(':f_name', $data['module_name']);
    $stm->bindParam(':d_id', $data['class_id']);
    $stm->bindParam(':id', $data['module_id']);
    $stm->bindParam(':prof_id', $data['prof_id']);
    $stm->bindParam(':s', $data['semestre']);

    $stm->execute();
    return $stm->rowCount();
  }
}
