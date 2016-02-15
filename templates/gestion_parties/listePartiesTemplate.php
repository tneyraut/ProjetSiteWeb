<?php $this->includeTemplate('panel', array('titre' => 'Liste des Parties Publiques')); ?>

<?php if (count($partiesPubliques) == 0): ?>
    <strong>Il n'y a aucune partie publique pour le moment</strong>
<?php else: ?>

    <?php foreach ($partiesPubliques as $partie): ?>
        <br><br><br>
        <div class="row">
            <div class="col-md-6">
                <strong>
                    Nom : <?php echo $partie->nom; ?><br>
                    Créateur : <?php echo $partie->createur; ?><br>
                </strong>
            </div>
            <div class="col-md-1">
                <a id="btn-rejoindre-partie-publique" class="btn btn-lg center" href="<?php $this->bu('gestionParties', 'salleAttente', array($partie->partie_id)) ?>">Détails de la Partie</a>

            </div>
        </div>
    <?php endforeach ?>
    <br><br><br>

<?php endif ?>
<?php $this->includeTemplate('panelFin'); ?>
