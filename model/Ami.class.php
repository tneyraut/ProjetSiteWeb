<?php

class Ami extends Model
{
    
    public static function getAmisByUser($id) {
        return parent::exec('GET_AMIS_BY_USER_ID', array(':id' => $id));
    }
    
    public static function getInvitationByUser($id) {
        return parent::exec('GET_INVITATIONS_BY_USER', array(':id' => $id));
    }
    
    public static function miseAJourAmi($id,$inviteur_id) {
        parent::exec('MISE_A_JOUR_AMI', array(':id' => $id, ':inviteur_id' => $inviteur_id));
    }
    
    public static function creerInvitation($id,$user_ami_id) 
    {
        parent::exec('CREER_INVITATION', array(':user_id' => $id, ':user_ami_id' => $user_ami_id));
    }
    
    public static function getAmisDemandesByUser($id) {
        return parent::exec('GET_AMIS_DEMANDES_BY_USER_ID', array(':id' => $id));
    }
    
    public static function supprimerAmiBySuppressionUser($id)
    {
        parent::exec('SUPPRIMER_AMI_BY_SUPPRESSION_USER', array(':id' => $id));
    }
    
}