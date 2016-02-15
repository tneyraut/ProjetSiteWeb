<?php

Message::addQuery('ENVOYER_MESSAGE', 'INSERT INTO message(destinataire_id,expediteur_id,contenu,conversation_id,lu) VALUES (:destinataire_id,:expediteur_id,:contenu,:conversation_id,0)');

Message::addQuery('MESSAGE_LU', 'UPDATE message SET lu=1 WHERE message_id=:id');

Message::addQuery('NOMBRE_MESSAGES_NON_LUS_BY_USER', 'SELECT COUNT(message_id) AS nombre FROM message WHERE destinataire_id=:id AND lu=0');

Message::addQuery('MESSAGE_BY_ID', 'SELECT conversation_id,destinataire_id,expediteur_id,contenu FROM message WHERE message_id=:id');

Message::addQuery('MESSAGES', 
        'SELECT message.message_id,message.contenu,message.conversation_id,user.login 
        FROM message,user 
        WHERE user.user_id=message.expediteur_id 
        AND message.conversation_id IN (SELECT conversation_id FROM conversation WHERE locuteur1_id=:id OR locuteur2_id=:id)'
        );

Message::addQuery('SUPPRIMER_MESSAGES', 'DELETE FROM message WHERE conversation_id=:conversation_id');

Message::addQuery('GET_MESSAGES_NON_LUS_BY_CONVERSATION', 'SELECT message_id,contenu,conversation_id,lu FROM message WHERE lu=0 AND conversation_id=:conversation_id');
