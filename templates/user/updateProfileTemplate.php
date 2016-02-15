
<?php $this->includeTemplate('panel', array('titre' => 'Modification de profil'));
if (isset($erreur)):
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
<?php endif ?>

<form action="<?php $this->bu('user', 'modifierProfil'); ?>" method="post">
    <table>
        <tr><th><h4><strong>Modification de votre login</strong></h4></th></tr>
        <tr>
            <th>Login :</th>
            <td><input type="text" placeholder="nouveau login" class="input-control form-control" name="login"></td>
        </tr>
        <tr><th><h4><strong>Modification de votre mot de passe</strong></h4></th></tr>
        <tr>
            <th>Ancien mot de passe :</th>
            <td><input type="password" placeholder="ancien mot de passe" class="input-control form-control" name="ancienPassword"></td>
        </tr>
        <tr>
            <th>Nouveau mot de passe :</th>
            <td><input type="password" placeholder="nouveau mot de passe" class="input-control form-control" name="password"></td>
        </tr>
        <tr>
            <th>Confirmation :</th>
            <td><input type="password" placeholder="confirmation du mot de passe" class="input-control form-control" name="passwordConfirmation"></td>
        </tr>
        <tr><th><h4><strong>Données Personnelles</strong></h4></th></tr>
        <tr>
            <th>Nationalité :</th>
            <td><input type="text" placeholder="nationalité" class="input-control form-control" name="nationalite"></td>
        </tr>
        <tr>
            <th>Sexe :</th>
            <td>
                <select id='sexe' class="selectpicker show-tick form-control" name="sexe">
                    <option value='homme'>Homme</option>
                    <option value='femme'>Femme</option>
                    <option value='autre'>Autre</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Age :</th>
            <td><input type="text" placeholder="âge" class="input-control form-control" name="age"></td>
        </tr>
        <tr>
            <th>Ville de naissance :</th>
            <td><input type="text" placeholder="ville de naissance" class="input-control form-control" name="ville_de_naissance"></td>
        </tr>
    </table>
    <button id="btn-sauvegarder-modif" type="submit" class="btn btn-lg center">Sauvegarder les modifications</button>
</form>
<?php $this->includeTemplate('panelFin');?>