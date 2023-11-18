<?php
class ServiceController
{
    static public function addService()
    {
        if (isset($_POST['message'])) {
            Contact::AddMessage($_POST['message']);
            Redirect::withPost('contact', 0, 'contact');
        } else {
            if (isset($_POST['type'])) {
                $type = $_POST['type'];
                $statut = $_SESSION['user_info']['statut'] == '2' ? "L'enseignant" : "L'étudiant";
                if ($_SESSION['user_info']['statut'] == '3') {
                    switch ($type) {
                        case '1':
                            $typeService = "Attestation scolaire";
                            break;
                        case '2':
                            $typeService = "Relvé de note";
                            break;
                        case '3':
                            $typeService = "Attestation de stage";
                            break;
                        case '4':
                            $typeService = "Changement de filière";
                            break;
                        case '5':
                            $typeService = "Demande de Transfert";
                            break;
                        default:
                            Redirect::withPost('contact', 0, 'service');
                    }
                } else {
                    switch ($type) {
                        case '1':
                            $typeService = "Attestation de service";
                            break;
                        case '2':
                            $typeService = "Congés et autorisations d'absence";
                            break;
                        case '3':
                            $typeService = "Autorisations de recherche ou de publication";
                            break;
                        case '4':
                            $typeService = "Demandes de rattrapage des séances";
                            break;
                        default:
                            Redirect::withPost('contact', 0, 'service');
                    }
                }
                $response = Services::ajouter($typeService, $_SESSION['user_info']['user_id']);
                if (!$response) {
                    Redirect::withPost('contact', 0, 'service', false);
                } else {
                    if ($statut == "L'enseignant") {
                        Activity::insert(" a demandé " . $typeService);
                    }
                }
            }
            Redirect::withPost('contact', 0, 'service', true);
        }
    }
    static public function getAllServices()
    {
        $demandes = Services::getAllNonTraités();
        return $demandes;
    }

    static public function getServices()
    {
        [$servicesStudents, $servicesProfs] = Services::getAll();
        return [$servicesStudents, $servicesProfs];
    }
    static public function getDemandes()
    {
        return Services::getDemandes($_SESSION['user_info']['user_id']);
    }
    static public function TraiterDemnade()
    {
        if (isset($_POST['service_id'])) {
            $id = $_POST['service_id'];
            Services::Traiter($id);
            Redirect::to('services');
        }
    }
    static public function SupprimerDemande()
    {
        if (isset($_POST['service_id'])) {
            $id = $_POST['service_id'];
            Services::Supprimer($id);
            Redirect::to('services');
        }
    }
}
