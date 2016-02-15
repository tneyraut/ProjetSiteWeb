<?php $this->includeTemplate('panel', array('titre' => 'Recherche : Fiche publique d\'un joueur')); ?>

<form action="<?php $this->bu('communaute', 'rechercheFicheJoueurParLogin') ?>" method="post">
    <table>
        <tr>
            <th>Liste des logins :</th>
            <td>
                <select id='loginJoueur' class="selectpicker show-tick form-control" name="loginJoueur">
                    <?php foreach($listeUser as $unUser): if($unUser->admin != 1): ?>
                        <option><?php echo $unUser->login; ?></option>
                    <?php endif;
                    endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Login du joueur recherché :</th>
            <td><input type="text" placeholder="Joueur recherché" name="loginFicheJoueur" class="input-control form-control" /></td>
        </tr>
    </table><br>
    <button id="btn-rechercher" type="submit" class="btn btn-lg center">Rechercher</button>
</form>

<?php if(isset($erreur)): ?>
    <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
<?php endif ?>

<?php $this->includeTemplate('panelFin'); ?>