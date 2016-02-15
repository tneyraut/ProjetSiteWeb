<?php $this->includeTemplate('panel', array('titre' => 'Inscription')); 

if (isset($inscErrorText))
    echo '<span class="error">' . $inscErrorText . '</span>';
?>

<form action="<?php $this->bu('accueil', 'validateInscription') ?>" method="post">

    <div class="form-group <?php if (isset($inscErrorLogin)) echo 'has-error'; else if (isset($inscLogin)) echo 'has-success'; ?>">
        <div class="row">
            <label for="login" class="required">Identifiant</label>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <input id="login" type="text" name="inscLogin" class="input-control form-control" />
                <?php if (isset($inscErrorLogin)) echo '<span class="icone glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>' ?>
                <?php if (isset($inscLogin)) echo '<span class="icone glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>' ?>
            </div>
            <div class="col-sm-5 texteErreur">
                <?php if (isset($inscErrorLogin)) echo '<span class="error">' . $inscErrorLogin . '</span>'; ?>
            </div>
        </div>
    </div>

    <div class="form-group <?php if (isset($inscErrorPassword)) echo 'has-error'; else if (isset($inscPassword)) echo 'has-success'; ?>">
        <div class="row">
            <label for="password" class="required">Mot de Passe</label>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <input id="password" type="password" name="inscPassword" class="input-control form-control" />
                <?php if (isset($inscErrorPassword)) echo '<span class="icone glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>' ?>
                <?php if (isset($inscPassword)) echo '<span class="icone glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>' ?>
            </div>
            <div class="col-sm-5 texteErreur">
                <?php if (isset($inscErrorPassword)) echo '<span class="error">' . $inscErrorPassword . '</span>'; ?>
            </div>
        </div>
    </div>

    <div class="form-group <?php if (isset($inscErrorPrenom)) echo 'has-error'; else if (isset($inscPrenom)) echo 'has-success'; ?>">    
        <div class="row">
            <label for="prenom" class="required">Prénom</label>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <input id= "prenom" type="text" name="inscPrenom" class="input-control form-control" />
                <?php if (isset($inscErrorPrenom)) echo '<span class="icone glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>' ?>
                <?php if (isset($inscNom)) echo '<span class="icone glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>' ?>
            </div>
            <div class="col-sm-5 texteErreur">
                <?php if (isset($inscErrorPrenom)) echo '<span class="error">' . $inscErrorPrenom . '</span>'; ?>
            </div>
        </div>
    </div>

    <div class="form-group <?php if (isset($inscErrorNom)) echo 'has-error'; else if (isset($inscNom)) echo 'has-success'; ?>">
        <div class="row">
            <label for="nom" class="required">Nom</label>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <input id="nom" type="text" name="inscNom" class="input-control form-control" />
                <?php if (isset($inscErrorNom)) echo '<span class="icone glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>' ?>
                <?php if (isset($inscNom)) echo '<span class="icone glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>' ?>
            </div>
            <div class="col-sm-5 texteErreur">
                <?php if (isset($inscErrorNom)) echo '<span class="error">' . $inscErrorNom . '</span>'; ?>
            </div>
        </div>
    </div>

    <div class="form-group <?php if (isset($inscErrorMail)) echo 'has-error'; else if (isset($inscMail)) echo 'has-success'; ?>">
        <div class="row">
            <label for="mail" class="required">E-Mail</label>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <input id="mail" type="email" name="inscMail" class="input-control form-control" />
                <?php if (isset($inscErrorMail)) echo '<span class="icone glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>' ?>
                <?php if (isset($inscMail)) echo '<span class="icone glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>' ?>
            </div>
            <div class="col-sm-5 texteErreur">
                <?php if (isset($inscErrorMail)) echo '<span class="error">' . $inscErrorMail . '</span>'; ?>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-lg">Creer mon compte...</button>

</form>
<?php $this->includeTemplate('panelFin'); ?>

