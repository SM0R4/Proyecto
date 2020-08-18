<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/facturasBo.php");
require_once ("../domain/facturas.php");

$obj_factura = new Factura();
$obj_factura->setHistorial_viajes_idViaje(1);
$obj_factura->setDescripcion('Mi primer viaje');

$bo_factura = new FacturaBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_factura->add($obj_factura);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_factura->update($obj_factura);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_factura->delete($obj_factura);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $facturaConsultada = $bo_factura->searchById($obj_factura);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($facturaConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_factura->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
