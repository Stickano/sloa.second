<?php
    # This document handles meta/head data
    # This document should be loaded once per page


    # Singleton
    require_once('resources/singleton.php');
    $singleton = Singleton::init();

    # Shortcut for some commonly used classes
    $controller = $singleton::$controller;
    $meta = $singleton::$meta;
    $session = $singleton::$session;

    # Meta
    echo'<title>'.$meta->getTitle().'</title>';
    echo'<link rel="alternate" href="https://sloa.dk" hreflang="dk" />';
    echo'<meta charset="utf-8">';
    echo'<meta http-equiv="content-language" content="da">';
    echo'<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo'<meta name="author" content="'.$meta->getAuthor().'" />';
    echo'<meta name="description" content="'.$meta->getDescription().'">';
    echo'<meta name="keywords" content="'.$meta->getKeywords().'" />';
    echo'<meta name="robot" content="'.$meta->getFollow().'"/>';
    echo'<meta name="viewport" content="width=device-width, initial-scale=0.8">';

    # Additional Fonts (Google)
    echo'<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Bellefair|Handlee" rel="stylesheet">';

    # Font Awesome (icons)
    # http://fontawesome.io
    echo'<link rel="stylesheet" href="css/font-awesome.min.css">';

    # JQuery
    echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';

    # Stylesheets
    echo'<link href="css/styles.css" rel="stylesheet">';
    echo'<link href="css/helpers.css" rel="stylesheet">';
    echo'<link href="css/additionals.css" rel="stylesheet">';
?>