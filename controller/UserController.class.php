<?php

class UserController extends Controller
{

    public function defaultAction()
    {
        $this->view->render('user/profile');
        
        return new Response();
    }
    
    public function deconnecterAction() {
        $this->session->destroy();
        
        $response = new Response();
        $response->redirect('accueil');
        
        return $response;
    }

    public function profileAction($id) {
        $partiesTerminees = Partie::getPartiesTerminees($this->user->user_id);
        $this->view->setArg('partiesTerminees', $partiesTerminees);
            
        $this->view->render('user/profile', array('joueur' => $this->user));
        return new Response();
    }
    
    public function updateProfileAction() {
        $this->view->render('user/updateProfile');
        return new Response();
    }
    
    public function modifierProfilAction() {
        $response = new Response();
        
        $login = $this->request->getPostValue('login');
        $password = $this->request->getPostValue('password');
        $passwordConfirmation = $this->request->getPostValue('passwordConfirmation');
        $ancienPassword = $this->request->getPostValue('ancienPassword');
        $nationalite = $this->request->getPostValue('nationalite');
        $sexe = $this->request->getPostValue('sexe');
        $age = $this->request->getPostValue('age');
        $ville_de_naissance = $this->request->getPostValue('ville_de_naissance');
        
        $userCourant = User::getByLogin($this->user->login);
        
        if ($password != "" && ($password != $passwordConfirmation || $ancienPassword == "" ||  sha1($ancienPassword) != $userCourant->password)) {
            $this->view->render('user/updateProfile', array('erreur' => "Erreur dans la confirmation du mot de passe ou dans la saisi de l'ancien mot de passe."));
        }
        else {
            if ($login != "" && User::isLoginUsed($login)) {
                $this->view->render('user/updateProfile', array('erreur' => "Erreur ce login est déjà utilisé."));
                return $response;
            }
            if ($password == "") {
                $password = $userCourant->password;
            }
            if ($login == "") {
                $login = $userCourant->login;
            }
            if ($nationalite == "") {
                $nationalite = $userCourant->nationalite;
            }
            if ($sexe == "") {
                $sexe = $userCourant->sexe;
            }
            if ($age == "") {
                $age = $userCourant->age;
            }
            if ($ville_de_naissance == "") {
                $ville_de_naissance = $userCourant->ville_de_naissance;
            }
            $id = $this->user->user_id;
            User::modifierProfil($nationalite,$age,$sexe,$ville_de_naissance,  sha1($password),$login,$id);
            $response->redirect('accueil');
        }
        
        return $response;
    }
    
    public function messageAction() {
        $response = new Response();
        $id = $this->user->user_id;
        $nombreMessagesNonLus = Message::getNombreMessagesNonLus($id);
        $messages = Message::getMessages($id);
        $amis = Ami::getAmisByUser($id);
        $this->view->render('user/message', array(
            'messages' => $messages, 
            'nombreMessagesNonLus' => $nombreMessagesNonLus,
            'amis' => $amis,
            'titre' => 'Mes Messages'
                ));
        return $response;
    }
    
    public function repondreOuArchiverMessageAction() {
        $response = new Response();
        $message = $this->request->getPostValue('message');
        $conversation_id = $this->request->getPostValue('numeroConversation');
        
        $expediteur_id = $this->user->user_id;
        $conversation = Conversation::getConversationById($conversation_id);
        if ($conversation->locuteur1_id != $this->user->user_id && $conversation->locuteur2_id != $this->user->user_id) {
            $nombreMessagesNonLus = Message::getNombreMessagesNonLus($expediteur_id);
            $messages = Message::getMessages($expediteur_id);
            $amis = Ami::getAmisByUser($expediteur_id);
            $this->view->render('user/message', array(
            'messagesNonLus' => $messages, 
            'nombreMessagesNonLus' => $nombreMessagesNonLus,
            'amis' => $amis,
            'erreur' => "Numéro de conversation incorrect."
                ));
        }
        if ($conversation->locuteur1_id == $this->user->user_id) {
            $destinataire_id = $conversation->locuteur2_id;
        }
        else {
            $destinataire_id = $conversation->locuteur1_id;
        }
        
        if ($message != "") {
            $messagesNonLus = Message::getMessagesNonLusByConversation($conversation_id);
            foreach($messagesNonLus as $unMessage) {
                Message::messageLu($unMessage->message_id);
            }
            Message::envoyerMessage($destinataire_id,$expediteur_id,$message,$conversation_id);
        }
        else {
            Message::supprimerMessagesByConversation($conversation_id);
            Conversation::supprimerConversation($conversation_id);
        }
        
        $nombreMessagesNonLus = Message::getNombreMessagesNonLus($expediteur_id);
        $messages = Message::getMessages($expediteur_id);
        $amis = Ami::getAmisByUser($expediteur_id);
        
        $this->view->render('user/message', array(
            'messages' => $messages, 
            'nombreMessagesNonLus' => $nombreMessagesNonLus,
            'amis' => $amis
                ));
        
        return $response;
    }
    
    public function envoyerMessageAction() {
        $loginAmi = $this->request->getPostValue('loginAmi');
        $message = $this->request->getPostValue('message');
        
        $user_destinataire = User::getByLogin($loginAmi);
        $destinataire_id = $user_destinataire->user_id; 
        $expediteur_id = $this->user->user_id;
        $conversation = Conversation::getConversation($destinataire_id, $expediteur_id);
        if (count($conversation) > 0) {
            Message::envoyerMessage($destinataire_id, $expediteur_id, $message, $conversation[0]->conversation_id);
        }
        else {
            Conversation::creerConversation($expediteur_id, $destinataire_id);
            $conversation = Conversation::getConversation($destinataire_id, $expediteur_id);
            Message::envoyerMessage($destinataire_id,$expediteur_id,$message,$conversation[0]->conversation_id);
        }
        
        $messages = Message::getMessages($expediteur_id);
        $nombreMessagesNonLus = Message::getNombreMessagesNonLus($expediteur_id);
        /*
        foreach ($messages as $unMessage) {
            if ($unMessage->destinataire_id == $expediteur_id) {
                Message::messageLu($unMessage->message_id);
            }
        }*/
        $amis = Ami::getAmisByUser($expediteur_id);
        $this->view->render('user/message', array(
            'messages' => $messages, 
            'nombreMessagesNonLus' => $nombreMessagesNonLus,
            'amis' => $amis
                ));
        return new Response();
    }
    
}