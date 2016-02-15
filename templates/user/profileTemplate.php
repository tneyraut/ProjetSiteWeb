<?php $this->includeTemplate('panel', array('titre' => 'Profil')); ?>

<br>

<strong style="font-size:15px; margin-left:10%;">Login : </strong ><?php echo $joueur->login; ?> <a href="<?php $this->bu('user', 'updateProfile') ?>" style="text-decoration: underline;font-size: 18px;color:#cc0000; float:right; margin-left:5%;">Modifier mon profil</a><br><br>

<strong style="font-size:15px; margin-left:10%;">Nombre de victoire(s) : </strong> <?php echo $joueur->nombre_parties_gagnees ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Nombre de défaite(s) : </strong><?php echo $joueur->nombre_parties_perdues ?><br><br><br>

<strong style="font-size:15px; margin-left:10%;">Nationalité : </strong><?php echo $joueur->nationalite != NULL ? $joueur->nationalite : ("Vous n'avez pas souhaité divulguer cette information") ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Sexe : </strong><?php echo $joueur->sexe != NULL ? $joueur->sexe : ("Vous n'avez pas souhaité divulguer cette information") ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Age : </strong><?php echo $joueur->age != 0 ? ($joueur->age . " ans") : ("Vous n'avez pas souhaité divulguer cette information") ?><br><br>

<strong style="font-size:15px; margin-left:10%;">Ville de naissance : </strong><?php echo $joueur->ville_de_naissance != NULL ? $joueur->ville_de_naissance : ("Vous n'avez pas souhaité divulguer cette information") ?><br><br>

<?php $this->includeTemplate('panelFin'); ?>

<?php $this->includeTemplate('panel', array('titre' => 'Mes parties terminées')); ?>

<?php if (count($partiesTerminees) == 0): ?>
    <strong>Vous n'avez fait encore aucune partie</strong>
<?php else: ?>

    <?php foreach ($partiesTerminees as $partie): ?>
        <br><br><br>
        <div class="row">
            <div class="col-md-6">
                <strong>
                    Nom : <?php echo $partie->nom; ?><br>
                    Créateur : <?php echo $partie->createur; ?><br>
                </strong>
            </div>
            <div class="col-md-1">
                <a id="btn-rejoindre-la-partie" class="btn btn-lg center" href="<?php $this->bu('partie', 'resultats', array($partie->partie_id)) ?>" role="button">Résultats</a>
            </div>
        </div>

    <?php endforeach ?>
    <br><br><br>

<?php endif ?>
<?php $this->includeTemplate('panelFin'); ?>