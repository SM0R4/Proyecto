<?php

require_once("../bo/facturasBo.php");
require_once("../domain/facturas.php");


/**
 * This class contain all services methods of the table Personas
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// Personas Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myFacturaBo = new FacturaBo();
        $myFactura = Factura::createNullFactura();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_factura" or $action === "update_factura") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_Username') != null) && (filter_input(INPUT_POST, 'contrasena') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'email') != null) && (filter_input(INPUT_POST, 'fecNacimiento') != null) && (filter_input(INPUT_POST, 'sexo') != null) && (filter_input(INPUT_POST, 'telefono') != null) && (filter_input(INPUT_POST, 'tipofactura') != null) && (filter_input(INPUT_POST, 'Ubicacion') != null)) {
                $myFactura->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myFactura->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myFactura->setcontrasena(filter_input(INPUT_POST, 'contrasena'));
                $myFactura->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myFactura->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myFactura->setemail(filter_input(INPUT_POST, 'email'));
                $myFactura->setfecNacimiento(filter_input(INPUT_POST, 'fecNacimiento'));
                $myFactura->setsexo(filter_input(INPUT_POST, 'sexo'));
                $myFactura->settelefono(filter_input(INPUT_POST, 'telefono'));
                $myFactura->settipoFactura(filter_input(INPUT_POST, 'tipoFactura'));
                $myFactura->setUbicacion(filter_input(INPUT_POST, 'Ubicacion'));
                if ($action == "add_factura") {
                    $myFacturaBo->add($myFactura);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_factura") {
                    $myFacturaBo->update($myFactura);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_factura") {//accion de consultar todos los registros
            $resultDB   = $myFacturaBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_factura") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myFactura->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myFactura = $myFacturaBo->searchById($myFactura);
                if ($myFactura != null) {
                    echo json_encode(($myFactura));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_factura") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myFactura->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myFacturaBo->delete($myFactura);
                echo('M~Registro Fue Eliminado Correctamente');
            }
        }

        //***********************************************************
        //se captura cualquier error generado
        //***********************************************************
    } catch (Exception $e) { //exception generated in the business object..
        echo("E~" . $e->getMessage());
    }
} else {
    echo('M~Parametros no enviados desde el formulario'); //se codifica un mensaje para enviar
}
?>
