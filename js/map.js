jQuery(function($) {
    
    var $svg = $('#map');
    var svg = $svg[0];
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
        $.each(routes, function(index, route) {
            var path;
            if(route.type === 'bezier') {
                path = new BezierPath(route.route_id, route.points, route.stroke_dasharray, parseInt(route.longueur), route.couleur);
            } else {
                path = new PolylinePath(route.route_id, route.points, route.stroke_dasharray, parseInt(route.longueur), route.couleur);
            }
            allPaths.push(path);

            svg.appendChild(path.ui);
            
            if(route.proprietaire) {
                toggleClassOfSVGElement(path.ui, 'path_selected');
                toggleClassOfSVGElement(path.ui, 'player_'+route.proprietaire.couleur)
            }
        });
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
        
    getPlateauAjax(function(plateau) {
        creerRoutes(plateau.routes);
        
        var carteWidth = $(window).width()*7/100;
        var carteHeight = 1.5*carteWidth;
        
        $('.carte').css('width', carteWidth);
        $('.carte').css('height', carteHeight);
    });

});


