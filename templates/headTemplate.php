<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="shortcut icon" href="<?php echo $this->bu() ?>images/icon1.jpg" type="image/jpg"/>
        <link rel="icon" href="<?php echo $this->bu() ?>images/icon1.jpg" type="image/jpg"/>
        
        <title>Backpackers Space</title>
<!--        <link rel="icon" href="<?php //$this->bu() ?>images/favicon.ico">-->

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Projet Internet - ISIC Mines de Douai 2016">
        <meta name="author" content="Tiana Andriamahatratra - Alexandre Chenieux - Thomas Neyraut">
        
        <?php if(isset($refresh) && $refresh): ?>
             <!--<meta http-equiv="refresh" content=2> <!-- -->
        <?php endif ?>
            
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php $this->bu() ?>css/style.css">
        <link rel="stylesheet" href="<?php $this->bu() ?>css/style_routes.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">


        <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    </head>