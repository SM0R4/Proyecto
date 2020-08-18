<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/choferes.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class ChoferDao {

    
    private $labAdodb;//objeto de conexion con la base de datos    
    
    public function __construct() {
        //se crea el objeto con la conexión de la base de datos
        //según los datos del servidor de mysql
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        $this->labAdodb->setCharset('utf8');
        $this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        //los cados de conexión   host,       user,   pass,   basedatos
        $this->labAdodb->Connect("localhost", "root", "MyNewDB2020!", "travelSiteDB");   
        
        //si se desea hacer debug del SQL que se genera en la base de datos
        //dependiendo del error es necesario ver si es un error directamente
        //en la base de datos
        $this->labAdodb->debug=false;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Chofer $chofer) {
        try {
            $sql = sprintf("insert into travelSiteDB.chofer (Cedula, Tipo_licencia, Fecha_Vencimiento_licencia, Actual_chofer, Vehiculo_Placa, Usuario_PK_Username) 
                                          values (%s,%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("Cedula"),
                    $this->labAdodb->Param("Tipo_licencia"),
                    $this->labAdodb->Param("Fecha_Vencimiento_licencia"),
                    $this->labAdodb->Param("Actual_chofer"),
                    $this->labAdodb->Param("Vehiculo_Placa"),
                    $this->labAdodb->Param("Usuario_PK_Username"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Cedula"]              = $chofer->getCedula();
            $valores["Tipo_licencia"]       = $chofer->getTipo_licencia();
            $valores["Fecha_Vencimiento_licencia"]   = $chofer->getFecha_Vencimiento_licencia();
            $valores["Actual_chofer"]       = $chofer->getActual_chofer();
            $valores["Vehiculo_Placa"]      = $chofer->getVehiculo_Placa();
            $valores["Usuario_PK_Username"] = $chofer->getUsuario_PK_Username();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Chofer $chofer) {
        $exist = false;
        try {
            $sql = sprintf("select * from travelSiteDB.Chofer where  Cedula = %s ",
                            $this->labAdodb->Param("Cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["Cedula"] = $chofer->getCedula();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Chofer $chofer) {
        try {
            $sql = sprintf("update Chofer set Cedula = %s,
                                                Tipo_licencia = %s,
                                                Fecha_Vencimiento_licencia = %s,
                                                Actual_chofer = %s, 
                                                Vehiculo_Placa = %s, 
                                                Usuario_PK_Username = %s
                            where Cedula = %s",
                    $this->labAdodb->Param("Tipo_licencia"),
                    $this->labAdodb->Param("Fecha_Vencimiento_licencia"),
                    $this->labAdodb->Param("Actual_chofer"),
                    $this->labAdodb->Param("Vehiculo_Placa"),
                    $this->labAdodb->Param("Usuario_PK_Username"),
                    $this->labAdodb->Param("Cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Tipo_licencia"]       = $chofer->getTipo_licencia();
            $valores["Fecha_Vencimiento_licencia"]   = $chofer->getFecha_Vencimiento_licencia();
            $valores["Actual_chofer"]       = $chofer->getActual_chofer();
            $valores["Vehiculo_Placa"]      = $chofer->getVehiculo_Placa();
            $valores["Usuario_PK_Username"] = $chofer->getUsuario_PK_Username();
            $valores["Cedula"]              = $chofer->getCedula();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Chofer $chofer) {

        
        try {
            $sql = sprintf("delete from Chofer where  Cedula = %s",
                            $this->labAdodb->Param("Cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["Cedula"] = $chofer->getCedula();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Chofer $chofer) {
        $returnChofer = null;
        try {
            $sql = sprintf("select * from Chofer where  Cedula = %s",
                            $this->labAdodb->Param("Cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["Cedula"] = $chofer->Cedula();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnChofer = Chofer::createNullChofer();
                $returnChofer->setCedula($resultSql->Fields("Cedula"));
                $returnChofer->setTipo_licencia($resultSql->Fields("Tipo_licencia"));
                $returnChofer->setFecha_Vencimiento_licencia($resultSql->Fields("Fecha_Vencimiento_licencia"));
                $returnChofer->setActual_chofer($resultSql->Fields("Actual_chofer"));
                $returnChofer->setVehiculo_Placa($resultSql->Fields("Vehiculo_Placa"));
                $returnChofer->setUsuario_PK_Username($resultSql->Fields("Usuario_PK_Username"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase ChoferDao), error:'.$e->getMessage());
        }
        return $returnChofer;
    }

    //***********************************************************
    //obtiene la información de las chofer en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from travelSiteDB.chofer");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

}
