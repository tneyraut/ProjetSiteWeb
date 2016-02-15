<?php $this->includeTemplate('panel', array('titre' => 'Liste des Parties Publiques')); ?>

<?php if (count($parties) == 0): ?>
    <strong>Il n'y a aucune partie publique pour le moment</strong>
<?php else: ?>

    <?php foreach ($parties as $partie): ?>
        <strong>
            Créateur : <?php echo $partie->login; ?><br>
            Nombre de joueurs maximum : <?php echo $partie->nombre_max_joueurs; ?><br>
        </strong>
        <a class="btn btn-primary btn-lg center" href="<?php $this->bu('gestionParties', 'salleAttente', array($partie->partie_id)) ?>">Rejoindre la partie</a>
    <?php endforeach ?>

<?php endif ?>
<?php $this->includeTemplate('panelFin'); ?>
