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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.2/umd/popper.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <script src="Js/javascript.js"></script>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html"><img src="imgs/carro (1).png">TravelSite</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Información
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item text-white" href="index.html#empresa">Historia de la empresa</a>
                              <a class="dropdown-item text-white" href="index.html#institucion">Referentes institucionales</a>
                            </div>
                         </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contáctenos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="dialog" title="Correo listo">
            <p>Su mensaje está a punto de ser enviado</p>
            <br>
            <p>Si no se abre el correo, verifique la aplicación por defecto para los correos</p>
        </div>
        <div class="container contact">
            <div class="contact-title">
                <br>
                <h1>Contáctenos</h1>
                <h2>El correo será enviado al administrador y también al del correo ingresado</h2>
            </div>
            <div class="contact-form">
                <form id="contact-form" method="post" action="MAILTO:newsitetravel2020@gmail.com" enctype="text/plain">
                    <div class="form-group">
                        <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="form-group">
                        <textarea name="mensaje" id="mensaje" class="form-control" placeholder="Escriba su mensaje" rows="4" required></textarea>
                    </div>
                    <input type="submit" id="opener" class="btn btn-dark" value="Enviar mensaje">
                </form>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
