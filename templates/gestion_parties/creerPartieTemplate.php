<?php $this->includeTemplate('panel', array('titre' => 'Créer une Partie')); ?>

<div class="panel-body">
    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
    <?php endif ?>
    <form action="<?php $this->bu('gestionParties', 'creerPartie') ?>" method="post">
        <table>
            <tr>
                <th class="required">Nom de la partie</th>
                <td><input type="text" class="input-control form-control" name="nom"></td>
            </tr>
            <tr>
                <th class="required">Nombre de joueurs maximum</th>
                <td>
                    <select id='nombreJoueur' class="selectpicker show-tick form-control" name="nombreJoueurs">
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="required">Type de map</th>
                <td>
                    <select id='typeMap' class="selectpicker show-tick form-control" name="map">
                        <option value='star wars'>Star Wars</option>
                        <option value='pokemon'>Pokemon</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="required">Partie publique</th>
                <td>
                    <select id='partiePublique' class="selectpicker show-tick form-control" name="publique">
                        <option value='Oui'>Oui</option>
                        <option value='Non'>Non</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Invité N°1</th>
                <td><input type="text" placeholder="login" class="input-control form-control" name="invite1"></td>
            </tr>
            <tr>
                <th>Invité N°2</th>
                <td><input type="text" placeholder="login" class="input-control form-control" name="invite2"></td>
            </tr>
            <tr>
                <th>Invité N°3</th>
                <td><input type="text" placeholder="login" class="input-control form-control" name="invite3"></td>
            </tr>
            <tr>
                <th>Invité N°4</th>
                <td><input type="text" placeholder="login" class="input-control form-control" name="invite4"></td>
            </tr>
        </table>
        <button id="btn-creer-la-partie" type="submit" class="btn btn-lg center">Créer la partie</button>
    </form>
    <?php $this->includeTemplate('panelFin'); ?>