<?php
class NoteController
{
    static public function getAllNotesOfClass($id)
    {
        if (isset($_SESSION['admin_id'])) {

            $modules = (isset($_POST['semestre'])) ? ModuleController::getAllByClass($id, $_POST['semestre']) : ModuleController::getAllByClass($id);
            $students = Etudiant::getEtudiantsOfClasse($id);
            $Notes = [];
            $allNotesAreEntred = true;
            foreach ($students as $student) {
                $note = [];
                $note['student'] = $student['fullname'];
                $note['user_id'] = $student['user_id'];
                $MoyenneIsExisted = true;
                $sum1 = 0.0;
                $sumCoeff1 = 0.0;
                $sum2 = 0.0;
                $sumCoeff2 = 0.0;
                $notes_values = [];
                foreach ($modules as  $module) {
                    $el = Note::getNoteOfStudent(['student_id' => $student['user_id'], 'module_id' => $module['module_id']]);
                    if ($el == null) {
                        $MoyenneIsExisted = false;
                        $allNotesAreEntred = false;
                    } else {
                        if ($module['semestre'] == 1) {
                            $sum1 += ((float)$el['note_value'] * $module['module_coeff']);
                            $sumCoeff1 += $module['module_coeff'];
                        } else {
                            $sum2 += ((float)$el['note_value'] * $module['module_coeff']);
                            $sumCoeff2 += $module['module_coeff'];
                        }
                    }
                    $notes_values[] = $el;
                }
                $note['modules'] = $notes_values;
                if ($MoyenneIsExisted && ($sumCoeff1 != 0 || $sumCoeff2 != 0)) {
                    if ($sumCoeff1 == 0) {
                        $note['moyenne'] = ($_POST['semestre'] != 2) ? (($sum2 / $sumCoeff2) / 2) : (($sum2 / $sumCoeff2));
                    } else if ($sumCoeff2 == 0) {
                        $note['moyenne'] = ($_POST['semestre'] != 1) ? (($sum1 / $sumCoeff1) / 2) : (($sum1 / $sumCoeff1));
                    } else {
                        $note['moyenne'] = (($sum1 / $sumCoeff1) + ($sum2 / $sumCoeff2)) / 2;
                    }
                } else {
                    $note['moyenne'] = '';
                }
                $Notes[] = $note;
            }
            return [$Notes, $allNotesAreEntred];
        } else {
            Redirect::to('home');
            // var_dump($_SESSION);
        }
    }
    static public function getAllNotesOfClassOfSemestre($id, $semestre)
    {
        if (isset($_SESSION['admin_id'])) {

            $modules = ModuleController::getAllByClass($id, $semestre);
            $students = Etudiant::getEtudiantsOfClasse($id);
            $Notes = [];
            $allNotesAreEntred = true;
            foreach ($students as $student) {
                $note = [];
                $note['student'] = $student['fullname'];
                $note['user_id'] = $student['user_id'];
                $MoyenneIsExisted = true;
                $sum1 = 0.0;
                $sumCoeff1 = 0.0;
                $notes_values = [];
                foreach ($modules as  $module) {
                    $el = Note::getNoteOfStudent(['student_id' => $student['user_id'], 'module_id' => $module['module_id']]);
                    if ($el == null) {
                        $MoyenneIsExisted = false;
                        $allNotesAreEntred = false;
                    } else {
                        $sum1 += ((float)$el['note_value'] * $module['module_coeff']);
                        $sumCoeff1 += $module['module_coeff'];
                    }
                    $notes_values[] = $el;
                }
                $note['modules'] = $notes_values;
                if ($MoyenneIsExisted && ($sumCoeff1 != 0)) {
                    $note['moyenne'] = ($sum1 / $sumCoeff1);
                } else {
                    $note['moyenne'] = '';
                }
                $Notes[] = $note;
            }
            return [$Notes, $allNotesAreEntred];
        } else {
            Redirect::to('home');
        }
    }
    static public function getNotesFinaleLastYear($id)
    {
        if (isset($_SESSION['admin_id'])) {
            $class = ClassController::get($id);
            if ($class['niveau'] != 5) {
                Redirect::withPost('nextAnnee', $id);
            }
            $class1 = ClassController::getClassByFilliereAndNiveau($class['filliere_id'], 3);
            $class2 = ClassController::getClassByFilliereAndNiveau($class['filliere_id'], 4);
            $modules = ModuleController::getAllByClass($id);
            $students = Etudiant::getEtudiantsOfClasse($id);
            $Notes = [];
            $allNotesAreEntred = true;
            foreach ($students as $student) {
                $note = [];
                $note['student'] = $student['fullname'];
                $note['user_id'] = $student['user_id'];
                $MoyenneIsExisted = true;
                $sum1 = 0.0;
                $sumCoeff1 = 0.0;
                $sum2 = 0.0;
                $sumCoeff2 = 0.0;
                $notes_values = [];
                foreach ($modules as  $module) {
                    $el = Note::getNoteOfStudent(['student_id' => $student['user_id'], 'module_id' => $module['module_id']]);
                    if ($el == null) {
                        $MoyenneIsExisted = false;
                        $allNotesAreEntred = false;
                    } else {
                        if ($module['semestre'] == 1) {
                            $sum1 += ((float)$el['note_value'] * $module['module_coeff']);
                            $sumCoeff1 += $module['module_coeff'];
                        } else {
                            $sum2 += ((float)$el['note_value'] * $module['module_coeff']);
                            $sumCoeff2 += $module['module_coeff'];
                        }
                    }
                    $notes_values[] = $el;
                }
                $note['modules'] = $notes_values;
                if ($MoyenneIsExisted && ($sumCoeff1 != 0 || $sumCoeff2 != 0)) {
                    if ($sumCoeff1 == 0) {
                        $moyenneLastYear = ($_POST['semestre'] != 2) ? (($sum2 / $sumCoeff2) / 2) : (($sum2 / $sumCoeff2));
                    } else if ($sumCoeff2 == 0) {
                        $moyenneLastYear = ($_POST['semestre'] != 1) ? (($sum1 / $sumCoeff1) / 2) : (($sum1 / $sumCoeff1));
                    } else {
                        $moyenneLastYear = (($sum1 / $sumCoeff1) + ($sum2 / $sumCoeff2)) / 2;
                    }
                    [$note3, $note4] = NoteHistory::getLast2Years($student['user_id'], $class1['class_id'], $class2['class_id']);
                    $note['moyenne'] = ($moyenneLastYear * .5) + ($note3 * .15) + ($note4 * .35);
                } else {
                    $note['moyenne'] = '';
                }
                $Notes[] = $note;
            }
            return $Notes;
        } else {
            Redirect::to('home');
            // var_dump($_SESSION);
        }
    }
    static public function getAllNotes($semestre)
    {
        if (isset($_SESSION['etudiant_id'])) {
            $modules = Module::getModuleEtudiant($_SESSION['user_info']['class'], $semestre);
            $notes = Note::getAllNote($_SESSION['etudiant_id']);
            $seuil = Note::getSeuil($_SESSION['user_info']['class'])['seuil'];
            $Notes = [];
            $moyenne = 0;
            $sumCoeff = 0.0;
            $isValid = true;
            foreach ($modules as $module) {
                $note = Note::getNoteOfStudent(["student_id" => $_SESSION['etudiant_id'], "module_id" => $module["module_id"]]);
                $data = [
                    'note_value' => $note ? $note['note_value'] : null,
                    'module_name' => $module['module_name'],
                ];
                if ($note == null) {
                    $isValid = false;
                } else {
                    $moyenne += ($note['note_value'] * $module['module_coeff']);
                    $sumCoeff += $module['module_coeff'];
                }
                $Notes[] = $data;
            }
            if ($isValid && $sumCoeff != 0) {
                return [$Notes, $seuil, $moyenne / $sumCoeff];
            }
            return [$Notes, $seuil, null];
        } else
            Redirect::to('home');
    }
    static public function getNotesOfClass($module_id)
    {
        if (ModuleController::isHereModule($module_id)) {
            $module = ModuleController::getModule($module_id);
            $students = EtudiantController::getStudentsOfClass($module['class_id']);
            return $students;
        } else {
            Redirect::to('note');
        }
    }
    static public function enregistrerNote()
    {
        if (isset($_POST['ajouter']) && isset($_POST['student_id']) && isset($_POST['note']) && isset($_POST['module']) && isset($_SESSION['prof_id'])) {
            $note = $_POST['note'];
            $student_id = $_POST['student_id'];
            $module_id = $_POST['module'];
            $module = Module::getModuleOfNote($module_id);

            if (ModuleController::isHereModule($module_id) && Etudiant::getUser($student_id)['class'] == $module['class_id'] && $note >= '0' && $note <= '20') {
                $res = Note::ajouter($note, $student_id, $module_id);
                [$st, $isAvaible] = EtudiantController::getAllEtudiantDeclass($module_id);
                if ($isAvaible) {
                    Activity::insert(" a ajouté les notes du module " . $module['module_name'] . " du class " . $module['class_name']);
                }
            }
            Redirect::withPost('noteModule', $module_id, "Note enregistré avec succé");
        }
        Redirect::withPost('noteModule', $module_id, "Vérifier les champs du formule");
    }
    static public function saveAll()
    {
        if (!isset($_SESSION['prof_id'])) {
            Redirect::to('home');
        }
        $module_id = $_POST['module'];
        $module = Module::getModuleOfNote($module_id);
        foreach ($_POST['note'] as $key => $note) {
            $student_id = $_POST['student_id'][$key];
            if (ModuleController::isHereModule($module_id) && Etudiant::getUser($student_id)['class'] == $module['class_id']) {
                if ($note == null) {
                    Note::deleteByModuleAndUser($module_id, $student_id);
                } else if ($note >= 0 && $note <= 20) {
                    $res = Note::ajouter($note, $student_id, $module_id);
                    [$st, $isAvaible] = EtudiantController::getAllEtudiantDeclass($module_id);
                    if ($isAvaible) {
                        Activity::insert(" a ajouté les notes du module " . $module['module_name'] . " du class " . $module['class_name']);
                    }
                }
            }
        }
        Redirect::withPost('noteModule', $module_id);



        if (ModuleController::isHereModule($module_id) && Etudiant::getUser($student_id)['class'] == $module['class_id'] && $note >= '0' && $note <= '20') {
            $res = Note::ajouter($note, $student_id, $module_id);
            [$st, $isAvaible] = EtudiantController::getAllEtudiantDeclass($module_id);
            if ($isAvaible) {
                Activity::insert(" a ajouté les notes du module " . $module['module_name'] . " du class " . $module['class_name']);
            }
        }
    }
    static public function suprimerNote()
    {
        if (isset($_POST['suprimer']) && isset($_POST['student_id'])  && isset($_POST['module']) && isset($_SESSION['prof_id'])) {

            $student_id = $_POST['student_id'];
            $module_id = $_POST['module'];
            $module = Module::getModuleOfNote($module_id);
            if (ModuleController::isHereModule($module_id) && Etudiant::getUser($student_id)['class'] == $module['class_id']) {
                $res = Note::suprimer($student_id, $module_id);
            }
            Redirect::withPost('noteModule', $module_id, "note supprimé avec succé");
        }
        Redirect::withPost('noteModule', $module_id, "Vérifier les champs du formule");
    }
}
