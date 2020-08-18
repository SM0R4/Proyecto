<?php

require_once("../bo/viajesBo.php");
require_once("../domain/viajes.php");


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
        $myViajeBo = new ViajeBo();
        $myViaje = Viaje::createNullViaje();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_viaje" or $action === "update_viaje") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_Username') != null) && (filter_input(INPUT_POST, 'contrasena') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'email') != null) && (filter_input(INPUT_POST, 'fecNacimiento') != null) && (filter_input(INPUT_POST, 'sexo') != null) && (filter_input(INPUT_POST, 'telefono') != null) && (filter_input(INPUT_POST, 'tipoviaje') != null) && (filter_input(INPUT_POST, 'Ubicacion') != null)) {
                $myViaje->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myViaje->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myViaje->setcontrasena(filter_input(INPUT_POST, 'contrasena'));
                $myViaje->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myViaje->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myViaje->setemail(filter_input(INPUT_POST, 'email'));
                $myViaje->setfecNacimiento(filter_input(INPUT_POST, 'fecNacimiento'));
                $myViaje->setsexo(filter_input(INPUT_POST, 'sexo'));
                $myViaje->settelefono(filter_input(INPUT_POST, 'telefono'));
                $myViaje->settipoViaje(filter_input(INPUT_POST, 'tipoViaje'));
                $myViaje->setUbicacion(filter_input(INPUT_POST, 'Ubicacion'));
                if ($action == "add_viaje") {
                    $myViajeBo->add($myViaje);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_viaje") {
                    $myViajeBo->update($myViaje);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_viaje") {//accion de consultar todos los registros
            $resultDB   = $myViajeBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_viaje") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myViaje->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myViaje = $myViajeBo->searchById($myViaje);
                if ($myViaje != null) {
                    echo json_encode(($myViaje));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_viaje") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myViaje->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myViajeBo->delete($myViaje);
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
