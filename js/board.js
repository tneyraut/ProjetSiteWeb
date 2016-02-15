jQuery(function($) {
    
    var $svg = $('#map');
    var svg = $svg[0];
    var piocheCarteDestinationHtml = $('#cartesDestination').html();
    var piocheHtml = $('#pioche').html();
    var mapHtml = $('#map').html();
    var allPaths = [];
    
    var arrayURL = window.location.href.split('/');
    var partie_id = arrayURL[6];

    function bu(controller, action, params) {
        var arrayURL = window.location.href.split('/');
        var baseURL = arrayURL[0]+'//'+arrayURL[2]+'/'+arrayURL[3]+'/';

        var url = baseURL;

        if(!controller)
            return url;

        if(!action)
            return url+controller;

        url += controller+'/'+action;

        $.each(params, function(i, param) {
            url += '/'+param;
        });

        return url;
    }

    function creerRoutes(routes) {
        $('#map').html(mapHtml);
        $.each(routes, function(index, route) {
            var path;
            if(route.type === 'bezier') {
                path = new BezierPath(route.route_id, route.points, route.stroke_dasharray, parseInt(route.longueur), route.couleur);
            } else {
                path = new PolylinePath(route.route_id, route.points, route.stroke_dasharray, parseInt(route.longueur), route.couleur);
            }
            allPaths.push(path);

            svg.appendChild(path.ui);
            toggleClassOfSVGElement(path.ui, 'path_clickable');
            
            if(route.proprietaire) {
                toggleClassOfSVGElement(path.ui, 'path_clickable');
                toggleClassOfSVGElement(path.ui, 'path_selected');
                toggleClassOfSVGElement(path.ui, 'player_'+route.proprietaire.couleur);
            }
        });
    }
    
    function gererTours(plateau) {
        if(plateau.premierTour === "true") {
            $('#isMyTurn').html('Choix des cartes de destination (Attente des autres joueurs)');
        }
        else if(plateau.isMyTurn === "true") {
            if(plateau.dernierTour === "true")
                $('#isMyTurn').html('C\'est votre tour (dernier tour)');
            else
                $('#isMyTurn').html('C\'est votre tour');
        }
        else
        {
            if(plateau.dernierTour === "true")
                $('#isMyTurn').html('Ce n\'est pas votre tour (dernier tour)');
            else
                $('#isMyTurn').html('Ce n\'est pas votre tour');
        }
    }
    
    
    
    function gererParticipants(plateau) {
        $('#participants').html('');
        $.each(plateau.participants, function(index, participant) {
            var elt = $('<span class="participant"><div class="circle circle_'+participant.couleur+'">'+participant.jetons+'</div>'+participant.login+'('+participant.score+') </span>');
            
            elt = elt.appendTo('#participants');
            
            if(participant.joueur_id === plateau.partie.tour_joueur_id) {
                elt.toggleClass('tour');
            }
        });
    }
    
    

    function creerPioche(pioche) {
        $('#pioche').html(piocheHtml);
        $.each(pioche, function(index, carte) {
            pioche.push(
                 $('<div class="col-sm-6 col-md-6"><a href="'+bu('partie', 'piocher', [partie_id, carte.type])+'"><img class="carte" src="'+ bu()+carte.image+'" alt="carte pioche" /></a></div>')
                .appendTo('#pioche')
            );
        });
    }
    
    function creerMain(main) {
        $('#main').html('');
        $.each(main, function(index, carte) {
            main.push(
                 $('<div class="col-sm-2 col-md-2 col-lg-1"> <img class="carte" src="'+bu()+carte.image+'" alt="carte pioche" /></div>')
                .appendTo('#main')
            );
        });
    }

    function creerCartesDestinations(cartesDestination, map) {
        $('#cartesDestination').html(piocheCarteDestinationHtml);
        $.each(cartesDestination, function(index, carte) {
            cartesDestination.push(
                 $('<div class="col-sm-2 col-md-2 col-lg-1"><div class="carte carte_destination" style="background-image: url(\''+ bu()+map.image_fond_carte_destination+'\')"><p class="carte_destination_text">'+carte.ville1+'<br> - <br>'+carte.ville2+'<br>'+carte.nombre_points+' points</p></div></div>')
                .appendTo('#cartesDestination')
            );
        });
    }
        
    // ---------
    // Ajax long polling
    // ---------

    function poll(){
        setTimeout(function(){
            getPlateauAjax(function(plateau) {
                refresh(plateau);
            })
        }, 2000);
    }
    
    function getPlateauAjax(callback) {
        var url = bu('partie','getPlateauAjax', [partie_id]);

        $.ajax({
            url: url,
            success: callback,
            error: function(response, error) {
                console.log(error);
            },
            dataType: "json"
        });
    }
    
    function refresh(plateau) {
        if(plateau.partie.etat == 4)
            window.location.href = bu('partie', 'resultats', [partie_id]);
            
        creerRoutes(plateau.routes);
        gererTours(plateau);
        gererParticipants(plateau);
        creerPioche(plateau.pioche_visible);
        creerMain(plateau.main);
        creerCartesDestinations(plateau.cartesDestination, plateau.map);
        
        var carteWidth = $(window).width()*7/100;
        var carteHeight = 1.5*carteWidth;
        
        $('.carte').css('width', carteWidth);
        $('.carte').css('height', carteHeight);
        
        if(plateau.premierTour === "true" || plateau.isMyTurn !== "true")
            poll();
    } 
    
    $('#map').on('click', '.path_clickable', function() {
        var route_id = $(this).attr('id');
        window.location.href = bu('partie', 'construireRoute', [partie_id,route_id]);
    });
        
    getPlateauAjax(function(plateau) {
        refresh(plateau);
    });

});


