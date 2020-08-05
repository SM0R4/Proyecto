<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Proyecto Progra III</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.2/umd/popper.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html"><img src="imgs/carro (1).png"> TravelSite</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Información
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item text-white" href="#empresa">Historia de la empresa</a>
                              <a class="dropdown-item text-white" href="#institucion">Referentes institucionales</a>
                            </div>
                         </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Contactenos.html">Contáctenos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Image Slider -->
        <div id="slides" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#slides" data-slide-to="0" class="active"></li>
                <li data-target="#slides" data-slide-to="1"></li>
                <li data-target="#slides" data-slide-to="2"></li>
                <li data-target="#slides" data-slide-to="3"></li>
                <li data-target="#slides" data-slide-to="4"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80">
                    <div class="carousel-caption">
                        <h1 class="display-2">TravelSite</h1>
                        <h3 class="">UIA - Progra III</h3>
                        <h4>"Los viajes son súper rápidos"</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1533408874882-397bf377a8c2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80">
                    <div class="carousel-caption">
                        <h1 class="display-2">TravelSite</h1>
                        <h3 class="">UIA - Progra III</h3>
                        <h4>"Muy económica"</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1515086828834-023d61380316?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1353&q=80">
                    <div class="carousel-caption">
                        <h1 class="display-2">TravelSite</h1>
                        <h3 class="">UIA - Progra III</h3>
                        <h4>"Los carros son muy cómodos"</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1482029255085-35a4a48b7084?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1489&q=80">
                    <div class="carousel-caption">
                        <h1 class="display-2">TravelSite</h1>
                        <h3 class="">UIA - Progra III</h3>
                        <h4>"Excelente atención"</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1449553728176-2ba1d6062517?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80">
                    <div class="carousel-caption">
                        <h1 class="display-2">TravelSite</h1>
                        <h3 class="">UIA - Progra III</h3>
                        <h4>"La mejor app que he utilizado"</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
        <div class="container-fluid" id="institucion">
            <div class="row jumbotron">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col xl-10">
                    <h1> Referente institucional </h1>
                    <p class="lead">
                        Este sitio web, forma parte de un proyecto de la Escuela de Informática de la UIA, para el curso
                        de Programación III
                    </p>
                </div>
            </div>
        </div>
            
        <!-- Welcome Section -->
        <div class="container-fluid padding" id="empresa">
            <div class="row welcome text-center">
                <div class="col-12">
                    <h1 class="display-4">TravelSite</h1>
                </div>
                <hr>
                <div class="col-12">
                    <img src="imgs/carro negro.png">
                    <br>
                    <p class="lead">TravelSite es una empresa que ofrece servicio de transporte en automóvil, a muy buen precio,
                    para aquellas personas que les gusta llegar de forma rápida a los lugares.</p>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
