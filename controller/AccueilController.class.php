<?php

class AccueilController extends Controller
{
    public function defaultAction()
    {   
        $users = User::getClassementPartiesGagneesDesc();
        $nombreDeUsers = User::getNombreDeUsers();
        $nombreDePartiesJouees = User::getClassementNombrePartiesJoueesDESC();
        $ratios = User::getRatioDESC();
        $meilleuresScores = User::getClassementMeilleureScore();
        $nombreParties = Partie::getNombrePartiesJouees();
        $nombreDePartiesTerminees = Partie::getNombrePartiesTerminees();
        $nombreDePartiesEnCours = Partie::getNombrePartiesEnCours();
        
        $lienBoutonJouer = Request::buildUrl('accueil', 'login');
        if($this->user)
        {
            $partiesEnCoursDeCreation = Partie::getPartieEnCoursCreation($this->user->user_id);
            $partiesEnCours = Partie::getPartieEnCours($this->user->user_id);
            $partiesPublique = Partie::getListePartiePublique();
        }
        
        $this->view->render(
            'accueil/default', array('users' => $users, 
            'nombreDeJoueurs' => $nombreDeUsers[0]->nombreDeJoueurs, 
            'nombreDePartiesJouees' => $nombreDePartiesJouees,
            'ratios' => $ratios,
            'meilleuresScores' => $meilleuresScores,
            'nombreParties' => $nombreParties[0]->nombre_parties_jouees,
            'nombreDePartiesTerminees' => $nombreDePartiesTerminees[0]->nombre_parties_terminees,
            'nombreDePartiesEnCours' => $nombreDePartiesEnCours[0]->nombre_parties_en_cours
            ));
        
        return new Response();
    }

    public function inscriptionAction()
    {
        $this->view->render('accueil/inscription');
        
        return new Response();
    }

    public function validateInscriptionAction()
    {
        $login = $this->request->getPostValue('inscLogin');
        $response = new Response();
        $erreur = 0;
        
        if(!$login)
        {
            $this->view->setArg('inscErrorLogin', 'Cette information est obligatoire');
            $erreur=1;
        }
        
        if(strlen($login) > 10)
        {
            $this->view->setArg('inscErrorLogin', 'Le login ne doit pas dépasser 10 caractères');
            $erreur=1;
        }
        
        elseif(User::isLoginUsed($login))
        {
            $this->view->setArg('inscErrorLogin', 'Cet identifiant est déjà pris');
            $erreur=1;
        }
        
        else
        {
            $this->view->setArg('inscLogin','');
        }


        $password = $this->request->getPostValue('inscPassword'); 
        if(!$password)
        {
            $this->view->setArg('inscErrorPassword', 'Cette information est obligatoire');
            $erreur=1;
        }
        else
        {
            $this->view->setArg('inscPassword','');
        }

        $prenom = $this->request->getPostValue('inscPrenom');
        if(!$prenom)
        {
            $this->view->setArg('inscErrorPrenom', 'Cette information est obligatoire');
            $erreur=1;
        }
        else
        {
            $this->view->setArg('inscPrenom','');
        }

        $nom = $this->request->getPostValue('inscNom');
        if(!$nom)
        {
            $this->view->setArg('inscErrorNom', 'Cette information est obligatoire');
            $erreur=1;
        }
        else
        {
            $this->view->setArg('inscNom','');
        }

        $mail = $this->request->getPostValue('inscMail');
        if(!$mail)
        {
            $this->view->setArg('inscErrorMail', 'Cette information est obligatoire');
            $erreur=1;
        }
        else
        {
            $this->view->setArg('inscMail','');
        }

        
        if($erreur==1)
        {
            $this->view->render('accueil/inscription');
            return $response;
        }
        
        $user = User::create($login,$password,$prenom,$nom,$mail);

        if(!$user)
        {
            $this->view->setArg('inscErrorText', 'Cannot complete inscription');
            $this->view->render('accueil/inscription');
            
            return $response;
        }
        else
        {
            $response->redirect('accueil');
            return $response;
        }
    }

    public function loginAction()
    {
        $response = new Response();
        
        $this->view->setTemplate('aside', '');

        if(($login = $this->request->getPostValue('login')) && ($password = $this->request->getPostValue('password')))
        {
            $user = User::tryLogin($login, $password);

            if(isset($user)) {
                $response->redirect('accueil', 'default');
                return $response;
            } else {
                $this->view->render('accueil/login', array('error' => 'Identifiants incorrects.'));
                return $response;
            }
        }
        else
        {
            $this->view->render('accueil/login');
            return $response;
        }
    }
    
    public function regleDuJeuAction()
    {
        $this->view->render('regles/regleDuJeu', array('titre' => 'Règles du Jeu'));
        return new response();
    }
    
}