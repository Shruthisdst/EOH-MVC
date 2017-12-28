<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title><?php if($pageTitle) echo $pageTitle . ' | '; ?>Encyclopaedia of Hinduism </title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Javascript calls
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/viewer.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/navbar.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/homepage.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/dict.css">
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/aux.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/carousel.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/page.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/archive.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/flat.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/form.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/social.css"> -->
    <!-- <link rel="stylesheet" href="<?=PUBLIC_URL?>css/general.css"> -->

    <!-- Fonts
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway:200,300,400|Roboto:300,400&amp;subset=latin-ext" rel="stylesheet">

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="<?=PUBLIC_URL?>images/favicon.ico">
</head>
<body>
    <!-- Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <nav id="mainNavBar" class="navbar navbar-light navbar-expand-lg fixed-top">
        <div class="container-fluid clear-paddings">
            <a class="navbar-brand" href="#"><img src="<?=PUBLIC_URL?>images/logo.png" alt="Logo" class="logo"></a>
            <p class="navbar-text" id="navbarText"><small>A Concise</small><br />Encyclopaedia of Hinduism</p>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav nav ml-auto">
                    <li><a href="<?=BASE_URL?>page/flat/Home">The Encyclopaedia</a></li>
                    <li><a href="<?=BASE_URL?>page/flat/About">About</a></li>
                    <li><a href="<?=BASE_URL?>listing/alphabet/A">Index</a></li>
                    <li id="openNavbarSearch"><a><i class="fa fa-search"></i></a></li>
                </ul>
                <form id="navbarSearch" class="form-inline" action="<?=BASE_URL?>search/field/">
                    <div class="form-group"><input type="text" name="word" id="word" class="form-control" placeholder="Search"></div>
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
