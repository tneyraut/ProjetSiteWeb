<section class="panel panel-default content resultats">
    <div class="panel-heading">
        <h2 class="panel-title">Erreur</h2>
    </div>
    <div class="bord-panel">
        <div class="panel-body">
            <div class="repeat-background ">


<p style="text-align:center; margin-bottom:0; font-size: 20px; font-weight: bold">
    <?php echo $erreur ?><br><br>
    <a id="btn-retour-partie" class="btn btn-lg center" href="<?php $this->bu('partie', 'plateau', array($partie_id)) ?>">Retour à la partie</a>
</p>

<?php $this->includeTemplate('panelFin') ?>