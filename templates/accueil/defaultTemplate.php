<?php $this->includeTemplate('panel', array('titre' => 'Actualités')); ?>

Félicitation à <strong><?php echo $users[0]->login; ?></strong>, qui est actuellement premier au classement avec 
<?php echo $users[0]->nombre_parties_gagnees; ?> victoires !<br>
Encore toutes nos félicitations !<br><br>

Attention cependant, <strong><?php echo $users[1]->login; ?></strong> n'est plus très loin avec
<?php echo $users[1]->nombre_parties_gagnees; ?> victoires !<br><br>

Nous souhaitons féliciter le no-life du site, <strong><?php echo $nombreDePartiesJouees[0]->login; ?></strong>, 
qui a joué un total de <?php echo $nombreDePartiesJouees[0]->nombre_parties_jouees; ?> parties !<br><br>

Félicitations spéciales à <strong><?php echo $ratios[0]->login; ?></strong>, qui possède le meilleur ratio de victoires : 
<?php echo $ratios[0]->ratio; ?>.<br><br>

<strong><?php echo $meilleuresScores[0]->login; ?></strong> détient actuellement le record du meilleure score 
sur une partie avec un total de <?php echo $meilleuresScores[0]->score; ?> points.<br><br>

Actuellement, le nombre de parties terminées et en cours s'élèvent à <?php echo $nombreParties; ?> parties, 
dont <?php echo $nombreDePartiesTerminees; ?> parties terminées et 
<?php echo $nombreDePartiesEnCours; ?> parties en cours.<br><br>

Merci à toute la communauté pour son activité sur le site et son soutien.<br>
Vous êtes à présent une communauté de <strong><?php echo $nombreDeJoueurs; ?></strong> joueurs !<br><br>

<?php $this->includeTemplate('panelFin'); ?>