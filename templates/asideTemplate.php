<div id="rightDock">
    <?php if ($user === NULL): ?>   

        <aside id="panel-connexion" class="panel panel-default panel-connexion">
            <div class="panel-heading">
                <h2 class="panel-title">Connexion</h2>
            </div>
            <div class="bord-panel-bord">
                <div class="panel-body-bord">
                    <div class="repeat-background-bord">
                        <?php $this->includeTemplate('loginForm') ?>
                    </div>
                </div>
            </div>
        </aside>
    <?php else: ?>
        <aside id="panel-connexion" class="panel panel-default panel-connexion">
            <div class="panel-heading">
                <h2 class="panel-title">Connecté</h2>
            </div>
            <div class="bord-panel-bord">
                <div class="panel-body-bord">
                    <div class="repeat-background-bord" style="padding-left:10%;">
                        <p style="margin-bottom: 2.5%; font-size:20px;">Bonjour <?php echo $user->login ?>.</p>
                        <a href="<?php $this->bu('user', 'profile', array($user->user_id)) ?>" style="color:#cc0000; text-decoration:underline; font-size:17px;">Mon profil</a><br/>
                        <?php if ($user->admin != 1): ?>
                        <a href="<?php $this->bu('communaute', 'demandeAmi') ?>" style="color:#cc0000; text-decoration:underline; font-size:17px;">Mes amis</a><br/>
                        <a href="<?php $this->bu('user', 'message') ?>" style="color:#cc0000; text-decoration:underline; font-size:17px;">Messages</a><br><br>
                        <?php endif; ?>
                        <a href="<?php $this->bu('user', 'deconnecter')?>" style="color:#cc0000; text-decoration:underline; font-size:17px;">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </aside>
    <?php endif ?>

    <aside id="panel-pub" class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Publicité</h2>
        </div>
        <div class="bord-panel-bord">
            <div class="panel-body-bord">
                <div class="repeat-background-bord">
                    <?php $this->includeTemplate('publicites/' . rand(0,4)); ?>
                </div>
            </div>
        </div>
    </aside>
</div>