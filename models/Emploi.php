<?php
class Emploi
{
  public static function InsrtEmpois($data)
  {
    Emploi::delete($data);
    $database = DB::connect();
    $stm = $database->prepare("INSERT into emploidetemps(id_module,id_prof,id_jour,id_temps) values(:id_module,:id_prof,:id_jour,:id_temps)");
    $stm->bindParam('id_module', $data['id_module']);
    $stm->bindParam('id_prof', $data['id_prof']);
    $stm->bindParam('id_jour', $data['id_jour']);
    $stm->bindParam('id_temps', $data['id_temps']);
    $stm->execute();
  }
  public static function delete($data)
  {
    $database = DB::connect();
    $stm = $database->prepare("DELETE from emploidetemps WHERE id_prof=:id_prof and id_jour=:id_jour and id_temps=:id_temps ");
    $stm->bindParam('id_prof', $data['id_prof']);
    $stm->bindParam('id_jour', $data['id_jour']);
    $stm->bindParam('id_temps', $data['id_temps']);
    $stm->execute();
  }
  public static function getEmpois($data)
  {
    $database = DB::connect();
    $stm = $database->prepare("SELECT emploidetemps.*,modules.module_name FROM emploidetemps,modules WHERE emploidetemps.id_module=modules.module_id and emploidetemps.id_prof=:id_prof and emploidetemps.id_jour=:id_jour and emploidetemps.id_temps=:id_temps");
    $stm->bindParam('id_prof', $data['id_prof']);
    $stm->bindParam('id_jour', $data['id_jour']);
    $stm->bindParam('id_temps', $data['id_temps']);
    $stm->execute();
    if ($stm->rowCount()) {
      return $stm->fetch();
    } else {
      return 0;
    }
  }
  public static function getSeance($id_prof, $id_module)
  {
    $database = DB::connect();
    $stm = $database->prepare("SELECT * from emploidetemps Where id_module=$id_module and id_prof=$id_prof");
    $stm->execute();
    return $stm->fetchAll();
  }

  public static function  isExistModuleInthisjourInthisTime($module, $seance, $jour)
  {
    $database = DB::connect();
    $stm = $database->prepare("SELECT * from emploidetemps Where id_module=$module and id_temps=$seance and id_jour=$jour");
    $stm->execute();
    if ($stm->rowCount()) {
      return 1;
    } else {
      return 0;
    }
  }
}
