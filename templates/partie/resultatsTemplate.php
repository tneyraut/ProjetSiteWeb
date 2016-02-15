<section class="panel panel-default content resultats">
    <div class="panel-heading">
        <h2 class="panel-title">Résultats</h2>
    </div>
    <div class="bord-panel">
        <div class="panel-body">
            <div class="repeat-background">

    <?php if($gagnant): ?>
        <h1 style="text-align:center;">Bravo vous avez gagné avec un score de <?php echo $meilleursJoueurs[0]->score ?> !</h1>
    <?php else: ?>
        <?php if(count($meilleursJoueurs) == 1): ?>
            <h1 style="text-align:center;">Vous avez perdu, le gagnant est <?php echo $meilleursJoueurs[0]->login ?> avec un score de <?php echo $meilleursJoueurs[0]->score ?></h1>
        <?php else: ?>
            <h1 style="text-align:center;">
                Vous avez perdu, les gagnants sont <?php foreach($meilleursJoueurs as $joueur) { echo $joueur->login.' '; } ?> avec un score de <?php echo $meilleursJoueurs[0]->score ?>
            </h1>
        <?php endif ?>
    <?php endif ?>
        
            <br>
            <br>
            <p style="text-decoration: underline; text-align:center;font-size:23px;">Classement final</p>
            <br>
            
    <table style="margin-left: 30%; margin-bottom:0; width:40%;" class="table table-striped table-bordered table-condensed">
        <tr style= margin-bottom:2%;">
            <td><strong style="font-size: 18px; text-align: center;">Joueur</strong></td>
            <td><strong style="font-size: 18px; text-align: center;">Score</strong></td>
        
        </tr>
        
        <?php foreach($joueurs as $joueur): ?>
            <tr>
                <td><?php echo $joueur->login?> </td>
                <td><?php echo $joueur->score ?></td>
            </tr>
        <?php endforeach ?>
    </table>

<?php $this->includeTemplate('panelFin')?>