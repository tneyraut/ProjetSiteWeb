<?php

class StatistiqueController extends Controller {

    public function defaultAction() {
        $classement = User::getClassementPartiesGagneesDesc();

        $nombrePartiesJouees = Partie::getNombrePartiesJouees();
        $nombrePartiesEnCours = Partie::getNombrePartiesEnCours();
        $nombrePartiesTerminees = Partie::getNombrePartiesTerminees();
        $nombrePartiesAvecMapStarWars = Partie::getNombrePartiesByMapId(1);
        $nombrePartiesAvecMapPokemon = Partie::getNombrePartiesByMapId(2);
        $nombreMoyenJoueursParPartie = Partie::getNombreJoueursMoyenParPartie();
        $nombrePartiesEnCoursMapStarWars = Partie::getNombrePartiesEnCoursByMapId(1);
        $nombrePartiesTermineesMapStarWars = Partie::getNombrePartiesTermineesByMapId(1);
        $nombrePartiesEnCoursMapPokemon = Partie::getNombrePartiesEnCoursByMapId(2);
        $nombrePartiesTermineesMapPokemon = Partie::getNombrePartiesTermineesByMapId(2);
        $nombreMoyenJoueursParPartieStarWars = Partie::getNombreMoyenJoueursByPartieAndMapId(1);
        $nombreMoyenJoueursParPartiePokemon = Partie::getNombreMoyenJoueursByPartieAndMapId(2);
        $villesPlusUtiliseesStarWars = Ville::getVillesPlusUtiliseesByMap(1);
        $villesPlusUtiliseesPokemon = Ville::getVillesPlusUtiliseesByMap(2);
        $cartesDestinationPlusUtiliseesStarWars = CarteDestination::getCartesDestinationPlusUtiliseesByMap(1);
        $cartesDestinationPlusUtiliseesPokemon = CarteDestination::getCartesDestinationPlusUtiliseesByMap(2);
        $nombreMoyenJokersByPartie = Partie::getNombreMoyenJokersByPartie();
        $nombreMoyenJokersByPartieStarWars = Partie::getNombreMoyenJokersByPartieAndMapId(1);
        $nombreMoyenJokersByPartiePokemon = Partie::getNombreMoyenJokersByPartieAndMapId(2);
        $nombreMoyenCartesDestinationReussiesByPartie = Partie::getNombreMoyenCartesDestinationReussiesByPartie();
        $nombreMoyenCartesDestinationReussiesByPartieStarWars = Partie::getNombreMoyenCartesDestinationReussiesByPartieAndMapId(1);
        $nombreMoyenCartesDestinationReussiesByPartiePokemon = Partie::getNombreMoyenCartesDestinationReussiesByPartieAndMapId(2);
        $cartesDestinationPlusReussiesStarWars = CarteDestination::getCartesDestinationPlusReussiesByMap(1);
        $cartesDestinationPlusReussiesPokemon = CarteDestination::getCartesDestinationPlusReussiesByMap(2);

        $response = new Response();
        $this->view->render('statistique/statistique', array(
            'classement' => $classement,
            'nombrePartiesJouees' => $nombrePartiesJouees,
            'nombrePartiesEnCours' => $nombrePartiesEnCours,
            'nombrePartiesTerminees' => $nombrePartiesTerminees,
            'nombrePartiesAvecMapStarWars' => $nombrePartiesAvecMapStarWars,
            'nombrePartiesAvecMapPokemon' => $nombrePartiesAvecMapPokemon,
            'nombreMoyenJoueursParPartie' => $nombreMoyenJoueursParPartie,
            'nombrePartiesEnCoursMapStarWars' => $nombrePartiesEnCoursMapStarWars,
            'nombrePartiesTermineesMapStarWars' => $nombrePartiesTermineesMapStarWars,
            'nombrePartiesEnCoursMapPokemon' => $nombrePartiesEnCoursMapPokemon,
            'nombrePartiesTermineesMapPokemon' => $nombrePartiesTermineesMapPokemon,
            'nombreMoyenJoueursParPartieStarWars' => $nombreMoyenJoueursParPartieStarWars,
            'nombreMoyenJoueursParPartiePokemon' => $nombreMoyenJoueursParPartiePokemon,
            'villesPlusUtiliseesStarWars' => $villesPlusUtiliseesStarWars,
            'villesPlusUtiliseesPokemon' => $villesPlusUtiliseesPokemon,
            'cartesDestinationPlusUtiliseesStarWars' => $cartesDestinationPlusUtiliseesStarWars,
            'cartesDestinationPlusUtiliseesPokemon' => $cartesDestinationPlusUtiliseesPokemon,
            'nombreMoyenJokersByPartie' => $nombreMoyenJokersByPartie,
            'nombreMoyenJokersByPartieStarWars' => $nombreMoyenJokersByPartieStarWars,
            'nombreMoyenJokersByPartiePokemon' => $nombreMoyenJokersByPartiePokemon,
            'nombreMoyenCartesDestinationReussiesByPartie' => $nombreMoyenCartesDestinationReussiesByPartie,
            'nombreMoyenCartesDestinationReussiesByPartieStarWars' => $nombreMoyenCartesDestinationReussiesByPartieStarWars,
            'nombreMoyenCartesDestinationReussiesByPartiePokemon' => $nombreMoyenCartesDestinationReussiesByPartiePokemon,
            'cartesDestinationPlusReussiesStarWars' => $cartesDestinationPlusReussiesStarWars,
            'cartesDestinationPlusReussiesPokemon' => $cartesDestinationPlusReussiesPokemon
        ));
        return $response;
    }

}
