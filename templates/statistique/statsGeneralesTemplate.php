<table>
    <tr>
        <th>Nombre de parties :</th>
        <td>
            <?php
            if ($nombrePartiesJouees == NULL): echo "N/A";
            else: echo $nombrePartiesJouees[0]->nombre_parties_jouees;
            endif;
            ?>
        </td>
    </tr>
    <tr>
        <th>Nombre de parties en cours :</th>
        <td>
            <?php
            if ($nombrePartiesEnCours == NULL): echo "N/A";
            else: echo $nombrePartiesEnCours[0]->nombre_parties_en_cours;
            endif;
            ?>
        </td>
    <tr>
        <th>Nombre de parties terminées :</th>
        <td>
            <?php
            if ($nombrePartiesTerminees == NULL): echo "N/A";
            else: echo $nombrePartiesTerminees[0]->nombre_parties_terminees;
            endif;
            ?>
        </td>
    </tr>
    <tr>
        <th>Map la plus utilisée :</th>
        <td>
            <?php
            echo ($nombrePartiesAvecMapStarWars >= $nombrePartiesAvecMapPokemon) ? "Map Star Wars" : "Map Pokemon"
            ?>
        </td>
    </tr>
    <tr>
        <th>Nombre moyen de joueurs par partie :</th>
        <td>
            <?php
            if ($nombreMoyenJoueursParPartie == NULL): echo "N/A";
            else: echo $nombreMoyenJoueursParPartie;
            endif;
            ?>
        </td>
    </tr>
    <tr>
        <th>Nombre moyen de jokers utilisés par partie :</th>
        <td>
            <?php
            if ($nombreMoyenJokersByPartie == NULL): echo "N/A";
            else : echo $nombreMoyenJokersByPartie;
            endif;
            ?>
        </td>
    </tr>
</table>