<?php $this->includeTemplate('panel', array('titre' => 'Règles du Jeu')); ?>

Backpackers Space est un jeu de plateau se jouant de 2 à 5 joueurs.<br>
Le plateau se compose de deux éléments : des villes (ou planètes) et des routes reliants les villes entre elles.
<br><br>
L'objectif de chaque joueur est de marquer le maximum de points.
Pour cela, les joueurs devront prendre possesion de routes reliant deux villes entre elles. 
Chaque prise de contrôle d'une route leur rapportera des points. 
Pour réaliser ses prises de contrôle, les joueurs sont munis de cartes "wagon" de couleurs.

<table>
    <tr>
        <th>Blanc</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_blanc.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_blanc.png" /></td>
    </tr>
    <tr>
        <th>Bleu</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_bleu.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_bleu.png" /></td>
    </tr>
    <tr>
        <th>Jaune</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_jaune.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_jaune.png" /></td>
    </tr>
    <tr>
        <th>Noir</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_noir.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_noir.png" /></td>
    </tr>
    <tr>
        <th>Orange</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_orange.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_orange.png" /></td>
    </tr>
    <tr>
        <th>Rose</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_rose.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_rose.png" /></td>
    </tr>
    <tr>
        <th>Vert</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_vert.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_vert.png" /></td>
    </tr>
    <tr>
        <th>Violet</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/wagon_violet.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/wagon_violet.png" /></td>
    </tr>
    <tr>
        <th>Joker</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/locomotive.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/locomotive.png" /></td>
    </tr>
</table>

Afin de prendre possesion d'une route, un joueurs devra donc posséder un nombre suffisant de cartes de la bonne couleur.
<br><br>
Tous les joueurs seront aussi munis de cartes destinations. 
Ces cartes leur indiquent une quête à réaliser (ralier deux villes entre elles par l'intermédiare d'un certain nombre de routes). 
Si un joueur parviens à compléter certaines de ses quêtes, il marquera des points supplémentaires. 
Des malus seront attribués aux joueurs n'ayant pas rempli l'intégralité de leurs quêtes.
Enfin, le joueur ayant réalisé le plus grand réseau de routes gagnera des points bonus.
<br><br>
Au début d'une partie chaque joueur démarre muni de cinq cartes "wagon", ainsi que de cinq cartes destinations.
Chacun des joueurs devra dans un premier temps choisir deux cartes destinations à conserver.
Durant son tour, un joueur peut soit :<br>
<table>
    <tr>
        <th>Prendre possesion d'une route</th>
    </tr>
    <tr>
        <th>Piocher deux cartes "Wagon" parmis les cinq découvertes ou dans la pioche (Attention, un seul joker peut-être récupéré par tour)</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/pioche.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/pioche.png" /></td>
    </tr>
    <tr>
        <th>Piocher trois cartes destination et en conserver au moins une</th>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/starwars/carte_destination.png" /></td>
        <td><image class="carteRegle" src="<?php $this->bu() ?>images/cartes/pokemon/carte_destination.png" /></td>
    </tr>
</table>
<br><br>    

Il existe au total à l'heure actuelle, deux map jouables sur le site que voici

<table>
    <tr>
        <th>Il existe au total à l'heure actuelle, deux map jouables sur le site que voici</th>
    </tr>
    <tr>
        <th><image src="<?php $this->bu() ?>images/cartes/starwars/map.png" /></th>
    </tr>
    <tr>
        <th><image src="<?php $this->bu() ?>images/cartes/pokemon/map.png" /></th>
    </tr>
</table>

<?php $this->includeTemplate('panelFin') ?>