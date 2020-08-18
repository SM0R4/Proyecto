<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/viajesBo.php");
require_once ("../domain/viajes.php");

$obj_viaje = new Viaje();
$obj_viaje->setFecha('2020-08-15');
$obj_viaje->setUbicacion_final(array(9.959602199999999,-84.0468092));
$obj_viaje->setTiempo_llegada_punto_inicio('5:05');
$obj_viaje->setTiempo_viaje('20:05');
$obj_viaje->setCosto(5000);
$obj_viaje->setChofer_Cedula('117830068');
$obj_viaje->setUsuario_PK_Username('Sm0r5');

$bo_viaje = new ViajeBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_viaje->add($obj_viaje);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_viaje->update($obj_viaje);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_viaje->delete($obj_viaje);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $viajeConsultada = $bo_viaje->searchById($obj_viaje);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($viajeConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_viaje->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
