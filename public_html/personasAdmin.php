<?php
//$templateTitle = 'Mantenimiento de Usuarios';
$templateScripts = '';
$templatePageHeader = '';

include_once("template/templateHead.php");
?>
<head>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG2OpMVhBHYb2BDDZkHkGPPy4yg8yFKlc&callback=initMap&libraries=&v=weekly" defer></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      .map {
          height: 400px;
          
      }
     </style>
    <script src="./js/Maps.js"></script>
    <title>Proyecto Progra III</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.2/umd/popper.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    
</head>
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="imgs/carro (1).png"> TravelSite</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Información
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item text-white" href="index.php#empresa">Historia de la empresa</a>
                              <a class="dropdown-item text-white" href="index.php#institucion">Referentes institucionales</a>
                            </div>
                         </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Contactenos.php">Contáctenos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="row">
        <div class="col-md-12">
            <form role="form" onsubmit="return false;" id="formUsuario" action="../backend/controller/usuariosController.php">
                <div class="row">
                    <!-- ******************************************************** -->
                    <!-- Campos de formulario      -->
                    <!-- ******************************************************** -->
                    <div class="col-md-12">
                        <div class="form-group" id="groupnombre">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre"  placeholder="Nombre">
                        </div>
                        <div class="form-group" id="groupapellido1">
                            <label for="apellido1">Primer Apellido</label>
                            <input type="text" class="form-control" id="apellido1"  placeholder="Primer Apellido">
                        </div>
                        <div class="form-group" id="groupapellido2">
                            <label for="apellido2">Segundo Apellido</label>
                            <input type="text" class="form-control" id="apellido2"  placeholder="Segundo Apellido">
                        </div>
                        <div class="form-group" id="groupfecNacimiento">
                            <label for="fecNacimiento">Fecha Nacimiento</label>
                            <input type="text" class="form-control" id="fecNacimiento"  placeholder="Fec. Nacimiento">
                        </div>
                        <div class="form-group" id="groupsexo">
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" id="sexo"  placeholder="Sexo">
                        </div>
                        <div class="form-group" id="groupemail">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email"  placeholder="email">
                        </div>
                        <div class="form-group" id="groupPK_Username">
                            <label for="PK_Username">Username</label>
                            <input type="text" class="form-control" id="PK_Username"  placeholder="Username">
                        </div>
                        <div class="form-group" id="groupcontrasena">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena"  placeholder="Contraseña">
                        </div>
                        <div class="form-group" id="grouptelefono">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono"  placeholder="Teléfono">
                        </div>
                        <div class="form-group" id="grouptipoUsuario">
                            <label for="tipoUsuario">tipoUsuario</label>
                            <input type="text" class="form-control" id="tipoUsuario"  placeholder="Tipo usuario">
                        </div>
                        <div class="form-group" id="groupUbicacion">
                            <label for="Ubicacion">Ubicacion</label>
                            <input type="text" class="form-control" id="Ubicacion"  placeholder="Ubicación">

                            <input type ="button" value="Mi ubicacion" onclick="get_my_location();" class="btn">
                            <div class="map" id="map"></div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="typeAction" value="add_usuario" />
                            <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                            <button type="reset" class="btn btn-danger" id="cancelar">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br>
    <h3>Tabla con informacion de usuarios</h3>

    <br><br>
    <div class="row">
        <div class="col-md-12">
            <table id="dt_usuario"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>CEDULA</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO1</th>
                        <th>APELLIDO2</th>
                        <th>FEC. NACIMIENTO</th>
                        <th>SEXO</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
<br><br><br><br>
<?php
include_once("template/templateFooter.php");
?>
