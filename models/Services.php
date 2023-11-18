<?php
class Services
{
    static public function getAllNonTraités()
    {
        $stm = DB::connect()->prepare("SELECT services.*,users.* FROM services,users WHERE services.service_user=users.user_id and  services.service_statut=0 ORDER BY services.service_date DESC");

        $stm->execute();
        $services = $stm->fetchAll();
        return $services;
    }
    static public function getAll()
    {
        $stm = DB::connect()->prepare("SELECT services.*,users.* FROM services,users WHERE services.service_user=users.user_id and users.statut = 3 ORDER BY services.service_statut, services.service_date DESC");

        $stm->execute();
        $servicesStudents = $stm->fetchAll();
        $stm = DB::connect()->prepare("SELECT services.*,users.* FROM services,users WHERE services.service_user=users.user_id and users.statut = 2 ORDER BY services.service_statut, services.service_date DESC");

        $stm->execute();
        $servicesProfs = $stm->fetchAll();
        return [$servicesStudents, $servicesProfs];
    }
    static public function ajouter($service_type, $user)
    {
        if (Services::get($user, $service_type) == 0) {
            $stm = DB::connect()->prepare("INSERT INTO `services`(`service_user`, `service_type`) VALUES (:usr,:srvc)");
            $stm->bindParam(':usr', $user);
            $stm->bindParam(':srvc', $service_type);
            if ($stm->execute()) {
                return true;
            }
        } else
            return false;
    }
    static public function supprimer($data)
    {
        $stm = DB::connect()->prepare('DELETE FROM services WHERE service_id=:id');
        $stm->bindParam(':id', $data);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    static public function getDemandes($id)
    {
        $stm = DB::connect()->prepare('SELECT services.*,users.* FROM services,users WHERE services.service_user=users.user_id and service_user=:id ORDER BY services.service_date DESC');
        $stm->bindParam(':id', $id);
        $stm->execute();
        $demandes = $stm->fetchAll();
        return $demandes;
    }
    static public function Traiter($id)
    {
        $stm = DB::connect()->prepare("UPDATE `services` SET`service_statut`='1' WHERE service_id=:id");
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->rowCount();
    }
    static public function get($usr, $service)
    {
        $stm = DB::connect()->prepare("SELECT * FROM services WHERE service_statut = 0 and service_user = :usr and service_type = :types");
        $stm->bindParam(':usr', $_SESSION['user_info']['user_id']);
        $stm->bindParam(':types', $service);
        $stm->execute();
        return $stm->rowCount();
    }
}
