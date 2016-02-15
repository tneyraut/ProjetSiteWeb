<?php if(isset($user) && $user->admin == 1): ?>
<nav id ="navigateuradmin" class="navbar navbar-inverse collapse navbar-collapse navbar-ex1-collapse " role="navigation">
<?php elseif(isset($user) && $user->admin != 1):?>
<nav id="navigateuruser" class="navbar navbar-inverse collapse navbar-collapse navbar-ex1-collapse" role="navigation">
<?php else:?>
<nav id="navigateuranonymous" class="navbar navbar-inverse collapse navbar-collapse navbar-ex1-collapse " role="navigation">
<?php endif ?>
 <!-- navbar-fixed-top -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a class="navbar-brand" href="<?php $this->bu('accueil') ?>">Accueil</a></li>
            <?php if(isset($user) && $user->admin != 1): ?>
                <li><a class="navbar-brand" href="<?php $this->bu('gestionParties', 'creer') ?>">Création de partie</a></li>
                <li><a class="navbar-brand" href="<?php $this->bu('gestionParties') ?>">Rejoindre une partie</a></li>
                <li><a class="navbar-brand" href="<?php $this->bu('communaute') ?>">Communauté</a></li>
            <?php endif ?>
            <?php if (isset($user) && $user->admin == 1): ?>
                <li><a class="navbar-brand" href="<?php $this->bu('admin') ?>">Gestion des utilisateurs</a></li>
            <?php endif; ?>
            <li><a class="navbar-brand" href="<?php $this->bu('accueil', 'regleDuJeu') ?>">Règles du jeu</a></li>
            <li><a class="navbar-brand" href="<?php $this->bu('statistique') ?>">Statistiques</a></li>
            <?php if(isset($user)): ?>
                <li><a class="navbar-brand" href="<?php $this->bu('user', 'deconnecter') ?>">Déconnexion</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>