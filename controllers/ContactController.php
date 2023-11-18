<?php
class ContactController
{
    static public function AddMessage()
    {
        if (isset($_POST['send'])) {
            if (isset($_SESSION['etudiant_id']) || isset($_SESSION['prof_id'])) {
                $message = $_POST['message'];
                if ($message == "") {
                    return false;
                }
                $contact = new Contact();
                $result =  $contact->AddMessage($message);
                if ($result) {
                    Redirect::withPost('contact', null, 'sended');
                }
                Redirect::withPost('contact', null, 'non sended');
            }
        } else
            Redirect::to('contact');
    }
    public static function getAllMessage()
    {
        if (isset($_SESSION['admin_id'])) {
            return Contact::getAllMessage();
        }
    }
    public static function updateMessage()
    {
        if (isset($_SESSION['admin_id']) && isset($_POST['message_id'])) {
            $id = $_POST['message_id'];
            Contact::update($id);
        }
        Redirect::to('services');
    }
    public static function deleteMessage()
    {
        if (isset($_SESSION['admin_id']) && isset($_POST['message_id'])) {
            $id = $_POST['message_id'];
            Contact::delete($id);
        }
        Redirect::to('services');
    }
}
