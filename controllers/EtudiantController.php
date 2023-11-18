<?php
class EtudiantController
{

    
    static public function getAllEtudiantDeclass($id = null)
    {
        if (isset($_POST['id']) || $id != null) {
            $areAvaibleNotes = true;
            $module_id =  isset($_POST['id']) ? $_POST['id'] : $id;
            $module = ModuleController::getModuleById($module_id);
            $class_id = $module['class_id'];
            $etudiantes = Etudiant::AllEtudiant($class_id);
            if (isset($_SESSION['prof_id'])) {
                $Etudiantes = [];
                foreach ($etudiantes as $etudaint) {
                    $para = [
                        'student_id' => $etudaint['user_id'],
                        'module_id' => $module_id,
                        'prof_id' => $_SESSION['prof_id']
                    ];
                    $Notes = Note::getNoteOfStudent($para);
                    if (!empty($Notes['note_value'])) {
                        $nt = $Notes['note_value'];
                    } else {
                        $areAvaibleNotes = false;
                        $nt = '';
                    }
                    $data = [
                        'user_id' => $etudaint['user_id'],
                        'fullname' => $etudaint['fullname'],
                        'username' => $etudaint['username'],
                        'img' => $etudaint['img'],
                        'email' => $etudaint['email'],
                        'class_id' => $etudaint['class'],
                        'note' => $nt,
                    ];
                    $Etudiantes[] = $data;
                }
            }
            return [$Etudiantes, $areAvaibleNotes];
        } else {
            Redirect::to('note');
        }
    }
    static public function getAllEtudiant()
    {
        if (isset($_POST['submit']) && isset($_POST['class_id'])) {
            $class_id = $_POST['class_id'];
            return Etudiant::AllEtudiant($class_id);
        } else if (isset($class_id)) {
            return Etudiant::AllEtudiant($class_id);
        } else {
            Redirect::to('home');
        }
    }
    static public function getAllProf()
    {
        if (isset($_POST['departement_id'])) {
            $_SESSION['departement_id'] = $_POST['departement_id'];
            return Etudiant::AllProf($_SESSION['departement_id']);
        } else if (isset($_SESSION['departement_id'])) {
            return Etudiant::AllProf($_SESSION['departement_id']);
        } else {
            Redirect::to('home');
        }
    }
    static public function getAllProfs()
    {
        return Etudiant::getAllTeachers();
    }
    static public function getAllStudents()
    {
        return Etudiant::getAllStudents();
    }
    static public function getLaureats()
    {
        return Etudiant::getLaureats();
    }

    static public function ajouterEtudiant()
    {
        if (isset($_POST['ajouter'])) {
            $data = array(
                'fullname' => $_POST['fullname'],
                'class' => $_POST['classes'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'adresse' => $_POST['adresse'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
            );
            $res = Etudiant::ajouter($data);

            //print_r($_POST);
        }
        Redirect::to('users');
    }

    static public function ajouterProf()
    {
        if (isset($_POST['ajouterprof']) && !empty($_POST['fullname']) && !empty($_POST['departement']) && !empty($_POST['password'])) {
            $data = array(
                'fullname' => $_POST['fullname'],
                'departement_id' => $_POST['departement'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'adresse' => $_POST['adresse'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
            );
            $res = Etudiant::ajouterprof($data);

            if ($res === 'ok') {
                Redirect::to('users');
            }
        }
    }

    static public function deleteEUser()
    {
        if (isset($_POST['user_id'])) {
            $user = Etudiant::getUser($_POST['user_id']);
            $res = Etudiant::delete($_POST['user_id']);
        }
        Redirect::to('users');
    }

    static public function userDconn()
    {
        if (isset($_POST['logout'])) {
            session_start();
            session_unset();
            session_destroy();
            Redirect::to('login');
        }
    }

    static public function userConn()
    {
        if (isset($_POST['submit'])) {
            $data = [
                'username' => $_POST['username'],
                'user_password' => $_POST['password_user']
            ];
            $data_string = implode("-", $data);
            $res = Etudiant::userConn($data);
            if ($res == -1) {
                return ["username", $data];
            } else {
                SettingController::getCurrentSeasonAndSemestre();
                if ($res['password_user'] != $data['user_password']) {
                    return ["password", $data];
                }
                if (isset($_POST['remember'])) {
                    setcookie('dataUser', $data_string, time() + (10 * 365 * 24 * 60 * 60), '/');
                } else {
                    setcookie('dataUser', '', time() - 3600, '/');
                }
                if ($res['statut'] === 1) {
                    $_SESSION['user_info'] = $res;
                    $_SESSION['admin_id'] = $res['user_id'];
                } else if ($res['statut'] === 2) {
                    $_SESSION['user_info'] = $res;
                    $_SESSION['prof_id'] = $res['user_id'];
                } else if ($res['statut'] === 3) {
                    $_SESSION['user_info'] = $res;
                    $_SESSION['etudiant_id'] = $res['user_id'];
                    $_SESSION['class_name'] = Classe::get($res['class'])['class_name'];
                } else if ($res['statut'] === 4) {
                    $_SESSION['laureat'] = $res['user_id'];
                }
                return ["ok", $data];
            }
        }
    }
    public static function modifierInfoUser()
    {
        if (isset($_POST['modifier'])) {
            $password = $_POST['password'];
            $username =  $_POST['username'];
            $email = $_POST['email'];
            $res = Etudiant::UpdateProfile($username, $email, $password, $_FILES);
            Redirect::withPost('editProfile', 0, $res);
        }
    }
    public static function ChangeDatasProfByAdmin()
    {
        if (!empty($_POST['fullname']) && !empty($_POST['classes']) && !empty($_POST['password'])) {
            $data = array(
                'fullname' => $_POST['fullname'],
                'departement_id' => $_POST['classes'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'adresse' => $_POST['adresse'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'user_id' => $_POST["prof_id"]
            );
            Etudiant::changeDatasUser($data);
        }
        Redirect::to('users');
    }
    public static function ChangeDatasStudentByAdmin()
    {
        if (!empty($_POST['fullname']) && !empty($_POST['classes']) && !empty($_POST['password'])) {
            $data = array(
                'fullname' => $_POST['fullname'],
                'class' => $_POST['classes'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'adresse' => $_POST['adresse'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'user_id' => $_POST["user_id"]
            );
            Etudiant::changeDatasUser($data);
            // print_r($_POST);
        }
        Redirect::to('users');
    }


    public static function getStudentsOfClass($id)
    {
        $students = Etudiant::getEtudiantsOfClasse($id);
        return $students;
    }
    public static function getStudentsByModel($id)
    {
        $module = ModuleController::getModuleById($id);
        $students = EtudiantController::getStudentsOfClass($module['class_id']);
        return $students;
    }
    public static function GetAllUsers_admin($id, $departement_id)
    {
        if ($id == 0) {
            $students = Etudiant::getAllStudents();
        } else {
            $students = Etudiant::getEtudiantsOfClasse($id);
        }
        if ($departement_id == 0) {
            $teachers = Etudiant::getAllTeachers();
        } else {
            $teachers = Etudiant::AllProf($departement_id);
        }

        $classes = Classe::getAllClasses();
        return [$students, $teachers, $classes];
    }
    static public function ChangePassword()
    {
        if (isset($_POST["old_password"]) && isset($_POST["password"]) && !empty($_POST["old_password"]) && !empty($_POST["password"])) {
            $old = $_POST["old_password"];
            $new = $_POST["password"];
            $datas = Etudiant::getDatas();
            if ($datas["password_user"] == $old) {
                Etudiant::ChangePassword($new);
            }
        }
        Redirect::to('home');
    }
}
