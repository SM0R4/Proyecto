<?php

require_once("../../utlis/utils.php");
require_once("../../utlis/config.php");
require_once("../../utlis/connections/uia_agenda.php");
require_once("../domain/personas.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base
//$labAdodb->debug=true;

class PersonasDao {

    public function __construct() {
        
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Personas $personas) {

        global $labAdodb;
        try {
            $sql = sprintf("insert into Personas (PK_cedula, nombre, apellido1, apellido2, fecNacimiento, sexo, observaciones, LASTUSER, LASTMODIFICATION) 
                                          values (%s,%s,%s,%s,%s,%s,%s,%s,CURDATE())",
                    $labAdodb->Param("PK_cedula"),
                    $labAdodb->Param("nombre"),
                    $labAdodb->Param("apellido1"),
                    $labAdodb->Param("apellido2"),
                    $labAdodb->Param("fecNacimiento"),
                    $labAdodb->Param("sexo"),
                    $labAdodb->Param("observaciones"),
                    $labAdodb->Param("LASTUSER"));
            $sqlParam = $labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_cedula"]       = $personas->getPK_cedula();
            $valores["nombre"]          = $personas->getnombre();
            $valores["apellido1"]       = $personas->getapellido1();
            $valores["apellido2"]       = $personas->getapellido2();
            $valores["fecNacimiento"]   = $personas->getfecNacimiento();
            $valores["sexo"]            = $personas->getsexo();
            $valores["observaciones"]   = $personas->getobservaciones();
            $valores["LASTUSER"]        = $personas->getLastUser();

            $labAdodb->Execute($sqlParam, $valores) or die($labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Personas $personas) {

        global $labAdodb;
        $exist = false;
        try {
            $sql = sprintf("select * from Personas where  PK_cedula = %s ",
                            $labAdodb->Param("PK_cedula"));
            $sqlParam = $labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_cedula"] = $personas->getPK_cedula();

            $resultSql = $labAdodb->Execute($sqlParam, $valores) or die($labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Personas $personas) {

        global $labAdodb;
        try {
            $sql = sprintf("update Personas set nombre = %s, 
                                                apellido1 = %s, 
                                                apellido2 = %s, 
                                                fecNacimiento = %s, 
                                                sexo = %s, 
                                                observaciones = %s, 
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                            where PK_cedula = %s",
                    $labAdodb->Param("nombre"),
                    $labAdodb->Param("apellido1"),
                    $labAdodb->Param("apellido2"),
                    $labAdodb->Param("fecNacimiento"),
                    $labAdodb->Param("sexo"),
                    $labAdodb->Param("observaciones"),
                    $labAdodb->Param("LASTUSER"),
                    $labAdodb->Param("PK_cedula"));
            $sqlParam = $labAdodb->Prepare($sql);

            $valores = array();

            $valores["nombre"]          = $personas->getnombre();
            $valores["apellido1"]       = $personas->getapellido1();
            $valores["apellido2"]       = $personas->getapellido2();
            $valores["fecNacimiento"]   = $personas->getfecNacimiento();
            $valores["sexo"]            = $personas->getsexo();
            $valores["observaciones"]   = $personas->getobservaciones();
            $valores["LASTUSER"]        = $personas->getLastUser();
            $valores["PK_cedula"]       = $personas->getPK_cedula();
            $labAdodb->Execute($sqlParam, $valores) or die($labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Personas $personas) {

        global $labAdodb;
        try {
            $sql = sprintf("delete from Personas where  PK_cedula = %s",
                            $labAdodb->Param("PK_cedula"));
            $sqlParam = $labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_cedula"] = $personas->getPK_cedula();

            $labAdodb->Execute($sqlParam, $valores) or die($labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Personas $personas) {

        global $labAdodb;
        $returnPersonas = null;
        try {
            $sql = sprintf("select * from Personas where  PK_cedula = %s",
                            $labAdodb->Param("PK_cedula"));
            $sqlParam = $labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_cedula"] = $personas->getPK_cedula();

            $resultSql = $labAdodb->Execute($sqlParam, $valores) or die($labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnPersonas = Personas::createNullPersonas();
                $returnPersonas->setPK_cedula($resultSql->Fields("PK_cedula"));
                $returnPersonas->setnombre($resultSql->Fields("nombre"));
                $returnPersonas->setapellido1($resultSql->Fields("apellido1"));
                $returnPersonas->setapellido2($resultSql->Fields("apellido2"));
                $returnPersonas->setfecNacimiento($resultSql->Fields("fecNacimiento"));
                $returnPersonas->setsexo($resultSql->Fields("sexo"));
                $returnPersonas->setobservaciones($resultSql->Fields("observaciones"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase PersonasDao), error:'.$e->getMessage());
        }
        return $returnPersonas;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {

        global $labAdodb;
        try {
            $sql = sprintf("select * from Personas");
            $resultSql = $labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

}
