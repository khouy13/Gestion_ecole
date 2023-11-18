<?php
class NextYearController
{
    static public function CheckNotesForLY()
    {
        if (!isset($_SESSION['admin_id'])) {
            Redirect::to('home');
        }
        $classes = ClassController::getClassesLastYear();
        $result = [];
        foreach ($classes as $class) {
            $students = Etudiant::getEtudiantsOfClasse($class['class_id']);
            $Anne3 = true;
            $Anne4 = true;
            $class1 = ClassController::getClassByFilliereAndNiveau($class['filliere_id'], 3);
            $class2 = ClassController::getClassByFilliereAndNiveau($class['filliere_id'], 4);
            foreach ($students as $key => $student) {
                [$note3, $note4] = NoteHistory::getLast2Years($student['user_id'], $class1['class_id'], $class2['class_id']);
                if ($note3 == -1) {
                    $Anne3 = false;
                }
                if ($note3 == -1) {
                    $Anne4 = false;
                }
            }
            [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($class['class_id']);
            $res = [];
            if (!$Anne3) {
                $res['err1'] = "Des étudiants de class " . $class['class_name'] . " n'ont pas des notes de 3ème année";
            }
            if (!$Anne4) {
                $res['err2'] = "Des étudiants de class " . $class['class_name'] . " n'ont pas des notes de 4ème année";
            }
            if (!$allNotesAreEntred) {
                $res['err3'] = "Des étudiants de class " . $class['class_name'] . " n'ont pas des notes de 5ème année";
            }
            if (!empty($res)) {
                $result[] = $res;
            }
        }
        return $result;
    }
    static public function CheckNotesForOthersClasses()
    {
        if (!isset($_SESSION['admin_id'])) {
            Redirect::to('home');
        }
        $classes = ClassController::getAllClassessSaufLY();
        $result = [];
        foreach ($classes as $class) {
            [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($class['class_id']);
            if (!$allNotesAreEntred) {
                $result[] = "Les notes des étudiants du " . $class['class_name'] . " ne sont pas complètes ";
            }
        }
        return $result;
    }
    static public function CheckNotesForSemestre($semestre)
    {
        if (!isset($_SESSION['admin_id'])) {
            Redirect::to('home');
        }
        $classes = ClassController::getAllClassess();
        $result = [];
        foreach ($classes as $class) {
            [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClassOfSemestre($class['class_id'], $semestre);
            if (!$allNotesAreEntred) {
                $result[] = "Les notes des étudiants du " . $class['class_name'] . " ne sont pas complètes ";
            }
        }
        return $result;
    }
    static public function NextYear()
    {
        if (!isset($_SESSION['admin_id'])) {
            Redirect::to('home');
        }
        $result1 = NextYearController::CheckNotesForLY();
        $CheckNotesOfLY = !empty($result1);
        $result2 = NextYearController::CheckNotesForOthersClasses();
        $CheckNotesOfOthers = !empty($result2);
        if ($CheckNotesOfLY || $CheckNotesOfOthers) {
            Redirect::to('home');
        }
        ### Save Notes history

        $classesLastYear = ClassController::getClassesLastYear();
        $classes = ClassController::getAllClassess();
        $classesSaufLastYear = ClassController::getAllClassessSaufLY();

        // Save notes  and update class for last year
        foreach ($classesLastYear as $class1) {
            $NotesFinals = NoteController::getNotesFinaleLastYear($class1['class_id']);
            usort($NotesFinals, function ($a, $b) {
                return $b['moyenne'] <=> $a['moyenne'];
            });
            foreach ($NotesFinals as $note) {
                NoteHistory::insert($note['user_id'], $note['moyenne'], $class1['class_id']);
                if ($note['moyenne'] >= $class1['seuil']) {
                    $res = Laureat::insert($note['user_id'], $class1['filliere_id'], $note['moyenne']);

                    Etudiant::makeLaureat($note['user_id']);
                } else {
                    $res = Ajourne::insert($note['user_id'], $class1['class_id'], $_SESSION['annee_universitaire']);
                }
            }
        }
        // Save for other classes
        foreach ($classesSaufLastYear as $class2) {
            [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($class2['class_id']);
            usort($notes, function ($a, $b) {
                return $b['moyenne'] <=> $a['moyenne'];
            });
            foreach ($notes as $note) {
                NoteHistory::insert($note['user_id'], $note['moyenne'], $class2['class_id']);
            }
        }

        ### Change Class For chaque student Sauf Last Year and CP2 and CP1
        foreach ($classesSaufLastYear as $class2) {
            if ($class2['niveau'] == 2 || $class2['niveau'] == 1) {
                continue;
            }
            $nextClass = ClassController::getClassByFilliereAndNiveau($class2["filliere_id"], $class2['niveau'] + 1);
            [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($class2['class_id']);
            usort($notes, function ($a, $b) {
                return $b['moyenne'] <=> $a['moyenne'];
            });
            foreach ($notes as $note) {
                if ($note['moyenne'] >= $class2['seuil']) {
                    Etudiant::nextClass($note['user_id'], $nextClass['class_id']);
                } else {
                    $res = Ajourne::insert($note['user_id'], $class2['class_id'], $_SESSION['annee_universitaire']);
                }
            }
        }

        ### Classement CP2 and affecter filliere mov chaque user to class

        ClassementController::affecterFillieres();

        ### mov CP1 to CP2
        foreach ($classesSaufLastYear as $class2) {
            if ($class2['niveau'] == 1) {
                $nextClass = ClassController::getClassByFilliereAndNiveau($class2["filliere_id"], $class2['niveau'] + 1);
                [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($class2['class_id']);
                usort($notes, function ($a, $b) {
                    return $b['moyenne'] <=> $a['moyenne'];
                });
                foreach ($notes as $note) {
                    if ($note['moyenne'] >= $class2['seuil']) {
                        Etudiant::nextClass($note['user_id'], $nextClass['class_id']);
                    } else {
                        $res = Ajourne::insert($note['user_id'], $class2['class_id'], $_SESSION['annee_universitaire']);
                    }
                }
            }
        }
        ### CP1 li ghaydkhlo

        ### change annee universitaire et semestre
        Setting::changeAnne();
    }
}
