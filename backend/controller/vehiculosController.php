<?php

require_once("../bo/vehiculosBo.php");
require_once("../domain/vehiculos.php");


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
        $myVehiculoBo = new VehiculoBo();
        $myVehiculo = Vehiculo::createNullVehiculo();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_vehiculo" or $action === "update_vehiculo") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_Username') != null) && (filter_input(INPUT_POST, 'contrasena') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'email') != null) && (filter_input(INPUT_POST, 'fecNacimiento') != null) && (filter_input(INPUT_POST, 'sexo') != null) && (filter_input(INPUT_POST, 'telefono') != null) && (filter_input(INPUT_POST, 'tipovehiculo') != null) && (filter_input(INPUT_POST, 'Ubicacion') != null)) {
                $myVehiculo->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myVehiculo->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myVehiculo->setcontrasena(filter_input(INPUT_POST, 'contrasena'));
                $myVehiculo->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myVehiculo->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myVehiculo->setemail(filter_input(INPUT_POST, 'email'));
                $myVehiculo->setfecNacimiento(filter_input(INPUT_POST, 'fecNacimiento'));
                $myVehiculo->setsexo(filter_input(INPUT_POST, 'sexo'));
                $myVehiculo->settelefono(filter_input(INPUT_POST, 'telefono'));
                $myVehiculo->settipoVehiculo(filter_input(INPUT_POST, 'tipoVehiculo'));
                $myVehiculo->setUbicacion(filter_input(INPUT_POST, 'Ubicacion'));
                if ($action == "add_vehiculo") {
                    $myVehiculoBo->add($myVehiculo);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_vehiculo") {
                    $myVehiculoBo->update($myVehiculo);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_vehiculo") {//accion de consultar todos los registros
            $resultDB   = $myVehiculoBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_vehiculo") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myVehiculo->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myVehiculo = $myVehiculoBo->searchById($myVehiculo);
                if ($myVehiculo != null) {
                    echo json_encode(($myVehiculo));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_vehiculo") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myVehiculo->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myVehiculoBo->delete($myVehiculo);
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
