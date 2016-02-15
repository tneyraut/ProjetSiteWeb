<?php $this->includeTemplate('panel', array('titre' => 'Choix de la couleur')) ?>

<p style="font-size: 20px; font-weight: bold">Veuillez choisir la couleur avec laquelle construire cette route :</p>
<div class="row">
    <?php foreach($possibilites as $carte): ?>
        <p class="col-md-2">
            <a href="<?php $this->bu('partie', 'construireRoute', array($partie_id, $route_id, $carte->type)) ?>">
                <img src="<?php $this->bu(); echo $carte->image ?>" alt="cart" width="100%" />
            </a>
        </p>
    <?php endforeach ?>
</div>

<?php $this->includeTemplate('panelFin') ?>