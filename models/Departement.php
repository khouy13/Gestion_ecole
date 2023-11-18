<?php
class Departement
{
    static public function AllDepartement()
    {
        $stm = DB::connect()->prepare('SELECT * FROM departement');
        $stm->execute();
        $employes = $stm->fetchAll();
        return $employes;
    }
    static public function ajouter($data)
    {
        $stm = DB::connect()->prepare('INSERT INTO departement (departement_name) values(:val)');
        $stm->bindParam(':val', $data);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function delete($data)
    {
        $stm = DB::connect()->prepare('DELETE FROM departement WHERE departement_id=:val');
        $stm->bindParam(':val', $data);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function get($id)
    {
        $stm = DB::connect()->prepare("SELECT * FROM departement WHERE departement_id = '$id'");
        $stm->execute();
        $departement = $stm->fetch();
        return $departement;
    }
    static public function getByName($name)
    {
        $stm = DB::connect()->prepare("SELECT * FROM departement WHERE departement_name =:nam");
        $stm->bindParam(':nam', $name);
        $stm->execute();
        return $stm->rowCount();
    }
    static public function update($name, $id)
    {
        $stm = DB::connect()->prepare("UPDATE departement SET departement_name = :d_name  WHERE departement_id =:id");
        $stm->bindParam(':d_name', $name);
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->rowCount();
    }
}
