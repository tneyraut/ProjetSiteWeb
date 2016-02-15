<?php

class Joueur extends Model 
{
    
    public static function addParticipant($partie_id, $user_id)
    {
        $participants = Joueur::getParticipants($partie_id);
        $tableau = array("rouge","prune","vert","marron","bleu");
        $couleur = $tableau[0];
        $compteur = 1;
        foreach ($participants as $participant) {
            if ($participant->couleur == $couleur) {
                $couleur = $tableau[$compteur];
                $compteur++;
            }
        }
        parent::exec('ADD_PARTICIPANT', array(':partie_id' => $partie_id, ':user_id' => $user_id, ':couleur' => $couleur));
    }

    public static function removeParticipant($partie_id, $user_id)
    {
        parent::exec('REMOVE_PARTICIPANT', array(':partie_id' => $partie_id, ':user_id' => $user_id));
    }

    public static function getParticipants($partie_id)
    {
        $participants = parent::exec('PARTICIPANTS', array(':id' => $partie_id));
        return $participants;
    }
    
    public static function getById($joueur_id)
    {
        $joueur = parent::exec('GET_BY_ID', array(':joueur_id' => $joueur_id));
        if(count($joueur) > 0)
            return $joueur[0];
        
        return NULL;
    }
    
    public static function getByUserId($partie_id, $user_id)
    {
        $joueur = parent::exec('GET_BY_USER', array(':user_id' => $user_id, 'partie_id' => $partie_id));
        if(count($joueur) > 0)
            return $joueur[0];
        
        return NULL;
    }
    
    public static function removeJetons($joueur_id, $nb)
    {
        parent::exec('REMOVE_JETONS', array(':joueur_id' => $joueur_id, ':nb' => $nb));
    }
    
    public static function setScore($joueur_id, $score) 
    {
        parent::exec('SET_SCORE', array(':joueur_id' => $joueur_id, ':score' => $score));
    }


    public static function incrementeScore($joueur_id, $nb)
    {
        parent::exec('INCREMENTE_SCORE', array(':joueur_id' => $joueur_id, ':nb' => $nb));
    }
    
    public static function supprimerJoueurByPartie($partie_id)
    {
        parent::exec('SUPPRIMER_JOUEUR_BY_PARTIE', array(':partie_id' => $partie_id));
    }
    
}