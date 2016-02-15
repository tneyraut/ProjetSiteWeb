<?php $this->includeTemplate('panel', array('titre' => 'Règles du Jeu')); ?>


<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#butDuJeu" aria-controls="butDuJeu" role="tab" data-toggle="tab">But du jeu</a></li>
        <li role="presentation"><a href="#debutDeJeu" aria-controls="debutDeJeu" role="tab" data-toggle="tab">Début de jeu</a></li>
        <li role="presentation"><a href="#tourDeJeu" aria-controls="tourDeJeu" role="tab" data-toggle="tab">Tour de jeu</a></li>
        <li role="presentation"><a href="#finDeJeu" aria-controls="finDeJeu" role="tab" data-toggle="tab">Fin du jeu</a></li>
    </ul>
     <br><br>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="butDuJeu">
            <?php $this->includeTemplate('regles/butDuJeu') ?>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="debutDeJeu">
             <?php $this->includeTemplate('regles/debutDeJeu') ?>
        </div>
        
        <div role="tabpanel" class="tab-pane fade" id="tourDeJeu">
             <?php $this->includeTemplate('regles/tourDeJeu') ?>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="finDeJeu">
            <?php $this->includeTemplate('regles/finDeJeu') ?>
        </div>
    </div>
</div>

<?php $this->includeTemplate('panelFin') ?>