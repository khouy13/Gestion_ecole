<?php
class FilliereController
{
    static public function getAllFillere()
    {
        if (isset($_POST['departement_id']) && isset($_POST['submit'])) {
            $data = $_POST['departement_id'];
            $_SESSION['departement_id'] = $data;
            return  Filliere::AllFilliere($_SESSION['departement_id']);
        } else if (isset($_SESSION['departement_id'])) {
            return Filliere::AllFilliere($_SESSION['departement_id']);
        } else {
            Redirect::to('home');
        }
    }
    static public function ajouterFilliere()
    {
        if (!empty($_POST['filliere_name']) && !empty($_POST['departement_id'])) {
            $data = array(
                'filliere_name' => $_POST['filliere_name'],
                'departement_id' => $_POST['departement_id']
            );
            if (Filliere::getByName($data['filliere_name']) == null) {
                $res = Filliere::ajouter($data);

                Redirect::withPost('departements', $_POST['key']);
            } else {
                echo "Ce nom deja exist";
            }
        } else {
            Redirect::withPost('departements', $_POST['key']);
        }
    }
    static public function deletefilliere()
    {
        if (isset($_POST['filliere_id'])) {
            $filliere_name = Filliere::get($_POST['filliere_id'])['filliere_name'];
            $res = Filliere::delete($_POST['filliere_id']);
        }
        Redirect::withPost('departements', $_POST['key']);
    }
    static public function getAllFilleresOfDepartements()
    {
        $departements = DepartementController::getAllDepartement();
        $fillieres = [];
        foreach ($departements as $value) {
            $filliere = Filliere::AllFilliere($value['departement_id']);
            foreach ($filliere as $key => $cc) {
                $nbrclass = count(Classe::Allclass($filliere[$key]['filliere_id']));
                $filliere[$key]['nbr_classes'] = $nbrclass;
            }


            $fillieres[] = $filliere;
        }
        return $fillieres;
    }
    static public function getAllFillieres()
    {
        return Filliere::All();
    }
    static public function getAllFillieresIng()
    {
        return Filliere::AllIng();
    }
    static public function update()
    {
        if (!empty($_POST['filliere_name']) && !empty($_POST['departement_id']) && !empty($_POST['filliere_id'])) {
            $data = array(
                'filliere_name' => $_POST['filliere_name'],
                'departement_id' => $_POST['departement_id'],
                'filliere_id' => $_POST['filliere_id']
            );
            if (Filliere::getByName($data['filliere_name']) == null || (Filliere::getByName($data['filliere_name'])['filliere_id'] == $data['filliere_id'])) {
                $res = Filliere::update($data);
                Redirect::withPost('departements', $_POST['key']);
            } else {
                echo "Ce nom deja exist";
            }
        } else {
            Redirect::withPost('departements', $_POST['key']);
        }
    }
}
