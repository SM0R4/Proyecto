<?php

require_once("../bo/usuariosBo.php");
require_once("../domain/usuarios.php");


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
        $myUsuarioBo = new UsuarioBo();
        $myUsuario = Usuario::createNullUsuario();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_usuario" or $action === "update_usuario") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_Username') != null) && (filter_input(INPUT_POST, 'contrasena') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'email') != null) && (filter_input(INPUT_POST, 'fecNacimiento') != null) && (filter_input(INPUT_POST, 'sexo') != null) && (filter_input(INPUT_POST, 'telefono') != null) && (filter_input(INPUT_POST, 'tipousuario') != null) && (filter_input(INPUT_POST, 'Ubicacion') != null)) {
                $myUsuario->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myUsuario->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myUsuario->setcontrasena(filter_input(INPUT_POST, 'contrasena'));
                $myUsuario->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myUsuario->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myUsuario->setemail(filter_input(INPUT_POST, 'email'));
                $myUsuario->setfecNacimiento(filter_input(INPUT_POST, 'fecNacimiento'));
                $myUsuario->setsexo(filter_input(INPUT_POST, 'sexo'));
                $myUsuario->settelefono(filter_input(INPUT_POST, 'telefono'));
                $myUsuario->settipoUsuario(filter_input(INPUT_POST, 'tipoUsuario'));
                $myUsuario->setUbicacion(filter_input(INPUT_POST, 'Ubicacion'));
                if ($action == "add_usuario") {
                    $myUsuarioBo->add($myUsuario);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_usuario") {
                    $myUsuarioBo->update($myUsuario);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_usuario") {//accion de consultar todos los registros
            $resultDB   = $myUsuarioBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_usuario") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myUsuario->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myUsuario = $myUsuarioBo->searchById($myUsuario);
                if ($myUsuario != null) {
                    echo json_encode(($myUsuario));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_usuario") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Username') != null) {
                $myUsuario->setPK_Username(filter_input(INPUT_POST, 'PK_Username'));
                $myUsuarioBo->delete($myUsuario);
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
