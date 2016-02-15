<?php

class GestionPartiesController extends Controller
{

    public function defaultAction()
    {
       return $this->rejoindreAction();
    }
    
    public function creerAction()
    {
        if(isset($this->user))
        {
            $id = $this->user->user_id;
            $amis = Ami::getAmisByUser($id);
            $this->view->render('gestion_parties/creerPartie', array('amis' => $amis));
            return new Response();
        }
        
        $response = new Response();
        $response->redirect('accueil', 'login');
        
        return $response;
    }
    
    public function rejoindreAction()
    {
        $response = new Response();
        
        if(isset($this->user))
        {
            $invitations = Partie::getPartieInvitation($this->user->user_id);
            $this->view->setArg('invitations', $invitations);
            
            $partiesPubliques = Partie::getListePartiePublique();
            $this->view->setArg('partiesPubliques', $partiesPubliques);
            
            $partiesEnCoursCreation = Partie::getPartieEnCoursCreation($this->user->user_id);
            $this->view->setArg('partiesEnCoursCreation', $partiesEnCoursCreation);
            
            $partiesEnCours = Partie::getPartieEnCours($this->user->user_id);
            $this->view->setArg('partiesEnCours', $partiesEnCours);

            $this->view->render('gestion_parties/rejoindre');
            
            return $response;
        }
        
        
        $response->redirect('accueil', 'login');
        
        return $response;
    }


    public function accepterInvitationAction($partie_id,$invitation_id,$nombreDeJoueursMax)
    {
        $response = new Response();
        $participants = Joueur::getParticipants($partie_id);
        
        if (count($participants) == $nombreDeJoueursMax) {
            $invitations = Partie::getPartieInvitation($this->user->user_id);
            $this->view->setTemplate('boutonCreerUnePartie', 'partie/boutonCreerUnePartie');
            $this->view->render('gestion_parties/listeInvitations', array('invitations' => $invitations, 'erreur' => "Le nombre de joueur maximale a été atteint."));
        }
        
        else {
            Partie::accepterInvitation($invitation_id);
            Joueur::addParticipant($partie_id, $this->user->user_id);
            $response->redirect('gestionParties', 'salleAttente', array('partie_id' => $partie_id));
        }
        
        return $response;
    }
    
    public function refuserInvitationAction($invitation_id)
    {
        $response = new Response();
        Partie::refuserInvitation($invitation_id);
        $response->redirect('gestionParties', 'listeInvitation');
        return $response;
    }

    public function creerPartieAction()
    {
        $response = new Response();
        
        $nom = $this->request->getPostValue('nom');
        $nombreJoueurs = $this->request->getPostValue('nombreJoueurs');
        $mapName = $this->request->getPostValue('map');
        $partiePublique = $this->request->getPostValue('publique');
        $invite1 = $this->request->getPostValue('invite1');
        $invite2 = $this->request->getPostValue('invite2');
        $invite3 = $this->request->getPostValue('invite3');
        $invite4 = $this->request->getPostValue('invite4');
        
        if($nom == null || $nom == "")
        {
            $this->view->render('gestion_parties/creerPartie', array('erreur' => "Vous n'avez pas saisi de nom"));
            return $response;
        }
        
        $tableauInvite = array($invite1,$invite2,$invite3,$invite4);
        
         if (
                ($invite1 == $invite2 && $invite1 != "" && $invite2 != "") || 
                ($invite1 == $invite3 && $invite1 != "" && $invite3 != "") || 
                ($invite1 == $invite4 && $invite1 != "" && $invite4 != "") ||
                ($invite2 == $invite3 && $invite2 != "" && $invite3 != "") || 
                ($invite2 == $invite4 && $invite2 != "" && $invite4 != "") || 
                ($invite3 == $invite4 && $invite3 != "" && $invite4 != "")
                ) {
            $this->view->render('gestion_parties/creerPartie', array('erreur' => "Vous avez rentré deux fois le même login."));
            return $response;
        }
        
        foreach ($tableauInvite as $invite) { 
            if ($invite != "" && !User::isLoginUsed($invite)) {
                $this->view->render('gestion_parties/creerPartie', array('erreur' => "Un login rentré n'existe pas."));
                return $response;
            }
            
            else if ($invite == $this->user->login) {
                $this->view->render('gestion_parties/creerPartie', array('erreur' => "Vous avez rentré votre propre login."));
                return $response;
            }
        }
        
        $map = Map::getMapIDByName($mapName);
        $map_id = $map->map_id;
        $user_id = $this->user->user_id;
        Partie::creerPartie($nom, $nombreJoueurs,$map_id,$partiePublique,$user_id);
        
        $parties_id = Partie::getPartieID();
        $partie_id = $parties_id[count($parties_id) - 1]->partie_id;
        
        Joueur::addParticipant($partie_id, $user_id);
        
        foreach ($tableauInvite as $invite) {
            if ($invite != "") {
                $inviteur_id = $this->user->user_id;
                $user_invite = User::getByLogin($invite);
                $invite_id = $user_invite->user_id;
                Partie::ajouterInvitation($partie_id, $inviteur_id, $invite_id);
            }
        }
        
        $response->redirect('gestionParties', 'salleAttente', array($partie_id));
        return $response;
    }
    
    public function salleAttenteAction($partie_id)
    {
        $partie = Partie::getPartieDescription($partie_id);
        $participants = Joueur::getParticipants($partie_id);

        $estParticipant = false;
        foreach($participants as $participant)
        {
            if($this->user->login === $participant->login)
                $estParticipant = true;
        }
        
        $this->view->render('gestion_parties/salleAttente', array(
            'partie' => $partie,
            'participants' => $participants,
            'user' => $this->user,
            'estParticipant' => $estParticipant,
            'titre' => 'Descriptif de la Partie'));
            
        
        return new Response();
    }
    
    public function participerAction($partie_id)
    {
        $partie = Partie::getPartieDescription($partie_id);
        $participants = Joueur::getParticipants($partie_id);
        
        if(count($participants) < $partie->nombre_max_joueurs)
            Joueur::addParticipant($partie_id, $this->user->user_id);
        
        $response = new Response();
        $response->redirect('gestionParties', 'salleAttente', array($partie_id));
        
        return $response;
    }
    
    public function nePlusParticiperAction($partie_id)
    {
        Joueur::removeParticipant($partie_id, $this->user->user_id);
        
        $response = new Response();
        $response->redirect('gestionParties', 'salleAttente', array($partie_id));
        
        return $response;
    }
    
}