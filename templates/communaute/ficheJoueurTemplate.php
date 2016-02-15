<?php $this->includeTemplate('panel', array('titre' => 'Fiche publique de '.$joueur->login)); ?>

<br>

<strong style="font-size:15px; margin-left:10%;">Login : </strong><?php echo $joueur->login; ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Nombre de victoire(s) : </strong> <?php echo $joueur->nombre_parties_gagnees ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Nombre de défaite(s) : </strong><?php echo $joueur->nombre_parties_perdues ?><br><br><br>

<strong style="font-size:15px; margin-left:10%;">Nationalité : </strong><?php echo $joueur->nationalite != NULL ? $joueur->nationalite : ($joueur->login . " n'a pas souhaité divulguer cette information") ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Sexe : </strong><?php echo $joueur->sexe != NULL ? $joueur->sexe : ($joueur->login . " n'a pas souhaité divulguer cette information") ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Age : </strong><?php echo $joueur->age != 0 ? ($joueur->age . " ans") : ($joueur->login . " n'a pas souhaité divulguer cette information") ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Ville de naissance : </strong><?php echo $joueur->ville_de_naissance != NULL ? $joueur->ville_de_naissance : ($joueur->login . " n'a pas souhaité divulguer cette information") ?><br><br><br><br><br>

<form action="<?php $this->bu('communaute', 'rechercheFicheJoueurParLogin') ?>" method="post">
    <table>
        <tr>
            <th>Liste des logins :</th>
            <td>
                <select id='loginJoueur' class="selectpicker show-tick form-control" name="loginJoueur">
                    <?php foreach ($listeUser as $unUser): if ($unUser->admin != 1): ?>
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
        
<?php $this->includeTemplate('panelFin'); ?>