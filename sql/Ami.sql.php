<?php

Ami::addQuery('GET_AMIS_BY_USER_ID', 'SELECT user.login FROM user,ami
        WHERE (ami.user_id=user.user_id AND ami.user_ami_id=:id AND ami.accepter=1) 
        OR (ami.user_ami_id=user.user_id AND ami.user_id=:id AND ami.accepter=1)'
        );

Ami::addQuery('GET_INVITATIONS_BY_USER', 'SELECT user.login FROM user,ami
        WHERE (ami.user_id=user.user_id AND ami.user_ami_id=:id AND ami.accepter=0)'
        );

Ami::addQuery('MISE_A_JOUR_AMI', 'UPDATE ami SET accepter=1 WHERE user_ami_id=:id AND user_id=:inviteur_id');

Ami::addQuery('CREER_INVITATION', 'INSERT INTO ami(user_id,user_ami_id) VALUES (:user_id,:user_ami_id)');

Ami::addQuery('GET_AMIS_DEMANDES_BY_USER_ID', 'SELECT user.login FROM user,ami
        WHERE (ami.user_id=user.user_id AND ami.user_ami_id=:id) 
        OR (ami.user_ami_id=user.user_id AND ami.user_id=:id)'
        );

Ami::addQuery('SUPPRIMER_AMI_BY_SUPPRESSION_USER', 'DELETE FROM ami WHERE user_id=:id OR user_ami_id=:id');
