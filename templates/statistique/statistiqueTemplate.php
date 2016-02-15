<?php $this->includeTemplate('panel', array('titre' => 'Statistiques')); ?>    

<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#classement" aria-controls="classement" role="tab" data-toggle="tab">Classement</a></li>
        <li role="presentation"><a href="#statsGenerales" aria-controls="statsGenerales" role="tab" data-toggle="tab">Stats générales</a></li>
        <li role="presentation"><a href="#statsStarWars" aria-controls="statsStarWars" role="tab" data-toggle="tab">Stats Star Wars</a></li>
        <li role="presentation"><a href="#statsPokemon" aria-controls="statsPokemon" role="tab" data-toggle="tab">Stats Pokémon</a></li>
    </ul>
     <br><br>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="classement">
            <?php $this->includeTemplate('statistique/classement') ?>
        </div>


        <div role="tabpanel" class="tab-pane fade" id="statsGenerales">
             <?php $this->includeTemplate('statistique/statsGenerales') ?>
        </div>


        <div role="tabpanel" class="tab-pane fade" id="statsStarWars">
            <?php $this->includeTemplate('statistique/statsStarWars') ?>
        </div>


        <div role="tabpanel" class="tab-pane fade" id="statsPokemon">
            <?php $this->includeTemplate('statistique/statsPokemon') ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        
        var options = {
            lengthChange: false,
            info: false,
            language: {
                paginate: {
                    previous: 'Précédent',
                    next: 'Suivant'
                },
                search: 'Rechercher'
            }
        };
        
        $('#tableau').DataTable($.extend({
            searching: true,
            order: [5, 'desc']
        }, options));
        
        $('#tableauVillesPokemon').DataTable($.extend({
            searching: false,
            order: [1, 'desc']
        }, options));
        
        $('#tableauVillesStarWars').DataTable($.extend({
            searching: false,
            order: [1, 'desc']
        }, options));
        
        $('#cartesDestinationPokemonPlusUtilisees').DataTable($.extend({
            searching: false,
            order: [3, 'desc']
        }, options));
        
        $('#cartesDestinationStarWarsPlusUtilisees').DataTable($.extend({
            searching: false,
            order: [3, 'desc']
        }, options));
        
        $('#cartesDestinationStarWarsPlusReussies').DataTable($.extend({
            searching: false,
            order: [3, 'desc']
        }, options));
        
        $('#cartesDestinationPokemonPlusReussies').DataTable($.extend({
            searching: false,
            order: [3, 'desc']
        }, options));
        
    });
</script>

<?php $this->includeTemplate('panelFin'); ?>