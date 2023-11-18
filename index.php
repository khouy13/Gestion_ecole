<?php

require_once('./autoload.php');
$Home = new HomeController();
if (isset($_GET['page'])) {
  $Home->index($_GET['page']);
} else {
  $Home->index('login');
}

class HomeController
{

  static public function index($page)
  {
    if (isset($_SESSION['prof_id'])) {
      $_SESSION['nbr_Messages_NSeen'] = Messanger::getNumberMessagesNonSeen($_SESSION['user_info']['user_id']);
      $_SESSION['modules'] = Module::getModuleProf($_SESSION['user_info']['user_id']);
      $pages = ['abs', 'emploi', 'home', 'note', 'noteModule', 'nouvelle', 'test', 'message', 'contact', 'messanger', 'modules', 'module', 'absence'];
      if (in_array($page, $pages)) {
        include('views/prof/' . $page . '.php');
      } else if ($page == "addCour") {
        CourController::ajouterCour();
      } else if ($page == "addTask") {
        TaskController::ajouterTask();
      } else if ($page == "deleteCour") {
        CourController::suprimerCour();
      } else if ($page == "deleteTask") {
        TaskController::deleteTask();
      } else if ($page == 'AddNote') {
        NoteController::enregistrerNote();
      } else if ($page == 'deleteNote') {
        NoteController::suprimerNote();
      } else if ($page == "AddMessageAdmin") {
        ContactController::AddMessage();
      } else if ($page == "AddService") {
        ServiceController::addService();
      }else if($page =="EnregistrerNotes"){
        NoteController::saveAll();
      } else if ($page == 'modifierProfil') {
        include('views/' . $page . '.php');
      } else if ($page == 'showProfile') {
        $datas = Etudiant::getDatasOfProfile($_SESSION['user_info']['user_id'], $_SESSION['user_info']['statut']);

        include('views/profile/showProfile.php');
      } else if ($page == "AddAbsence") {
        AbsenceController::AddAbsence();
      } else if ($page == 'editProfile') {
        include('views/profile/editProfile.php');
      } else {
        include('views/includes/404.php');
      }
    } else if (isset($_SESSION['admin_id'])) {
      $pages = ['essay', 'decision', 'home', 'notes', 'news', 'nextSemestre', 'nextAnnee', 'etudiant', 'prof', 'absences', 'filliere', 'module', 'class', 'users', 'departements', 'setting', 'services', 'modules', 'classes', 'AddService'];
      if (in_array($page, $pages)) {
        include('views/admin/' . $page . '.php');
      } else if ($page == 'modifierProfil') {
        include('views/' . $page . '.php');
      } else if ($page == 'showProfile') {
        include('views/profile/showPofile.php');
      } else if ($page == "AddService") {
        ServiceController::addService();
      } else if ($page == "TraiterDemande") {
        ServiceController::TraiterDemnade();
      } else if ($page == "SupprimerDemande") {
        ServiceController::SupprimerDemande();
      } else if ($page == "changePassword") {
        EtudiantController::ChangePassword();
      } else if ($page == 'addProf') {
        EtudiantController::ajouterProf();
      } else if ($page == 'addStudent') {
        EtudiantController::ajouterEtudiant();
      } else if ($page == "editStudent") {
        EtudiantController::ChangeDatasStudentByAdmin();
      } else if ($page == "editProf") {
        EtudiantController::ChangeDatasProfByAdmin();
      } else if ($page == "deleteUser") {
        EtudiantController::deleteEUser();
      } else if ($page == "addDepartement") {
        DepartementController::ajouterDepartement();
      } else if ($page == "DeleteDepartement") {
        DepartementController::deleteDepartement();
      } else if ($page == "modifierDepartement") {
        DepartementController::modifierDepartement();
      } else if ($page == "addFilliere") {
        FilliereController::ajouterFilliere();
      } else if ($page == "DeleteFilliere") {
        FilliereController::deletefilliere();
      } else if ($page == "modifierFilliere") {
        FilliereController::update();
      } else if ($page == "addClass") {
        ClassController::ajouterClass();
      } else if ($page == "DeleteClass") {
        ClassController::deleteClass();
      } else if ($page == "editClass") {
        ClassController::update();
      } else if ($page == "addModule") {
        ModuleController::ajouterModule();
      } else if ($page == "DeleteModule") {
        ModuleController::deleteModule();
      } else if ($page == "deleteActivity") {
        Activity::delete($_POST['id']);
        Redirect::to('home');
      } else if ($page == "editModule") {
        ModuleController::update();
      } else if ($page == "addNews") {
        NewsController::insert();
      } else if ($page == "updateNews") {
        NewsController::update();
      } else if ($page == "DeleteNews") {
        NewsController::delete();
      } else if ($page == "updateMessage") {
        ContactController::updateMessage();
      } else if ($page == "deleteMessage") {
        ContactController::deleteMessage();
      } else if ($page == "Semestre2") {
        NextSemestreController::NextSemestre();
      } else if ($page == 'Year2') {
        NextYearController::NextYear();
      } else if ($page == 'editProfile') {
        include('views/profile/editProfile.php');
      } else {
        include('views/includes/404.php');
      }
    } else if (isset($_SESSION['etudiant_id'])) {
      $_SESSION['notifications_nbr'] = Notification::getNumberNotificationsNonSeen();
      $_SESSION['notifications'] = Notification::getNotificationsNonSeen($_SESSION['user_info']['user_id']);
      $_SESSION['nbr_Messages_NSeen'] = Messanger::getNumberMessagesNonSeen($_SESSION['user_info']['user_id']);
      $_SESSION['modules'] = Module::getModuleEtudiant($_SESSION['user_info']['class']);
      $pages = ['emploi','home', 'nouvelle', 'choixFillieres', 'cour', 'note', 'message', 'contact', 'messanger', 'modules', 'module', 'nouvelles'];
      if (in_array($page, $pages)) {

        include('views/etudiant/' . $page . '.php');
      } else if ($page == "classification") {
        ClassementController::enregistrer();
      } else if ($page == 'showProfile') {
        $datas = Etudiant::getDatasOfProfile($_SESSION['user_info']['user_id'], $_SESSION['user_info']['statut']);
        include('views/profile/showProfile.php');
      } else if ($page == 'editProfile') {
        include('views/profile/editProfile.php');
      } else if ($page == "AddService") {
        ServiceController::addService();
      } else {
        include('views/includes/404.php');
      }
    } else if (isset($_SESSION['laureat'])) {
      include('views/includes/laureat.php');
    } else {
      if ($page == 'login') {
        include('views/Login/login.php');
      } elseif ($page == "forgetPassword") {
        LoginController::sendCode();
        if (isset($_SESSION['code_verification'])) {
          include('views/Login/resetPassword.php');
        } else {
          Redirect::withPost('login', 1);
        }
      } else {
        include('views/includes/404.php');
      }
    }
  }
}
