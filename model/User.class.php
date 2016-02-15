<?php

class User extends Model
{

    public static function isLoginUsed($login)
    {
        return count(parent::exec('IS_LOGIN_USED', array(':login' => $login))) != 0;
    }

    public static function getList()
    {
        return parent::exec('USER_LIST', array());
    }
    
    public static function getByID($id) {
        $users = parent::exec('USER_BY_ID', array(':id' => $id));

        if(count($users) > 0)
            return $users[0];
        
        return NULL;
    }

    public static function create($login, $pwd, $prenom, $nom, $mail){
        $sth = parent::exec('USER_CREATE', array(':login' => $login, ':password' => $pwd, ':admin' => 0, ':prenom' => $prenom, ':nom' => $nom, ':mail' => $mail )); 

        return static::tryLogin($login, $pwd);
    }
    
    public static function createAdmin($login, $password)
    {
        parent::exec('ADMIN_CREATE', array(':login' => $login, ':password' => $password));
    }
    
    public static function supprimerUser($login)
    {
        parent::exec('SUPPRIMER_USER', array(':login' => $login));
    }

    public static function tryLogin($login, $pwd)
    {
        $users = parent::exec('USER_CONNECT', array(':login' => $login));

        if(count($users) > 0)
        {
            $user = $users[0];
            
            if($user->password !== sha1($pwd))
                return NULL;
            else
            {
                $session = Session::singleton();
                $session->userId = $user->user_id;
                return $user;
            }
        }

        return NULL;
    }
    
    public static function getByLogin($login)
    {
        $logins = parent::exec('USER_BY_LOGIN', array(':login' => $login));
        if (count($logins) > 0) {
            return $logins[0];
        }
        return NULL;
    }
    
    public static function incrementePartiesGagnees($user_id)
    {
        parent::exec('INCREMENTE_PARTIES_GAGNEES', array(':user_id' => $user_id));
    }
    
    public static function incrementePartiesPerdues($user_id)
    {
        parent::exec('INCREMENTE_PARTIES_PERDUES', array(':user_id' => $user_id));
    }
    
    public static function getClassementPartiesGagneesAsc()
    {
        return parent::exec('ORDER_BY_PARTIES_GAGNEES_ASC', array());
    }

    public static function getClassementPartiesGagneesDesc()
    {
        return parent::exec('ORDER_BY_PARTIES_GAGNEES_DESC', array());
    }

    public static function getClassementPartiesPerduesAsc()
    {
        return parent::exec('ORDER_BY_PARTIES_PERDUES_ASC', array());
    }

    public static function getClassementPartiesPerduesDesc()
    {
        return parent::exec('ORDER_BY_PARTIES_PERDUES_DESC', array());
    }

    public static function getClassementLoginAsc()
    {
        return parent::exec('ORDER_BY_LOGIN_ASC', array());
    }

    public static function getClassementLoginDesc()
    {
        return parent::exec('ORDER_BY_LOGIN_DESC', array());
    }
    
    public static function getNombreDeUsers()
    {
        return parent::exec('NOMBRE_DE_USERS', array());
    }
    
    public static function getClassementNombrePartiesJoueesDESC()
    {
        return parent::exec('ORDER_BY_NOMBRE_PARTIES_JOUEES_DESC', array());
    }
    
    public static function getRatioDESC() 
    {
        return parent::exec('ORDER_BY_RATIO_DESC', array());
    }
    
    public static function getClassementMeilleureScore()
    {
        return parent::exec('ORDER_BY_MEILLEUR_SCORE_DESC', array());
    }
    
    public static function modifierProfil($nationalite,$age,$sexe,$ville_de_naissance,$password,$login,$id)
    {
        parent::exec('MODIFIER_PROFIL', array(
            ':login' => $login,
            ':nationalite' => $nationalite,
            ':sexe' => $sexe,
            ':age' => $age,
            ':ville_de_naissance' => $ville_de_naissance,
            ':password' => $password,
            ':id' => $id
        ));
    }
    
    
    
}