<?php
class AbsenceController
{
    static public function getAbsencesOfModule($month,$id)
    {
        if (!ModuleController::isHereModule($id)) {
            Redirect::to('absence');
        }
        $students = EtudiantController::getStudentsByModel($_POST['id']);
        $datas = [];
        $data=[];
        foreach($students as $student){
              $data['info_user']=$student;
              $absence=Absence::get_module_month_user($_POST['id'], $month, $student['user_id']);
              $data['absence']=$absence;
              $datas[]=$data;
        }
        return $datas;
    }


    static public function AddAbsence()
    {
        if (!isset($_POST['month']) || !isset($_POST['year']) || !isset($_POST['module']) || !isset($_POST['abs']) ) {
            Redirect::to("absence");
        }
        $month = $_POST['month'];
        $year = $_POST['year'];
        $module = $_POST['module'];
        Absence::delete_month_module($month, $module);
        $absences = $_POST['abs'];
        foreach ($absences as $absence) {
            $parts = explode("-", $absence);
            $day = $parts[0];
            $seance = $parts[1];
            $user = $parts[2];
            $date = $year . '-' . $month . '-' . $day;
            Absence::insert($user, $seance, $date, $module);
        }
        Redirect::withPost('absence', $module, $month);
    }
    static public function getAll()
    {
        $users = Absence::getAllSchool();
        return $users;
    }
    static public function getAllOfClass($id)
    {
        $users = Absence::getAllOfClass($id);
        return $users;
    }
}
