<script type="text/javascript" src="<?php $this->bu() ?>js/classes.js"></script>
<script type="text/javascript" src="<?php $this->bu() ?>js/map.js"></script>

<section class="panel panel-default content choix-cartes">
    <div class="panel-heading">
        <h2 class="panel-title">Choix Cartes destination</h2>
    </div>
    <div class="bord-panel">
        <div class="panel-body">
            <div class="repeat-background">


<p style="font-size: 20px; font-weight: bold">Veuillez choisir les cartes que vous voulez conserver (minimum: <?php echo $nbMin ?>) :</p>
<br>
<form method="post" action="<?php $this->bu('partie', 'choisirCarteDestination', array($partie_id)) ?>">
    <table>
        <tr>
            <?php foreach ($cartes as $carte): ?>
                <td style="text-align: center">
                    <div class="carte carte_destination" style="background-image: url('<?php $this->bu(); echo $map->image_fond_carte_destination ?>')">
                        <label for="<?php echo $carte->carte_destination_id ?>" class="carte_destination_text">
                            <?php echo $carte->ville1 ?>
                            <br> - <br>
                            <?php echo $carte->ville2 ?><br>
                            <?php echo $carte->nombre_points ?> points
                        </label>
                    </div>
                </td>
            <?php endforeach ?>
        </tr>
        <tr>
            <?php foreach ($cartes as $carte): ?>
                <td style="text-align: center">
                    <input id="<?php echo $carte->carte_destination_id ?>" type="checkbox" name="cartes[]" value="<?php echo $carte->carte_destination_id ?>">
                </td>
            <?php endforeach ?>
        </tr>
    </table>
    <button id="btn-sauvegarder-modif" type="submit" class="btn btn-lg center">Valider</button>
</form>
<br>

<svg id="map" viewBox="0 0 1500 900" xmlns="http://www.w3.org/2000/svg">
    <image xlink:href="<?php
    $this->bu();
    echo $map->image
    ?>" x="0" y="0" height="900px" width="1500px"/>
</svg>

<?php $this->includeTemplate('panelFin') ?>
