<?php $this->includeTemplate('panel', array('titre' => 'Liste de vos amis')); ?>
        
<?php if($amis): ?>
    <form action="<?php $this->bu('communaute', 'rechercheFicheJoueurParLogin') ?>" method="post">
        <table>
            <tr>
               <th>Liste de vos amis :</th>
               <td>
                   <select id='loginJoueur' class="selectpicker show-tick form-control" name="loginJoueur">
                       <?php foreach ($amis as $ami): ?>
                       <option><?php echo $ami->login; ?></option>
                       <?php endforeach; ?>
                    </select>
               </td>
           </tr>
        </table><br>
        <button id="btn-fiche" type="submit" class="btn btn-lg center">Fiche publique</button>
    </form>
<?php else: ?>
    <strong>Vous n'avez aucun ami enregistré.</strong>
<?php endif; ?>

<?php $this->includeTemplate('panelFin'); ?>
    
    

<?php $this->includeTemplate('panel', array('titre' => 'Liste des demandes d\'ami reçues')); ?>
    
<?php if($invitations): ?>
    <form action="<?php $this->bu('communaute', 'accepterDemandeAmi') ?>" method="post">
        <table>
            <tr>
               <th>Liste des demandes reçues :</th>
               <td>
                   <select id='loginInvitation' class="selectpicker show-tick form-control" name="loginInvitation">
                       <?php foreach ($invitations as $invitation): ?>
                       <option><?php echo $invitation->login; ?></option>
                       <?php endforeach; ?>
                    </select>
               </td>
           </tr>
        </table><br>
        <button id="btn-fiche" type="submit" class="btn btn-lg center">Accepter l'invitation</button>
    </form>
<?php else: ?>
    <strong>Vous n'avez reçu aucune demande d'ami.</strong>
<?php endif; ?>
            
<?php $this->includeTemplate('panelFin'); ?>
    


<?php $this->includeTemplate('panel', array('titre' => 'Envoyer une demande d\'ami')); ?>

<?php if (isset($erreur)): ?>
     <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
<?php endif ?>
<form action="<?php $this->bu('communaute', 'envoyerDemandeAmi') ?>" method="post">
    <table>
        <tr>
            <th>Sélectionner un login :</th>
            <td>
                <select id='login' class="selectpicker show-tick form-control" name="login">
                    <?php foreach ($users as $unUser): ?>
                    <?php if ($unUser->login != $userLogin && $unUser->admin != 1): ?>
                    <option><?php echo $unUser->login; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table><br>
    <button id="btn-fiche" type="submit" class="btn btn-lg center">Envoyer l'invitation</button>
</form>
             
<?php $this->includeTemplate('panelFin'); ?>