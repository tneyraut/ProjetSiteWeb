<table>
    <tr>
        <th>Nombre de parties :</th>
        <td>
            <?php if ($nombrePartiesAvecMapStarWars == NULL): echo "N/A";
            else: echo $nombrePartiesAvecMapStarWars;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre de parties en cours :</th>
        <td>
            <?php if ($nombrePartiesEnCoursMapStarWars == NULL): echo "N/A";
            else: echo $nombrePartiesEnCoursMapStarWars;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre de parties terminées :</th>
        <td>
            <?php if ($nombrePartiesTermineesMapStarWars == NULL): echo "N/A";
            else: echo $nombrePartiesTermineesMapStarWars;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre moyen de joueurs par partie :</th>
        <td>
            <?php if ($nombreMoyenJoueursParPartieStarWars == NULL): echo "N/A";
            else: echo $nombreMoyenJoueursParPartieStarWars;
            endif; ?>
        </td>
    </tr>
    <tr>
        <th>Nombre moyen de jokers utilisés par partie :</th>
        <td>
            <?php if ($nombreMoyenJokersByPartieStarWars == NULL): echo "N/A";
            else: echo $nombreMoyenJokersByPartieStarWars;
            endif; ?>
        </td>
    </tr>
</table><br><br>

<strong>Classement des cartes destinations les plus jouées :</strong><br><br>
<?php if ($cartesDestinationPlusUtiliseesStarWars == NULL): echo "N/A"; ?>
<?php else: ?>
    <table id="cartesDestinationStarWarsPlusUtilisees" class="table table-striped table-bordered table-condensed">  
        <thead>
            <tr> 
                <th>Ville 1</th> 
                <th>Ville 2</th> 
                <th>Nombre de points</th>
                <th>Nombre d'utilisations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartesDestinationPlusUtiliseesStarWars as $carte): ?>
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
<?php if ($cartesDestinationPlusReussiesStarWars == NULL): echo "N/A"; ?>
<?php else: ?>
    <table id="cartesDestinationStarWarsPlusReussies" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>Ville 1</th> 
                <th>Ville 2</th> 
                <th>Nombre de points</th>
                <th>Nombre d'utilisations réussies</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartesDestinationPlusReussiesStarWars as $carte): ?>
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
<?php if ($villesPlusUtiliseesStarWars == NULL): echo "N/A"; ?>
<?php else: ?>
    <table id="tableauVillesStarWars" class="table table-striped table-bordered table-condensed">  
        <thead>
            <tr> 
                <th>Ville</th> 
                <th>Nombre de prise de possesion</th> 
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($villesPlusUtiliseesStarWars as $nom => $nb): ?>
                <tr> 
                    <td> <?php echo $nom; ?> </td>
                    <td> <?php echo $nb; ?> </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif; ?><br><br>