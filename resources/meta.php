<?php

    # Singleton
    require_once('resources/singleton.php');
    $singleton  = Singleton::init();
    
    # Shortcut for some commonly used classes
    $controller = $singleton::$controller;
    $meta       = $singleton::$meta;
    $session    = $singleton::$session;
    $time       = $singleton::$time;

    # Meta
    echo'<title>'.$meta->getTitle().'</title>';
    echo'<meta charset="utf-8">';
    echo'<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo'<link rel="alternate" href="https://sloa.dk" hreflang="da" />';
    echo'<meta name="author"        content="'.$meta->getAuthor().'" />';
    echo'<meta name="description"   content="'.$meta->getDescription().'">';
    echo'<meta name="keywords"      content="'.$meta->getKeywords().'" />';
    echo'<meta name="robots"        content="'.$meta->getFollow().'"/>';
    echo'<meta name="viewport"      content="width=device-width, initial-scale=0.8">';

    # Additional Fonts (Google)
    echo'<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Bellefair|Handlee" rel="stylesheet">';
    echo'<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">';

    # Font Awesome (icons)
    # http://fontawesome.io
    echo'<link rel="stylesheet" href="css/font-awesome.min.css">';

    # JQuery
    echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';

    # JQuery Lightbox
    echo'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />';

    # CSS from w3s template
    echo'<link href="css/w3s.css" rel="stylesheet">';
    
    # Custom stylesheets
    echo'<link href="css/styles.css" rel="stylesheet">';
    echo'<link href="css/helpers.css" rel="stylesheet">';

?>
