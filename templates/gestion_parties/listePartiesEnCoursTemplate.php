<?php $this->includeTemplate('panel', array('titre' => 'Vos Parties en cours de déroulement')) ?>

<?php if (count($partiesEnCours) == 0): ?>
    <strong>Vous n'avez aucune partie en cours</strong>
<?php else: ?>

    <?php foreach ($partiesEnCours as $partie): ?>
        <br><br><br>
        <div class="row">
            <div class="col-md-6">
                <strong>
                    Nom : <?php echo $partie->nom; ?><br>
                    Créateur : <?php echo $partie->createur; ?><br>
                </strong>
            </div>
            <div class="col-md-1">
                <a id="btn-rejoindre-la-partie" class="btn btn-lg center" href="<?php $this->bu('partie', 'plateau', array($partie->partie_id)) ?>" role="button">Rejoindre la partie</a>
            </div>
        </div>

    <?php endforeach ?>
    <br><br><br>

<?php endif ?>

<?php $this->includeTemplate('panelFin') ?>