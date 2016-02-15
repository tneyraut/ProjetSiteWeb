<?php $this->includeTemplate('panel', array('titre' => 'Vos Parties en cours de création')); ?>

<?php if (count($partiesEnCoursCreation) == 0): ?>
    <strong>Vous n'avez aucune partie en cours de création</strong>
<?php else: ?>

    <?php foreach ($partiesEnCoursCreation as $partie): ?>
        <br><br><br>
        <div class="row">
           <div class="col-md-6">
                <strong>
                    Nom : <?php echo $partie->nom; ?><br>
                    Créateur : <?php echo $partie->createur; ?><br>
                </strong>
            </div>
            <div class="col-md-1">
                <a id="btn-rejoindre-la-partie" class="btn btn-lg center" href="<?php $this->bu('gestionParties', 'salleAttente', array($partie->partie_id)) ?>" role="button">Détails de la Partie</a>
            </div>
        </div>

    <?php endforeach ?>
    <br><br><br>

<?php endif ?>

<?php $this->includeTemplate('panelFin'); ?>