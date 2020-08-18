<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/vehiculosBo.php");
require_once ("../domain/vehiculos.php");

$obj_vehiculo = new Vehiculo();
$obj_vehiculo->setPlaca('123456');
$obj_vehiculo->setAnnio(2010);
$obj_vehiculo->setModelo('Tucsan');
$obj_vehiculo->setColor('Negro');
$obj_vehiculo->setPuntuacion(5);
$obj_vehiculo->setEstado(1);
$obj_vehiculo->setUbicacion_actual(array(9.959602199999999,-84.0468092));

$bo_vehiculo = new VehiculoBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_vehiculo->add($obj_vehiculo);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_vehiculo->update($obj_vehiculo);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_vehiculo->delete($obj_vehiculo);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $vehiculoConsultada = $bo_vehiculo->searchById($obj_vehiculo);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($vehiculoConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_vehiculo->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
