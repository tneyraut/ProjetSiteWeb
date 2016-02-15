<?php

class AdminController extends Controller
{
    
    public function defaultAction() {
        $users = User::getList();
        $this->view->render('admin/gestionUsers', array('users' => $users));
        return new Response();
    }
    
    public function supprimerUserAction()
    {
        $login = $this->request->getPostValue('login');
        $loginUser = $this->request->getPostValue('loginUser');
        if ($loginUser != "" && User::isLoginUsed($loginUser)) {
            $login = $loginUser;
        }
        else if ($loginUser != "" && !User::isLoginUsed($loginUser)) {
            $users = User::getList();
            $this->view->render('admin/gestionUsers', array('users' => $users, 'erreur' => "Le Login rentré n'existe pas."));
            return new Response();
        }
        $unUser = User::getByLogin($login);
        Ami::supprimerAmiBySuppressionUser($unUser->user_id);
        $conversations = Conversation::getConversationsByLocuteur($unUser->user_id);
        foreach ($conversations as $conversation) {
            Message::supprimerMessagesByConversation($conversation->conversation_id);
            Conversation::supprimerConversation($conversation->conversation_id);
        }
        Partie::supprimerInvitationsBySuppressionUser($unUser->user_id);
        $parties = Partie::getPartieByUser($unUser->user_id);
        foreach ($parties as $partie) {
            $joueurs = Joueur::getParticipants($partie->partie_id);
            $test = true;
            foreach ($joueurs as $joueur) {
                if ($joueur->login != $login && User::isLoginUsed($joueur->login)) {
                    $test = false;
                    break;
                }
            }
            if ($test) {
                foreach ($joueurs as $joueur) {
                    CarteDestination::supprimerJoueurCarteDestinationByJoueur($joueur->joueur_id);
                    Main::supprimerMainByJoueur($joueur->joueur_id);
                }
                PiocheVisible::supprimerPiocheVisibleByPartie($partie->partie_id);
                Pioche::supprimerPiocheByPartie($partie->partie_id);
                Joueur::supprimerJoueurByPartie($partie->partie_id);
                Partie::supprimerInvitationByPartie($partie->partie_id);
                Route::supprimerJoueurRouteByPartie($partie->partie_id);
                Partie::supprimerPartieById($partie->partie_id);
            }
        }
        User::supprimerUser($login);
        $users = User::getList();
        $this->view->render('admin/gestionUsers', array('users' => $users));
        return new Response();
    }
    
    public function ajouterAdminAction()
    {
        $login = $this->request->getPostValue('login');
        $password = $this->request->getPostValue('password');
        if ($login == "" || $password == "") {
            $users = User::getList();
            $this->view->render('admin/gestionUsers', array('users' => $users, 'erreur' => "Champs login ou champs password incomplet."));
            return new Response();
        }
        if(User::isLoginUsed($login))
        {
            $users = User::getList();
            $this->view->render('admin/gestionUsers', array('users' => $users, 'erreur' => "Ce login est déjà utilisé."));
            return new Response();
        }
        User::createAdmin($login, $password);
        $users = User::getList();
        $this->view->render('admin/gestionUsers', array('users' => $users));
        return new Response();
    }
    
}