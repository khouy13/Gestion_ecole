<?php
class ClassController
{
  static public function get($id)
  {
    return Classe::get($id);
  }
  static public function getAllClasses()
  {
    if (isset($_POST['filliere_id'])) {
      $data = $_POST['filliere_id'];
      $_SESSION['filliere_id'] = $data;
      return Classe::Allclass($_SESSION['filliere_id']);
    } else if (isset($_SESSION['filliere_id'])) {
      return Classe::Allclass($_SESSION['filliere_id']);
    } else {
      Redirect::to('home');
    }
  }

  static public function ajouterClass()
  {

    if (!empty($_POST['class_name']) && !empty($_POST['filliere_id']) && !empty($_POST['niveau'])) {
      $data = array(
        'class_name' => $_POST['class_name'],
        'filliere_id' => $_POST['filliere_id'],
        'seuil' => $_POST['seuil'],
        'niveau' => $_POST['niveau']
      );
      if (Classe::getByName($data['class_name']) == null) {
        $res = Classe::ajouter($data);
        Redirect::to('classes');
      } else {
        echo "Ce nom du class est déja exist";
      }
    } else {
      Redirect::to("classes");
    }
  }

  static public function deleteClass()
  {
    if (isset($_POST['class_id'])) {
      $class_name = Classe::get($_POST['class_id'])['class_name'];
      $res = Classe::delete($_POST['class_id']);
    }
    Redirect::to('classes');
  }
  static public function getAllClassess()
  {
    $classes =  Classe::getAllClasses();
    foreach ($classes as $key => $class) {
      $classes[$key]['nbr_students'] = count(Etudiant::getEtudiantsOfClasse($class['class_id']));
    }
    return $classes;
  }
  static public function getClassesByFilliere($id)
  {
    $classes =  Classe::Allclass($id);
    foreach ($classes as $key => $class) {
      $classes[$key]['nbr_students'] = count(Etudiant::getEtudiantsOfClasse($class['class_id']));
    }
    return $classes;
  }
  static public function update()
  {
    if (!empty($_POST['class_name']) && !empty($_POST['filliere_id']) && !empty($_POST['class_id']) && !empty($_POST['seuil']) && !empty($_POST['niveau'])) {
      $data = array(
        'class_name' => $_POST['class_name'],
        'seuil' => $_POST['seuil'],
        'filliere_id' => $_POST['filliere_id'],
        'class_id' => $_POST['class_id'],
        'niveau' => $_POST['niveau']
      );
      if (Classe::getByName($data['class_name']) == null || (Classe::getByName($data['class_name'])['class_id'] == $data['class_id'])) {
        $res = Classe::update($data);
        Redirect::to('classes');
      } else {
        echo "Ce nom deja exist";
      }
    } else {
      Redirect::to('classes');
    }
  }
  static public function getClassesOfProf()
  {
    if ($_SESSION['user_info']['statut'] == 3) {
      Redirect::to('home');
    }
    $classes = Classe::getOfProf($_SESSION['user_info']['user_id']);
    return $classes;
  }
  static public function getClassesLastYear()
  {
    return Classe::getClassesLastYear();
  }
  static public function getClassByFilliereAndNiveau($filliere, $niveau)
  {
    return Classe::getClassByFilliereAndNiveau($filliere, $niveau);
  }
  static public function getAllClassessSaufLY()
  {
    if (isset($_SESSION['admin_id'])) {
      return Classe::getAllClassessSaufLY();
    }
  }
}
