<?php $this->includeTemplate('panel', array('titre' => 'Supprimer un user')); ?>

<?php if (isset($erreur)): ?>
    <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
<?php endif ?>

<form action="<?php $this->bu('admin', 'supprimerUser') ?>" method="post">
    <table>
        <tr>
            <th>Sélectionner un login :</th>
            <td>
                <select id='login' class="selectpicker show-tick form-control" name="login">
                    <?php foreach ($users as $unUser): if ($unUser->login != $user->login): ?>
                        <option><?php echo $unUser->login; ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Login du User à supprimer :</th>
            <td><input type="text" placeholder="Login de l'utilisateur à supprimer" class="input-control form-control" name="loginUser"></td>
        </tr>
    </table><br>
    <button id="btn-creer-la-partie" type="submit" class="btn btn-lg center">Supprimer le User</button>
</form>
    
<?php $this->includeTemplate('panelFin'); ?>
    
<?php $this->includeTemplate('panel', array('titre' => 'Ajouter un administrateur')); ?>

<form action="<?php $this->bu('admin', 'ajouterAdmin') ?>" method="post">
    <input type="text" placeholder="login" class="input-control form-control" style="width: 60%; margin-left:20%;" name="login"><br>
    <input type="password" placeholder="password" class="input-control form-control" style="width: 60%; margin-left:20%;" name="password"><br>
    <button id="btn-creer-la-partie" type="submit" class="btn btn-lg center">Ajouter Administrateur</button>
</form>
    
<?php $this->includeTemplate('panelFin'); ?>