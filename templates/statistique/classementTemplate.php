<table id="tableau" class="table table-striped table-bordered table-condensed">  
    <thead>
        <tr> 
            <th>Pseudo </th> 
            <th>Parties jouées </th> 
            <th>Parties gagnées </th> 
            <th>Parties perdues </th>
            <th>Ratio Victoire/Défaite </th>
            <th>Meilleur score</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($classement as $user): ?>
            <tr> 
                <td> <?php echo $user->login; ?> </td> 
                <td> <?php echo $user->nombre_parties_jouees; ?> </td> 
                <td> <?php echo $user->nombre_parties_gagnees; ?> </td> 
                <td> <?php echo $user->nombre_parties_perdues; ?> </td> 
                <td> <?php echo $user->ratio; ?> </td> 
                <td> <?php echo $user->meilleur_score; ?> </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>