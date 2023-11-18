<?php
class Etudiant
{
  static public function getUser($id)
  {
    $stm = DB::connect()->prepare("SELECT * FROM users WHERE user_id = '$id'");
    $stm->execute();
    return $stm->fetch();
  }
  static public function AllEtudiant($data)
  {
    $stm = DB::connect()->prepare('SELECT * FROM users WHERE class=:id and statut=3');
    $stm->bindParam(':id', $data);
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }
  static public function getEtudiantsOfClasse($class_id)
  {
    $stm = DB::connect()->prepare("SELECT users.*,classes.class_name,filliere.filliere_name FROM users,classes,filliere WHERE users.class = classes.class_id and classes.filliere_id = filliere.filliere_id and  class = '$class_id' and statut='3' ORDER BY users.fullname");
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }
  static public function getEtudiantsOfClasses($listOfclass)
  {
    $stm = DB::connect()->prepare("SELECT * FROM users WHERE class in $listOfclass and statut='3'");
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }

  static public function AllProf($data)
  {
    $stm = DB::connect()->prepare('SELECT users.*,departement.* FROM users,departement WHERE departement=:id and statut=2 and users.departement=departement.departement_id');
    $stm->bindParam(':id', $data);
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }
  static public function getProfsOfClass($id)
  {
    $stm = DB::connect()->prepare('SELECT users.*,modules.prof_id FROM modules,users WHERE modules.class_id=:id and users.user_id=users.user_id');
    $stm->bindParam(':id', $id);
    $stm->execute();
    $profs = $stm->fetchAll();
    return $profs;
  }
  static public function ajouter($data)
  {
    $stm = DB::connect()->prepare("INSERT INTO `users`( `username`, `fullname`, `email`, `password_user`, `class`, `user_adress`, `user_number`, `statut`) VALUES (:username,:fullname,:email,:password_user,:class,:user_adress,:user_number,'3')");
    $stm->bindParam(':username', $data['username']);
    $stm->bindParam(':fullname', $data['fullname']);
    $stm->bindParam(':email', $data['email']);
    $stm->bindParam(':password_user', $data['password']);
    $stm->bindParam(':class', $data['class']);
    $stm->bindParam(':user_adress', $data['adresse']);
    $stm->bindParam(':user_number', $data['phone']);

    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  static public function ajouterprof($data)
  {
    $stm = DB::connect()->prepare("INSERT INTO `users`( `username`, `fullname`, `email`, `password_user`, `departement`, `user_adress`, `user_number`, `statut`) VALUES (:username,:fullname,:email,:password_user,:departement,:user_adress,:user_number,'2')");
    $stm->bindParam(':username', $data['username']);
    $stm->bindParam(':fullname', $data['fullname']);
    $stm->bindParam(':email', $data['email']);
    $stm->bindParam(':password_user', $data['password']);
    $stm->bindParam(':departement', $data['departement_id']);
    $stm->bindParam(':user_adress', $data['adresse']);
    $stm->bindParam(':user_number', $data['phone']);

    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  static public function delete($data)
  {
    $stm1 = DB::connect()->prepare('SELECT statut FROM users where user_id=:val1');
    $stm1->bindParam(':val1', $data);
    $stm1->execute();
    $res = $stm1->fetch()['statut'];
    $stm = DB::connect()->prepare('DELETE FROM users WHERE user_id=:val');
    $stm->bindParam(':val', $data);
    if ($stm->execute()) {
      return 'res';
    } else {
      return 'error';
    }
  }

  static public function userConn($data)
  {
    // $stm = DB::connect()->prepare('SELECT * FROM users WHERE username=:username and password_user=:psd');
    $stm = DB::connect()->prepare('SELECT * FROM users WHERE username=:username');
    $stm->bindParam(':username', $data['username']);
    // $stm->bindParam(':psd', $data['user_password']);
    $stm->execute();
    if ($stm->rowCount()) {
      $res = $stm->fetch();
      return $res;
    } else {
      return -1;
    }
  }
  static public function getIdClass($data)
  {
    $stm = DB::connect()->prepare("SELECT class FROM users WHERE user_id=:id");
    $stm->bindParam(':id', $data);
    $stm->execute();
    return $stm->fetch();
  }

  static public function getProfOfModule($data)
  {
    $stm = DB::connect()->prepare("SELECT * FROM users WHERE user_id=:id");
    $stm->bindParam(':id', $data);
    $stm->execute();
    return $stm->fetch();
  }
  static public function isExistedUsername($username)
  {
    $database = DB::connect();
    $statement = $database->prepare("SELECT * FROM users where username = '$username' and user_id !='" . $_SESSION['user_info']['user_id'] . "'");
    $statement->execute();
    return $statement->rowCount() > 0;
  }
  static public function UpdateProfile($username, $email, $password, $files)
  {
    // if username exist already  we can not updated
    if (Etudiant::isExistedUsername($username)) {
      return 'Username exist already please change it ';
    }

    // if image will be updated 
    if (!empty($files["img"]["name"])) {
      $target_dirP = "assets/imgsProfile/";
      $nameImage = basename(rand(0, 100000000000) . "_" . str_replace('\'', '_', $files["img"]["name"]));
      $target_image = $target_dirP . $nameImage;
      $uOk = 1;

      $database = DB::connect();
      $statement = $database->prepare("UPDATE `users` SET `username`='" . $username . "',`email`='" . $email . "',`password_user`='" . $password . "',`img`='" . $nameImage . "' WHERE user_id=" . $_SESSION["user_info"]["user_id"]);
      $statement->execute();


      //#################################"   Upload file  ###############################"
      if (move_uploaded_file($files["img"]["tmp_name"], $target_image) && $statement->rowCount() > 0) {
        $_SESSION["img"] = $nameImage;
        $_SESSION['user_info'] = Etudiant::getDatas();
        return 'Updated with succes';
      } else {
        return 'A probleme was happen';
      }
    }
    // else 
    else {

      $database = DB::connect();
      $statement = $database->prepare("UPDATE `users` SET `username`='" . $username . "',`email`='" . $email . "',`password_user`='" . $password . "' WHERE user_id='" . $_SESSION["user_info"]["user_id"] . "'");
      $statement->execute();
      if ($statement->rowCount() > 0) {

        $_SESSION['user_info'] = Etudiant::getDatas();
        return 'Updated with succes';
      }

      return 'A probleme was happen';
    }
  }
  static public function changeDatasUser($data)
  {
    if (Etudiant::getUser($data['user_id'])['statut'] == '3') {
      $stm = DB::connect()->prepare("UPDATE  `users` SET `username`=:username, `fullname`=:fullname, `email`=:email, `password_user`=:password_user, `class`=:class, `user_adress`=:user_adress, `user_number`=:user_number, `statut`=3 WHERE user_id=:id");
      $stm->bindParam(':username', $data['username']);
      $stm->bindParam(':fullname', $data['fullname']);
      $stm->bindParam(':email', $data['email']);
      $stm->bindParam(':password_user', $data['password']);
      $stm->bindParam(':class', $data['class']);
      $stm->bindParam(':user_adress', $data['adresse']);
      $stm->bindParam(':user_number', $data['phone']);
      $stm->bindParam(':id', $data['user_id']);

      if ($stm->execute()) {
        return 'ok';
      } else {
        return 'error';
      }
    } else if (Etudiant::getUser($data['user_id'])['statut'] == '2') {
      $stm = DB::connect()->prepare("UPDATE  `users` SET `username`=:username, `fullname`=:fullname, `email`=:email, `password_user`=:password_user, `departement`=:departement, `user_adress`=:user_adress, `user_number`=:user_number, `statut`=2 WHERE user_id=:id");
      $stm->bindParam(':username', $data['username']);
      $stm->bindParam(':fullname', $data['fullname']);
      $stm->bindParam(':email', $data['email']);
      $stm->bindParam(':password_user', $data['password']);
      $stm->bindParam(':departement', $data['departement_id']);
      $stm->bindParam(':user_adress', $data['adresse']);
      $stm->bindParam(':user_number', $data['phone']);
      $stm->bindParam(':id', $data['user_id']);

      if ($stm->execute()) {
        return 'ok';
      } else {
        return 'error';
      }
    }
  }
  static public function modifierInfoUser($data)
  {

    if (empty($data['img'])) {
      $stm = DB::connect()->prepare('UPDATE users SET username=:username,fullname=:fullname,email=:email,password_user=:psd 
      WHERE user_id=:id
      ');
    } else {
      $stm = DB::connect()->prepare('UPDATE users SET img=:img,username=:username,fullname=:fullname,email=:email,password_user=:psd 
        WHERE user_id=:id
        ');
      $stm->bindParam(':img', $data['img']);
    }
    $stm->bindParam(':username', $data['username']);
    $stm->bindParam(':fullname', $data['fullname']);
    $stm->bindParam(':email', $data['email']);
    $stm->bindParam(':psd', $data['password_user']);
    $stm->bindParam(':id', $$_SESSION['user_info']['user_id']);
    if ($stm->execute()) {
      return 'ok';
    } else {
      return 'error';
    }
  }
  public static function isStudent($id)
  {
    $stm = DB::connect()->prepare("SELECT * FROM users WHERE user_id=:id and statut =3");
    $stm->bindParam(':id', $id);
    $stm->execute();
    return $stm->rowCount() > 0;
  }
  public static function getDatasOfProfile($id, $statut)
  {
    if ($statut == '3') {
      $stm = DB::connect()->prepare("SELECT users.*,filliere.filliere_name,classes.class_name FROM users,filliere,classes WHERE users.filliere=filliere.filliere_id and users.class=classes.class_id and users.user_id=:id");
    } else {
      $stm = DB::connect()->prepare("SELECT users.*,departement.departement_name FROM users,departement WHERE users.departement=departement.departement_id and users.user_id=:id");
    }
    $stm->bindParam(':id', $id);
    $stm->execute();
    return $stm->fetch();
  }
  static public function getDatas()
  {
    $stm = DB::connect()->prepare("SELECT * FROM users WHERE user_id=:id");
    $stm->bindParam(':id', $_SESSION['user_info']['user_id']);
    $stm->execute();
    return $stm->fetch();
  }
  static public function getAllStudents()
  {
    $stm = DB::connect()->prepare("SELECT users.*,classes.class_name,filliere.filliere_name FROM users,classes,filliere WHERE filliere.filliere_id= users.filliere and classes.class_id = users.class and  statut='3'");
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }
  static public function getLaureats()
  {
    $stm = DB::connect()->prepare("SELECT * FROM users WHERE  statut='4'");
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }
  static public function getAllTeachers()
  {
    $stm = DB::connect()->prepare("SELECT users.*,departement.departement_name FROM users,departement WHERE users.departement = departement.departement_id and  statut='2'");
    $stm->execute();
    $etudiants = $stm->fetchAll();
    return $etudiants;
  }
  static public function ChangePassword($new)
  {
    $stm = DB::connect()->prepare("UPDATE `users` SET `password_user`=:new WHERE `user_id`=:id");
    $stm->bindParam(':new', $new);
    $stm->bindParam(':id', $_SESSION['user_info']['user_id']);
    $stm->execute();
    return $stm->rowCount();
  }
  static public function makeLaureat($id)
  {
    $stm = DB::connect()->prepare("UPDATE `users` SET statut=4 WHERE `user_id`=:id");
    $stm->bindParam(':id', $id);
    $stm->execute();
    return $stm->rowCount();
  }
  static public function nextClass($user, $class)
  {
    $stm = DB::connect()->prepare("UPDATE `users` SET class=:c WHERE `user_id`=:id");
    $stm->bindParam(':id', $user);
    $stm->bindParam(':c', $class);
    $stm->execute();
    return $stm->rowCount();
  }
  static public function nextFillierre($user, $f)
  {
    $stm = DB::connect()->prepare("UPDATE `users` SET filliere=:f WHERE `user_id`=:id");
    $stm->bindParam(':id', $user);
    $stm->bindParam(':f', $f);
    $stm->execute();
    return $stm->rowCount();
  }
  
}
