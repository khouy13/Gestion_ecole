<?php
class EmploiController
{
    public static function InsrtEmpois()
    {
        [$modules, $temps, $jours] = moduleController::ModulesOfProf($_POST['id_prof']);
        foreach ($jours as $jour) {

            // "module$jour['nom_jour']$temp['name_temps']"
            foreach ($temps as $temp) {
                $id_jour = "id_jour" . $jour['nom_jour'] . $temp['name_temps'];
                $id_temps = "id_temps" . $jour['nom_jour'] . $temp['name_temps'];
                $id_module = "module" . $jour['nom_jour'] . $temp['name_temps'];
                $data = [
                    'id_module' => $_POST[$id_module],
                    'id_temps' => $_POST[$id_temps],
                    'id_jour' => $_POST[$id_jour],
                    'id_prof' => $_POST['id_prof']
                ];
                if ($data['id_module'] != 0) {
                    Emploi::InsrtEmpois($data);
                } else {
                    Emploi::delete($data);
                }
            }
        }
        Redirect::to('users');
    }
    public static function aficheEmploi($data)
    {
        $emploi = Emploi::getEmpois($data);
        if ($emploi != 0) {
            $nom_module = Module::getModuleById($emploi['id_module']);
            return $nom_module;
        } else {
            return ' ';
        }
    }
    public static function getSeance($id_prof, $id_module)
    {
        $seances = Emploi::getSeance($id_prof, $id_module);
        $data = [];
        foreach ($seances as $seance) {
            $nom_jour = Semaine::getNomJour($seance['id_jour']);
            $nom_temps = Temps::getNomTemps($seance['id_temps']);
            $seance['name_jour'] = $nom_jour;
            $seance['name_temps'] = $nom_temps;
            $data[] = $seance;
        }
        return $data;
    }

    public static function isExistModuleInthisjourInthisTime($seance, $jour)
    {
        $modules = ModuleController::getModulesOfUser();
        foreach ($modules as $module) {
            $res = Emploi::isExistModuleInthisjourInthisTime($module['module_id'], $seance, $jour);
            if ($res == 1) {
                return $module['module_name'];
            }
        }
        return '';
    }
    public static function getByProf_Jour_Temps($teacher, $jour, $temp)
    {
        $data = ['id_prof' => $teacher, 'id_jour' => $jour, 'id_temps' => $temp];
        $emploi = Emploi::getEmpois($data);
        return $emploi;
    }
}
