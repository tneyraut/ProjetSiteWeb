<?php

class Conversation extends Model
{
    
    public static function creerConversation($locuteur1_id,$locuteur2_id)
    {
        parent::exec('CREER_CONVERSATION', array(':locuteur1_id' => $locuteur1_id, ':locuteur2_id' => $locuteur2_id));
    }
    
    public static function supprimerConversation($conversation_id)
    {
        parent::exec('SUPPRIMER_CONVERSATION', array(':conversation_id' => $conversation_id));
    }
    
    public static function getConversationsByLocuteur($locuteur_id)
    {
        return parent::exec('CONVERSATIONS_BY_LOCUTEUR', array(':locuteur_id' => $locuteur_id));
    }
    
    public static function getConversation($id1,$id2)
    {
        return parent::exec('GET_CONVERSATION', array(':id1' => $id1, ':id2' => $id2));
    }
    
    public static function getConversationById($conversation_id)
    {
        $conversation = parent::exec('GET_CONVERSATION_BY_ID', array(':conversation_id' => $conversation_id));
        if (count($conversation) > 0) {
            return $conversation[0];
        }
        return NULL;
    }
    
}