<?php
class Task
{
    static public function getTasksofModule($data)
    {
        $stm = DB::connect()->prepare("SELECT * FROM tasks WHERE module_id=:id and task_annee=:annee ORDER BY `task_date` DESC");
        $stm->bindparam(':id', $data);
        $stm->bindParam(':annee', $_SESSION['annee_universitaire']);
        $stm->execute();
        $tasks = $stm->fetchAll();
        return $tasks;
    }
    static public function ajouter($name, $module)
    {
        $stm = DB::connect()->prepare("INSERT INTO `tasks`(`task_content`, `module_id`,task_annee) VALUES (:names,:module,:a)");
        $stm->bindParam(':names', $name);
        $stm->bindParam(':module', $module);
        $stm->bindParam(':a', $_SESSION['annee_universitaire']);
        if ($stm->execute()) {
            return 'ok';
        } else
            return 'error';
    }
    static public function supprimer($data)
    {
        $stm = DB::connect()->prepare('DELETE FROM tasks WHERE task_id=:id');
        $stm->bindParam(':id', $data);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function getTask($id)
    {
        $stm = DB::connect()->prepare('SELECT * FROM tasks WHERE task_id=:id');
        $stm->bindParam(':id', $id);
        $stm->execute();
        $task = $stm->fetch();
        return $task;
    }
}
