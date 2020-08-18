<?php

require_once("../bo/choferesBo.php");
require_once("../domain/choferes.php");


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
        $myChoferBo = new ChoferBo();
        $myChofer = Chofer::createNullChofer();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_chofer" or $action === "update_chofer") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_Username') != null) && (filter_input(INPUT_POST, 'contrasena') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'email') != null) && (filter_input(INPUT_POST, 'fecNacimiento') != null) && (filter_input(INPUT_POST, 'sexo') != null) && (filter_input(INPUT_POST, 'telefono') != null) && (filter_input(INPUT_POST, 'tipochofer') != null) && (filter_input(INPUT_POST, 'Ubicacion') != null)) {
                $myChofer->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myChofer->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myChofer->setcontrasena(filter_input(INPUT_POST, 'contrasena'));
                $myChofer->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myChofer->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myChofer->setemail(filter_input(INPUT_POST, 'email'));
                $myChofer->setfecNacimiento(filter_input(INPUT_POST, 'fecNacimiento'));
                $myChofer->setsexo(filter_input(INPUT_POST, 'sexo'));
                $myChofer->settelefono(filter_input(INPUT_POST, 'telefono'));
                $myChofer->settipoChofer(filter_input(INPUT_POST, 'tipoChofer'));
                $myChofer->setUbicacion(filter_input(INPUT_POST, 'Ubicacion'));
                if ($action == "add_chofer") {
                    $myChoferBo->add($myChofer);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_chofer") {
                    $myChoferBo->update($myChofer);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_chofer") {//accion de consultar todos los registros
            $resultDB   = $myChoferBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_chofer") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myChofer->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myChofer = $myChoferBo->searchById($myChofer);
                if ($myChofer != null) {
                    echo json_encode(($myChofer));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_chofer") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myChofer->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myChoferBo->delete($myChofer);
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
