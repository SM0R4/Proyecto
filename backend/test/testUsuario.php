<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/usuariosBo.php");
require_once ("../domain/usuarios.php");

$obj_usuario = new Usuario();
$obj_usuario->setPK_Username('Sam0r4');
$obj_usuario->setNombre('Sara');
$obj_usuario->setcontrasena('123asc');
$obj_usuario->setApellido1('Mora');
$obj_usuario->setApellido2('Camacho');
$obj_usuario->setemail('sarahmoca20@hotmail.com');
$obj_usuario->setSexo('F');
$obj_usuario->setFecNacimiento('2000-07-23');
$obj_usuario->settelefono(89657419);
$obj_usuario->settipousuario('Chofer');
$obj_usuario->setUbicacion(array(9.959602199999999,-84.0468092));

$bo_usuario = new UsuarioBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_usuario->add($obj_usuario);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_usuario->update($obj_usuario);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_usuario->delete($obj_usuario);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $usuarioConsultada = $bo_usuario->searchById($obj_usuario);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($usuarioConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_usuario->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
