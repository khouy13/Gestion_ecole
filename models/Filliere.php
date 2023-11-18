<?php
class Filliere
{
    static public function get($id)
    {
        $stm = DB::connect()->prepare('SELECT * FROM filliere WHERE filliere_id = :id');
        $stm->bindParam(':id', $id);
        $stm->execute();
        $filliere = $stm->fetch();
        return $filliere;
    }
    static public function AllFilliere($data)
    {
        $stm = DB::connect()->prepare('SELECT * FROM filliere WHERE departement_id=:id');
        $stm->bindParam(':id', $data);
        $stm->execute();
        $fillieres = $stm->fetchAll();
        return $fillieres;
    }
    static public function ajouter($data)
    {
        $stm = DB::connect()->prepare('INSERT INTO filliere (filliere_name,departement_id) values(:val,:depart)');
        $stm->bindParam(':val', $data['filliere_name']);
        $stm->bindParam(':depart', $data['departement_id']);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function delete($data)
    {
        $stm = DB::connect()->prepare('DELETE FROM filliere WHERE filliere_id=:val');
        $stm->bindParam(':val', $data);
        if ($stm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    static public function All()
    {
        $stm = DB::connect()->prepare('SELECT * FROM filliere');
        $stm->execute();
        $fillieres = $stm->fetchAll();
        return $fillieres;
    }
    static public function AllIng()
    {
        $stm = DB::connect()->prepare('SELECT * FROM filliere WHERE niveau=1');
        $stm->execute();
        $fillieres = $stm->fetchAll();
        return $fillieres;
    }
    static public function getByName($name)
    {
        $stm = DB::connect()->prepare('SELECT * FROM filliere where filliere_name =:f_name');
        $stm->bindParam(':f_name', $name);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            return null;
        }
        return $stm->fetch();
    }
    static public function update($data)
    {
        $stm = DB::connect()->prepare('UPDATE `filliere` SET `filliere_name`=:f_name,`departement_id`=:d_id WHERE `filliere_id`=:id');
        $stm->bindParam(':f_name', $data['filliere_name']);
        $stm->bindParam(':d_id', $data['departement_id']);
        $stm->bindParam(':id', $data['filliere_id']);
        $stm->execute();
        return $stm->rowCount();
    }
}
