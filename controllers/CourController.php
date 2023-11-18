<?php
class CourController
{

    static public function getCourofModule()
    {
        if (isset($_POST['module_id']) && isset($_POST['submit'])) {
            $_SESSION['module_id'] = $_POST['module_id'];
            return Cour::getCourofModule($_SESSION['module_id']);
        } else if (isset($_SESSION['module_id'])) {
            return Cour::getCourofModule($_SESSION['module_id']);
        } else {
            Redirect::to('home');
        }
    }

    static public function ajouterCour()
    {
        if (isset($_POST['name']) && isset($_POST['module']) && isset($_FILES['file']) && isset($_SESSION['prof_id']) && !empty($_FILES['file']['name']) && !empty($_POST['name'])) {

            $name =  $_POST['name'];
            $prof =  $_SESSION['prof_id'];
            $files = $_FILES;
            $module =  $_POST['module'];

            if (ModuleController::isHereModule($_POST['module'])) {
                $res = Cour::ajouterCour($name, $prof, $module, $files);
                if ($res == 'ok') {
                    $module = Module::get($module);
                    $users = Etudiant::getEtudiantsOfClasse($module['class_id']);
                    $content = $_SESSION['user_info']["fullname"] . " a ajouté un cours au module " . $module['module_name'];
                    foreach ($users as $user) {
                        Notification::AddNotification($content, $user['user_id'], $module["module_id"]);
                    }
                    Activity::insert("as ajouté un cour au module " . $module['module_name']);
                    Redirect::withPost('module', $_POST['module'], 'Fichier  téléchargé avec succés');
                }
                Redirect::withPost('module', $_POST['module'], "Il y'a u probleme Essayez de retélécharger votre fichier", false);
            }
        }
        Redirect::withPost('module', $_POST['module'], "Il y'a u probleme Essayez de vérifier les champs du formule", false);
    }
    static public function isHisCour($id)
    {
        $cour =  Cour::getCour($id);
        return $cour['prof_id'] == $_SESSION['user_info']['user_id'];
    }
    static public function suprimerCour()
    {
        if (isset($_POST['cour_id']) && isset($_POST['supprimer']) && CourController::isHisCour($_POST['cour_id'])) {
            $res = Cour::supprimer($_POST['cour_id']);
            if ($res == 'ok') {
                Redirect::withPost('module', $_POST['module'], 'fichier a été supprimer avec succés');
            }
            Redirect::withPost('module', $_POST['module'], 'Il y a une problème Ressayer');
        }
        Redirect::withPost('module', $_POST['module'], 'Il y a une problème Ressayer');
    }
    public static function DesactiveNbrCour()
    {
        if (isset($_POST['module_id']) && isset($_POST['submit'])) {
            Cour::desactiver($_POST['module_id']);
        }
    }
}
