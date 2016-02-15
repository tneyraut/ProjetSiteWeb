<?php

Conversation::addQuery('CREER_CONVERSATION', 'INSERT INTO conversation(locuteur1_id,locuteur2_id) VALUES (:locuteur1_id,:locuteur2_id)');

Conversation::addQuery('SUPPRIMER_CONVERSATION', 'DELETE FROM conversation WHERE conversation_id=:conversation_id');

Conversation::addQuery('CONVERSATIONS_BY_LOCUTEUR', 'SELECT conversation_id,conversation_name,locuteur1_id,locuteur2_id FROM conversation WHERE locuteur1_id=:locuteur_id OR locuteur2_id=:locuteur_id');

Conversation::addQuery('GET_CONVERSATION', 'SELECT conversation_id,conversation_name,locuteur1_id,locuteur2_id FROM conversation WHERE (locuteur1_id=:id1 AND locuteur2_id=:id2) OR (locuteur1_id=:id2 AND locuteur2_id=:id1)');

Conversation::addQuery('GET_CONVERSATION_BY_ID', 'SELECT conversation_id,conversation_name,locuteur1_id,locuteur2_id FROM conversation WHERE conversation_id=:conversation_id');
