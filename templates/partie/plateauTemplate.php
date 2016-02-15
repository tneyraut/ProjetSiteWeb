<script type="text/javascript" src="<?php $this->bu() ?>js/classes.js"></script>
<script type="text/javascript" src="<?php $this->bu() ?>js/board.js"></script>

<section class="panel panel-default">

    <div class="panel-body" id="plateau_body">
        
        <div class="informations bord-panel">
            <div class="repeat-background">
                <h1 id="isMyTurn"></h1>
                
                <div id="participants"></div>
            </div>
        </div>
        
        <table>
            <tr>
                <td id="map-container">
                    <svg id="map" viewBox="0 0 1500 900" xmlns="http://www.w3.org/2000/svg">
                        <image xlink:href="<?php $this->bu(); echo $map->image ?>" x="0" y="0" height="900px" width="1500px"/>
                    </svg>
                </td>
                
                <td id="container_plateau_pioches">
                    <div class="plateau_pioches bord-panel-bord">
                        <div class="repeat-background-bord">
                            <div class="row" style="margin-bottom: 50px;">
                                <div class="col-sm-6 col-md-6">
                                    <a href="<?php $this->bu('partie', 'piocher', array($partie_id, 'carte_destination')) ?>">
                                        <img class="carte" src="<?php $this->bu(); echo $map->image_carte_destination ?>" alt="carte destination" width="100%" />
                                    </a>
                                </div>
                            </div>

                            <div id="pioche" class="row">
                                <div class="col-sm-6 col-md-6">
                                    <a href="<?php $this->bu('partie', 'piocher', array($partie_id, 'pioche')) ?>">
                                        <img class="carte" src="<?php $this->bu(); echo $map->image_pioche ?>" alt="carte pioche" width="100%"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#mainTab" aria-controls="main" role="tab" data-toggle="tab"><h4>Main</h4></a></li>
                <li role="presentation" class=""><a href="#cartesDestinationTab" aria-controls="cartesDestination" role="tab" data-toggle="tab"><h4>Cartes Destination</h4></a></li>
            </ul>

            <div class="tab-content bord-panel-main">

                <div role="tabpanel" class="tab-pane in active repeat-background-main" id="mainTab">
                    <div id="main" class="row"></div>
                </div>
                <div role="tabpanel" class="tab-pane repeat-background-main" id="cartesDestinationTab">
                    <div id="cartesDestination" class="row"></div>
                </div>
            </div>
        </div>


    </div>
</section>