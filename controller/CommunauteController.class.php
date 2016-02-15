<?php

class CommunauteController extends Controller
{
      
    public function defaultAction()
    {
        $listeUser = User::getList();
        $this->view->render('communaute/communaute', array('listeUser' => $listeUser));
        return new Response();
    }
    
    public function rechercheFicheJoueurParLoginAction()
    {
        $loginJoueurRecherche = $this->request->getPostValue('loginFicheJoueur');
        $loginJoueur = $this->request->getPostValue('loginJoueur');
        
        if ($loginJoueurRecherche == "") {
            $loginJoueurRecherche = $loginJoueur;
        }
        
        $listeUser = User::getList();
        $response = new Response();
        
        $joueur = User::getByLogin($loginJoueurRecherche);
        if (isset($joueur)) {
            $this->view->render('communaute/ficheJoueur',array('joueur' => $joueur, 'listeUser' => $listeUser));
        }
        else {
            $this->view->render('communaute/communaute', array('erreur' => "Ce login n'existe pas.", 'listeUser' => $listeUser));
        }
        return $response;
    }
    
    public function demandeAmiAction()
    {
        $response = new Response();
        
        $id = $this->user->user_id;
        $amis = Ami::getAmisByUser($id);
        $invitations = Ami::getInvitationByUser($id);
        $users = User::getList();
        $userLogin = $this->user->login;
        
        $this->view->render('communaute/ami', array('amis' => $amis, 'invitations' => $invitations, 'users' => $users, 'userLogin' => $userLogin));
        
        return $response;
    }
    
    public function accepterDemandeAmiAction()
    {
        $response = new Response();
        
        $id = $this->user->user_id;
        $invitation = $this->request->getPostValue('loginInvitation');
        
        $inviteur = User::getByLogin($invitation);
        $inviteur_id = $inviteur->user_id;
        
        Ami::miseAJourAmi($id,$inviteur_id);
        
        $amis = Ami::getAmisByUser($id);
        $invitations = Ami::getInvitationByUser($id);
        $users = User::getList();
        $userLogin = $this->user->login;
        
        $this->view->render('communaute/ami', array('amis' => $amis, 'invitations' => $invitations, 'users' => $users, 'userLogin' => $userLogin));
        
        return $response;
    }
    
    public function envoyerDemandeAmiAction()
    {
        $response = new Response();
        
        $id = $this->user->user_id;
        $login = $this->request->getPostValue('login');
        $invite = User::getByLogin($login);
        
        $amis = Ami::getAmisByUser($id);
        $invitations = Ami::getInvitationByUser($id);
        $users = User::getList();
        $userLogin = $this->user->login;
        
        $amisDemandes = Ami::getAmisDemandesByUser($id);
        
        $problem = false;
        foreach ($amisDemandes as $amiDemande) {
            if (!$problem && $amiDemande->login == $invite->login) {
                $problem = true;
                $this->view->render('communaute/ami', array('amis' => $amis, 'invitations' => $invitations, 'users' => $users, 'userLogin' => $userLogin, 'erreur' => "Vous êtes déjà ami avec l'utilisateur que vous avez choisi ou vous avez déjà reçu ou envoyé une demande d'ami."));
            }
        }
        if (!$problem && $invite->login == $this->user->login) {
            $problem = true;
            $this->view->render('communaute/ami', array('amis' => $amis, 'invitations' => $invitations, 'users' => $users, 'userLogin' => $userLogin, 'erreur' => "Erreur : vous avez sélectionné votre propre login."));
        }
        if (!$problem) { 
            $invite_id = $invite->user_id;
            Ami::creerInvitation($id,$invite_id);
            $this->view->render('communaute/ami', array('amis' => $amis, 'invitations' => $invitations, 'users' => $users, 'userLogin' => $userLogin));
        }
        
        return $response;
    }
    
}