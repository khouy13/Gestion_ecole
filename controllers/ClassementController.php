<?php
class ClassementController
{
    static public function getClassementOfUser($id)
    {
        return ClassementFilliere::get($id);
    }
    static public function enregistrer()
    {
        $class = ClassController::get($_SESSION['user_info']['class']);
        $class1 = ClassController::getClassByFilliereAndNiveau($class['filliere_id'], 2);
        if (!isset($_SESSION['etudiant_id']) || $class['class_id'] != $class1['class_id']) {
            Redirect::to('home');
        }
        $classement = ClassementController::getClassementOfUser($_SESSION['etudiant_id']);

        $isDistinct = count($_POST) === count(array_unique($_POST));
        if ($isDistinct == false) {
            Redirect::withPost('choixFillieres', 0, "Les choix doivent etre distincts");
        }

        $s = '';
        foreach ($_POST as $key => $choix) {
            if ($key == 'filliere0') {
                $s = $s . $choix;
            } else {
                $s = $s . "," . $choix;
            }
        }
        if ($classement == null) {
            $res = ClassementFilliere::insert($_SESSION['user_info']['user_id'], $s, $_SESSION['annee_universitaire']);
            if ($res) {
                Redirect::withPost('choixFillieres', 1, "Vos choix ont été enregistrés");
            } else {
                Redirect::withPost('choixFillieres', 0, "Les choix doivent etre distincts");
            }
        } else {
            $res = ClassementFilliere::update($_SESSION['user_info']['user_id'], $s, $_SESSION['annee_universitaire'], $classement['classement_id']);
            Redirect::withPost('choixFillieres', 1, "Vos choix ont été enregistrés");
        }
    }
    static public function affecterFillieres()
    {
        $class = Classe::get2Class();
        $sizes = Classe::getSizeOfClass3();
        $sizesFillieres = array_fill(0, 20, 0);
        foreach ($sizes as $size) {
            $sizesFillieres[$size['filliere_id']] = $size['size'];
        }
        $fillieres = FilliereController::getAllFillieresIng();
        [$students, $allNotesAreEntred] = NoteController::getAllNotesOfClass($class['class_id']);
        usort($students, function ($a, $b) {
            return $b['moyenne'] <=> $a['moyenne'];
        });
        foreach ($students as $student) {
            $classement = ClassementFilliere::get($student['user_id']);
            $classement = explode(',', $classement['classement_value']);
            foreach ($classement as $choix) {
                if ($sizesFillieres[$choix] > 0) {
                    $nextClass = ClassController::getClassByFilliereAndNiveau($choix, 3);
                    Etudiant::nextClass($student['user_id'], $nextClass['class_id']);
                     Etudiant::nextFillierre($student['user_id'], $choix);
                    $sizesFillieres[$choix] = $sizesFillieres[$choix] - 1;
                    break;
                }
            }
        }
    }
}
