<?php
class ModuleController
{
    static public function All($semestre = null)
    {
        $modules = Module::all($semestre);
        foreach ($modules as $key => $module) {
            $nbrCours = count(Cour::getCourofModule($module['module_id']));
            $modules[$key]['nbr_cours'] = $nbrCours;
        }
        return $modules;
    }
    static public function getAllByClass($id, $semestre = null)
    {
        if ($semestre == null) {
            $modules = Module::allModules($id);
            foreach ($modules as $key => $module) {
                $nbrCours = count(Cour::getCourofModule($module['module_id']));
                $modules[$key]['nbr_cours'] = $nbrCours;
            }
            return $modules;
        } else {
            $modules = Module::allModulesOfSemestre($id, $semestre);
            foreach ($modules as $key => $module) {
                $nbrCours = count(Cour::getCourofModule($module['module_id']));
                $modules[$key]['nbr_cours'] = $nbrCours;
            }
            return $modules;
        }
    }
    static public function getModuleById($id)
    {
        if (ModuleController::isHereModule($id) || isset($_SESSION['admin_id'])) {
            $module = Module::getModuleOfNote($id);
            return $module;
        } else {
            Redirect::to('home');
        }
    }
    static public function getAllModulle()
    {
        if (isset($_POST['class_id']) && isset($_POST['submit'])) {
            $_SESSION['class_id'] = $_POST['class_id'];
            return Module::allModules($_SESSION['class_id']);
        } else if (isset($_SESSION['class_id'])) {
            return Module::allModules($_SESSION['class_id']);
        } else {
            Redirect::to('home');
        }
    }
    static public function ajouterModule()
    {
        if (!empty($_POST['module_name']) && !empty($_POST['class_id']) && !empty($_POST['prof_id']) && !empty($_POST['semestre'])) {
            $data = array(
                'module_name' => $_POST['module_name'],
                'class_id' => $_POST['class_id'],
                'prof_id' => $_POST['prof_id'],
                'semestre' => $_POST['semestre']
            );
            if (Module::getByName($data['module_name']) == null || Module::getByName($data['module_name'])['class_id'] != $data['class_id']) {
                $coeff = empty($_POST['module_coeff']) ? $_POST['module_coeff'] : 1.0;
                $res = Module::ajouter($data, $coeff);
                Redirect::withPost('modules', $_POST['class_id']);
            } else {
                echo "Ce nom déja exist";
            }
        } else {
            Redirect::withPost('modules', $_POST['class_id']);
        }
    }
    static public function update()
    {
        if (!empty($_POST['module_name']) && !empty($_POST['class_id']) && !empty($_POST['prof_id']) && !empty($_POST['module_id'])  && !empty($_POST['semestre'])) {
            $data = array(
                'module_name' => $_POST['module_name'],
                'class_id' => $_POST['class_id'],
                'prof_id' => $_POST['prof_id'],
                'module_id' => $_POST['module_id'],
                'semestre' => $_POST['semestre']
            );
            if (Module::getByName($data['module_name']) == null || Module::getByName($data['module_name'])['class_id'] != $data['class_id'] || Module::getByName($data['module_name'])['module_id'] == $data['module_id']) {
                $coeff = !empty($_POST['module_coeff']) ? $_POST['module_coeff'] : 1.0;
                echo $coeff;
                $res = Module::update($data, $coeff);
                Redirect::to('modules');
            } else {
                echo "Ce nom déja exist";
            }
        } else {
            Redirect::to('modules');
        }
    }
    static public function deleteModule()
    {
        if (isset($_POST['module_id'])) {
            $module_name = Module::get($_POST['module_id'])['module_name'];
            $res = Module::delete($_POST['module_id']);
        }
        Redirect::to('modules');
    }
    static public function getModulesOfUser($semestre = null)
    {
        if (isset($_SESSION['prof_id'])) {
            $modules = Module::getModuleProf($_SESSION['prof_id'], $semestre);
            return $modules;
        }
        if (isset($_SESSION['etudiant_id'])) {
            $id_class = Etudiant::getIdClass($_SESSION['etudiant_id']);
            $modules = Module::getModuleEtudiant($id_class['class'], $semestre);
            $Modules = [];
            foreach ($modules as $module) {

                $profInfo = Etudiant::getProfOfModule($module['prof_id']);
                $profname = $profInfo['fullname'];
                $profemail = $profInfo['email'];
                $data = [
                    'module_name' => $module['module_name'],
                    'module_id' => $module['module_id'],
                    'prof_name' => $profname,
                    'prof_email' => $profemail,
                ];
                $Modules[] = $data;
            }
            return $Modules;
        }
    }
    static public function getModulesOfUserOfSemestre($s)
    {
        if (isset($_SESSION['prof_id'])) {
            $modules = Module::getModuleProf($_SESSION['prof_id'], $s);
            return $modules;
        }
        if (isset($_SESSION['etudiant_id'])) {
            $id_class = Etudiant::getIdClass($_SESSION['etudiant_id']);
            $modules = Module::getModuleEtudiant($id_class['class'], $s);
            $Modules = [];
            foreach ($modules as $module) {

                $profInfo = Etudiant::getProfOfModule($module['prof_id']);
                $profname = $profInfo['fullname'];
                $profemail = $profInfo['email'];
                $data = [
                    'module_name' => $module['module_name'],
                    'module_id' => $module['module_id'],
                    'prof_name' => $profname,
                    'prof_email' => $profemail,
                ];
                $Modules[] = $data;
            }
            return $Modules;
        }
    }
    static public function getAllModules_S1_S2()
    {
        if (isset($_SESSION['prof_id'])) {
            $modules = Module::getAllModules_S1_S2Prof($_SESSION['prof_id']);
            return $modules;
        }
        if (isset($_SESSION['etudiant_id'])) {
            $id_class = Etudiant::getIdClass($_SESSION['etudiant_id']);
            $modules = Module::getAllModules_S1_S2Etudiant($id_class['class']);
            $Modules = [];
            foreach ($modules as $module) {

                $profInfo = Etudiant::getProfOfModule($module['prof_id']);
                $profname = $profInfo['fullname'];
                $profemail = $profInfo['email'];
                $data = [
                    'module_name' => $module['module_name'],
                    'module_id' => $module['module_id'],
                    'prof_name' => $profname,
                    'prof_email' => $profemail,
                ];
                $Modules[] = $data;
            }
            return $Modules;
        }
    }
    static public function isHereModule($id)
    {
        if (isset($_SESSION['admin_id'])) {
            return true;
        }
        $modules = ModuleController::getAllModules_S1_S2();
        $Check = false;
        foreach ($modules as $module) {
            if ($id == $module['module_id']) {
                $Check = true;
            }
        }
        return $Check;
    }
    static public function getModule($id)
    {
        if (ModuleController::isHereModule($id)) {
            Notification::makeNotificationsSeen($_SESSION['user_info']['user_id'], $id);
            $_SESSION['notifications_nbr'] = Notification::getNumberNotificationsNonSeen();
            $_SESSION['notifications'] = Notification::getNotificationsNonSeen($_SESSION['user_info']['user_id']);
            $module = Module::getModuleOfNote($id);
            $cours = Cour::getCourofModule($id);
            $tasks = Task::getTasksofModule($id);
            return [$module, $cours, $tasks];
        } else {
            Redirect::to('home');
        }
    }
    public static function ModulesOfProf($id_prof)
    {
        $modules = Module::getModuleProf($id_prof);
        $temps = Temps::getTemps();
        $semaine = Semaine::getSemaine();
        return [$modules, $temps, $semaine];
    }
}
