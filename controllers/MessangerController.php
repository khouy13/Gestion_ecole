<?php
class MessangerController
{
    static public function getProfiles($statut)
    {
        if ($statut == '3') {
            $prof = new Etudiant();
            $profs = $prof->getProfsOfClass($_SESSION['user_info']['class']);
            $list = "(";
            foreach ($profs as $prof) {
                if ($list != "(") {
                    $list = $list . ",";
                }
                $list = $list . $prof['prof_id'];
            }
            $list = $list . ")";
            $profile = new Messanger();
            return $profile->getProfilesMessanger($_SESSION['user_info']['user_id'], $list);
        } else if ($statut == 2) {
            $listOfclass = "(";
            $module = new Module();
            $modules = $module->getModuleProf($_SESSION['user_info']['user_id']);
            foreach ($modules as $module) {
                if ($listOfclass != "(") {
                    $listOfclass = $listOfclass . ",";
                }
                $listOfclass = $listOfclass . $module['class_id'];
            }
            $listOfclass = $listOfclass . ")";
            $etudiant = new Etudiant();
            return $etudiant->getEtudiantsOfClasses($listOfclass);
        }
        return null;
    }
    static public function getProfilesAndMessages()
    {
        $profiles = MessangerController::getProfiles($_SESSION['user_info']['statut']);
        $messages = [];
        $messageModel = new Messanger();
        $total_messages_NonSeen = 0;
        foreach ($profiles as $profile) {
            $message = $messageModel->getLastMessageBetween($_SESSION['user_info']['user_id'], $profile['user_id']);
            $nbr = $messageModel->MessagesNoSeen($profile['user_id'], $_SESSION['user_info']['user_id']);
            $message['nbr'] = $nbr;
            $total_messages_NonSeen += $nbr;
            array_push($messages, $message);
        }
        $_SESSION['messages'] = $messageModel->getNumberMessagesNonSeen($_SESSION['user_info']['user_id']);
        $_SESSION['nbr_Messages_NSeen'] = $total_messages_NonSeen;
        // var_dump(Messanger::getLastMessages());
        return [$profiles, $messages];
    }
    function MessangerWith($id)
    {
        $profiles = MessangerController::getProfiles($_SESSION['user_info']['statut']);
        $Check = false;
        foreach ($profiles as $profile) {
            if ($profile['user_id'] == $id) {
                $Check = true;
            }
        }
        if ($Check) {
            $user = new Etudiant();
            $result = $user->isStudent($id);
            if ($result) {
                $user = $user->getDatasOfProfile($id, '3');
            } else {
                $user = $user->getDatasOfProfile($id, '2');
            }
            $message = new Messanger();
            $messages = $message->getMessagesBetween($id, $_SESSION['user_info']['user_id']);
            $result = $message->makeMessagesSeen($id, $_SESSION['user_info']['user_id']);
            $_SESSION['messages'] = $message->getNumberMessagesNonSeen($_SESSION['user_info']['user_id']);
            $_SESSION['nbr_Messages_NSeen'] = Messanger::getNumberMessagesNonSeen($_SESSION['user_info']['user_id']);
            return [$user, $messages];
        } else {
            Redirect::to('messanger');
        }
    }
    static public function AddMessageToMessanger()
    {
        if (isset($_POST['sendMessage'])) {

            $content = htmlspecialchars($_POST['messageContent']);
            $receptor = htmlspecialchars($_POST['receptor']);
            // if sender is a student 
            $profiles = MessangerController::getProfiles($_SESSION['user_info']['statut']);

            // checkk if receptor is one of students or profs that are avaible to the user 
            $Check = false;
            foreach ($profiles as $profile) {
                if ($profile['user_id'] == $receptor) {
                    $Check = true;
                }
            }

            if ($Check) {
                $res = Messanger::AddMessgeInMessanger($_SESSION['user_info']['user_id'], $receptor, $content);
            }
        }
    }
    static public function  DeleteMessage()
    {
        if (isset($_POST['deleteMessage'])) {
            $profiles = MessangerController::getProfiles($_SESSION['user_info']['statut']);

            $message_id = htmlspecialchars($_POST['message_id']);
            $result = Messanger::isHereMessage($message_id);

            if ($result) {
                Messanger::deleteMessageFromDB($message_id);
            }
        }
    }
}
