<?php
class DepartementController
{
    static public function getAllDepartement()
    {
        return departement::AllDepartement();
    }
    static public function ajouterDepartement()
    {
        if (!empty($_POST['departement_name'])) {
            if (Departement::getByName($_POST['departement_name']) == 0) {
                $res = Departement::ajouter($_POST['departement_name']);
                Redirect::to('departements');
            } else {
                echo "Ce nom deja exist";
            }
        } else {
            Redirect::to('departements');
        }
    }
    static public function deleteDepartement()
    {
        if (isset($_POST['departement_id'])) {
            $departement_name = Departement::get($_POST['departement_id']);
            $res = Departement::delete($_POST['departement_id']);
        }
        Redirect::to('departements');
    }
    static public function get($id)
    {
        return Departement::get($id);
    }
    static public function modifierDepartement()
    {
        if (!empty($_POST['departement_name']) && !empty($_POST["departement_id"])) {
            if (Departement::getByName($_POST['departement_name']) == 0) {
                $res = Departement::update($_POST['departement_name'], $_POST["departement_id"]);
                Redirect::withPost('departements', $_POST['key']);
            } else {
                echo "Ce nom deja exist";
            }
        } else {
            Redirect::withPost('departements', $_POST['key']);
        }
    }
}
