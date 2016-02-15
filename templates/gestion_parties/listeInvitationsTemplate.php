<?php $this->includeTemplate('panel', array('titre' => 'Liste des invitations reçues')); ?>
<?php if (isset($erreur)): ?>
    <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
<?php endif ?>

<?php if (count($invitations) == 0): ?>
    <strong>Vous n'avez reçu aucune invitation</strong>
<?php else: $compteur = 0; ?>

    <?php foreach ($invitations as $invitation): ?>
        <div class="row">

            <?php if ($invitation->etat == 0 && $invitation->accepter == 0): $compteur++; ?>
                <div class="col-md-6">
                    <br><br>
                    <strong>
                        Nom : <?php echo $invitation->nomPartie; ?><br>
                        Créateur : <?php echo $invitation->login; ?><br>
                        Map : <?php echo $invitation->nom; ?><br>
                        Nombre de joueurs maximum : <?php echo $invitation->nombre_max_joueurs; ?><br>
                        Partie publique : <?php echo $invitation->publique ? "Oui" : "Non" ?><br>
                    </strong>
                </div>
                <div class="col-md-1">
                    <p style="text-align: center">
                        <a id="btn-accepter-invitation" class="btn btn-lg center" href="<?php $this->bu('gestionParties', 'accepterInvitation', array('partie_id' => $invitation->partie_id, 'invitation_id' => $invitation->invitation_id, 'nombreDeJoueursMax' => $invitation->nombre_max_joueurs)) ?>" role="button">Accepter l'invitation</a>
                    </p>
                    <p style="text-align: center">
                        <a id="btn-accepter-invitation" class="btn btn-lg center" href="<?php $this->bu('gestionParties', 'refuserInvitation', array('invitation_id' => $invitation->invitation_id)) ?>" role="button">Refuser l'invitation</a>
                    </p>
                    <br><br>
                </div>
            <?php endif; ?>
        </div>
        <?php
    endforeach;
    if ($compteur == 0):
        ?>
        <strong>Vous n'avez reçu aucune nouvelle invitation.</strong>
    <?php endif; ?>
<?php endif ?>
<?php $this->includeTemplate('panelFin'); ?>