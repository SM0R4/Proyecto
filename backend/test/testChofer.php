<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/choferesBo.php");
require_once ("../domain/choferes.php");

$obj_chofer = new Chofer();
$obj_chofer->setCedula('117830068');
$obj_chofer->setTipo_licencia('B1');
$obj_chofer->setFecha_Vencimiento_licencia('2022-01-12');
$obj_chofer->setActual_chofer(1);
$obj_chofer->setUsuario_PK_Username('Sam0r4');
$obj_chofer->setVehiculo_Placa('123456');

$bo_chofer = new ChoferBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_chofer->add($obj_chofer);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_chofer->update($obj_chofer);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_chofer->delete($obj_chofer);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $choferConsultada = $bo_chofer->searchById($obj_chofer);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($choferConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_chofer->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
