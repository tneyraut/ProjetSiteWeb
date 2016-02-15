<?php $this->includeTemplate('panel'); ?>
<strong>
    Nom : <?php echo $partie->nom; ?><br>
    Créateur : <?php echo $partie->createur ?><br>
    Nombre de joueurs maximum : <?php echo $partie->nombre_max_joueurs; ?><br>
    Type de la map : <?php echo $partie->map; ?><br>
    Partie publique : <?php echo $partie->publique ? "Oui" : "Non"; ?><br>
    Joueurs ayant rejoint la partie : <br>
    <ul>
        <?php foreach ($participants as $participant): ?>
            <li><?php echo $participant->login ?></li>
        <?php endforeach ?>
    </ul>
</strong>

<?php if ($partie->etat != 0 && $partie->etat != 4): ?>
    <a id ="btn-rejoindre" class="btn btn-lg center" href="<?php $this->bu('partie', 'plateau', array($partie->partie_id)) ?>">Rejoindre</a>
<?php else: ?>
    <?php if ($user->user_id == $partie->createur_id): ?>
        <a id ="btn-lancer-partie" class="btn btn-lg center" href="<?php $this->bu('partie', 'demarrer', array($partie->partie_id)) ?>">Lancer la partie</a>
    <?php elseif ($estParticipant): ?>
        <a id ="btn-ne-plus-participer" class="btn btn-lg center" href="<?php $this->bu('gestionParties', 'nePlusParticiper', array($partie->partie_id)) ?>">Ne plus participer</a>
    <?php else: ?>
        <a id ="btn-participer" class="btn btn-lg center" href="<?php $this->bu('gestionParties', 'participer', array($partie->partie_id)) ?>">Participer</a>
    <?php endif ?>
<?php endif;
$this->includeTemplate('panelFin'); ?>