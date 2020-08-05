<?php
$templateTitle = 'Mantenimiento de Usuarios';
$templateScripts = '';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Usuarios</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    <div class="col-md-12">
        <form role="form" onsubmit="return false;" id="formUsuario" action="../backend/controller/personasController.php">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">
                    <div class="form-group" id="groupnombre">
                        <label for="txtnombre">Nombre</label>
                        <input type="text" class="form-control" id="txtnombre"  placeholder="Nombre">
                    </div>
                    <div class="form-group" id="groupapellido1">
                        <label for="txtapellido1">Primer Apellido</label>
                        <input type="text" class="form-control" id="txtapellido1"  placeholder="Primer Apellido">
                    </div>
                    <div class="form-group" id="groupapellido2">
                        <label for="txtapellido2">Segundo Apellido</label>
                        <input type="text" class="form-control" id="txtapellido2"  placeholder="Segundo Apellido">
                    </div>
                    <div class="form-group" id="groupfecNacimiento">
                        <label for="txtfecNacimiento">Fecha Nacimiento</label>
                        <input type="text" class="form-control" id="txtfecNacimiento"  placeholder="Fec. Nacimiento">
                    </div>
                    <div class="form-group" id="groupsexo">
                        <label for="txtsexo">Sexo</label>
                        <input type="text" class="form-control" id="txtsexo"  placeholder="Sexo">
                    </div>
                    <div class="form-group" id="groupemail">
                        <label for="txtemail">Email</label>
                        <input type="text" class="form-control" id="txtemail"  placeholder="email">
                    </div>
                    <div class="form-group" id="groupPK_Username">
                        <label for="txtPK_Username">Username</label>
                        <input type="text" class="form-control" id="txtPK_Username"  placeholder="Username">
                    </div>
                    <div class="form-group" id="groupcontrasena">
                        <label for="txtcontrasena">Contraseña</label>
                        <input type="password" class="form-control" id="txtcontrasena"  placeholder="Contraseña">
                    </div>
                    <div class="form-group" id="groupotelefono">
                        <label for="txttelefono">Teléfono</label>
                        <input type="text" class="form-control" id="txttelefono"  placeholder="Teléfono">
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

<br><br><br><br>
<?php
include_once("template/templateFooter.php");
?>
