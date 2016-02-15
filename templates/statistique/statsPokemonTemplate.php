<table>
    <tr>
        <th>Nombre de parties :</th>
        <td>
            <?php if ($nombrePartiesAvecMapPokemon == NULL): echo "N/A";
            else: echo $nombrePartiesAvecMapPokemon;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre de parties en cours :</th>
        <td>
            <?php if ($nombrePartiesEnCoursMapPokemon == NULL): echo "N/A";
            else: echo $nombrePartiesEnCoursMapPokemon;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre de parties terminées :</th>
        <td>
            <?php if ($nombrePartiesTermineesMapPokemon == NULL): echo "N/A";
            else: echo $nombrePartiesTermineesMapPokemon;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre moyen de joueurs par partie :</th>
        <td>
            <?php if ($nombreMoyenJoueursParPartiePokemon == NULL): echo "N/A";
            else: echo $nombreMoyenJoueursParPartiePokemon;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre moyen de jokers utilisés par partie :</th>
        <td>
            <?php if ($nombreMoyenJokersByPartiePokemon == NULL): echo "N/A";
            else: echo $nombreMoyenJokersByPartiePokemon;
            endif; ?>
        </td>
    </tr>
</table><br><br>

<strong>Classement des cartes destinations les plus jouées :</strong><br><br>
    <?php if ($cartesDestinationPlusUtiliseesPokemon == NULL): echo "N/A"; ?>
    <?php else: ?>
    <table id="cartesDestinationPokemonPlusUtilisees" class="table table-striped table-bordered table-condensed">  
        <thead>
            <tr> 
                <th>Ville 1</th> 
                <th>Ville 2</th> 
                <th>Nombre de points</th>
                <th>Nombre d'utilisations</th>
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($cartesDestinationPlusUtiliseesPokemon as $carte): ?>
                <tr> 
                    <td><?php echo $carte->ville1; ?></td>
                    <td><?php echo $carte->ville2; ?></td>
                    <td><?php echo $carte->nombre_points; ?></td>
                    <td><?php echo $carte->nombreUtilisations; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif; ?><br><br>

<strong>Classement des cartes destinations les plus réussies :</strong><br><br>
<?php if ($cartesDestinationPlusReussiesPokemon == NULL): echo "N/A"; ?>
<?php else: ?>
    <table id="cartesDestinationPokemonPlusReussies" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>Ville 1</th> 
                <th>Ville 2</th> 
                <th>Nombre de points</th>
                <th>Nombre d'utilisations réussies</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartesDestinationPlusReussiesPokemon as $carte): ?>
                <tr>
                    <td><?php echo $carte->ville1; ?></td>
                    <td><?php echo $carte->ville2; ?></td>
                    <td><?php echo $carte->nombre_points; ?></td>
                    <td><?php echo $carte->nombreUtilisations; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?><br><br>

<strong>Classement des villes les plus reliées :</strong><br><br>
<?php if ($villesPlusUtiliseesPokemon == array()): echo "N/A"; ?>
<?php else: ?>
    <table id="tableauVillesPokemon" class="table table-striped table-bordered table-condensed">  
        <thead>
            <tr> 
                <th>Ville</th> 
                <th>Nombre de prise de possesion</th> 
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($villesPlusUtiliseesPokemon as $nom => $nb): ?>
                <tr> 
                    <td> <?php echo $nom; ?> </td>
                    <td> <?php echo $nb; ?> </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif; ?><br><br>