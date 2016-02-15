<?php

class Message extends Model
{
    
    public static function envoyerMessage($destinataire_id,$expediteur_id,$contenu,$conversation_id) {
        parent::exec('ENVOYER_MESSAGE', array(
            ':destinataire_id' => $destinataire_id, 
            ':expediteur_id' => $expediteur_id, 
            ':contenu' => $contenu,
            ':conversation_id' => $conversation_id
                ));
    }
    
    public static function messageLu($id) {
        parent::exec('MESSAGE_LU', array(':id' => $id));
    }
    
    public static function getMessages($id) {
        return parent::exec('MESSAGES', array(':id' => $id));
    }
    
    public static function getNombreMessagesNonLus($id) {
        return parent::exec('NOMBRE_MESSAGES_NON_LUS_BY_USER', array(':id' => $id));
    }
    
    public static function getMessageById($id) {
        $messages = parent::exec('MESSAGE_BY_ID', array(':id' => $id));
        if (count($messages) > 0) {
            return $messages[0];
        }
        return NULL;
    }
    
    public static function supprimerMessagesByConversation($conversation_id)
    {
        parent::exec('SUPPRIMER_MESSAGES', array(':conversation_id' => $conversation_id));
    }
    
    public static function getMessagesNonLusByConversation($conversation_id)
    {
        return parent::exec('GET_MESSAGES_NON_LUS_BY_CONVERSATION', array(':conversation_id' => $conversation_id));
    }
    
}