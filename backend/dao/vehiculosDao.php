<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/vehiculos.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class VehiculoDao {

    
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

    public function add(Vehiculo $vehiculo) {
        try {
            $sql = sprintf("insert into travelSiteDB.vehiculo (Placa, Annio, Modelo, Color, Puntuacion, Estado, Ubicacion_actual) 
                                          values (%s,%s,%s,%s,%s,%s,point(%s,%s))",
                    $this->labAdodb->Param("Placa"),
                    $this->labAdodb->Param("Annio"),
                    $this->labAdodb->Param("Modelo"),
                    $this->labAdodb->Param("Color"),
                    $this->labAdodb->Param("Puntuacion"),
                    $this->labAdodb->Param("Estado"),
                    $this->labAdodb->Param("lat"),
                    $this->labAdodb->Param("long"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Placa"]       = $vehiculo->getPlaca();
            $valores["Annio"]       = $vehiculo->getAnnio();
            $valores["Modelo"]      = $vehiculo->getModelo();
            $valores["Color"]       = $vehiculo->getColor();
            $valores["Puntuacion"]  = $vehiculo->getPuntuacion();
            $valores["Estado"]      = $vehiculo->getEstado();
            $valores["lat"]         = $vehiculo->getUbicacion_actual()[0];
            $valores["long"]        = $vehiculo->getUbicacion_actual()[1];

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase VehiculoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Vehiculo $vehiculo) {
        $exist = false;
        try {
            $sql = sprintf("select * from travelSiteDB.Vehiculo where  Placa = %s ",
                            $this->labAdodb->Param("Placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["Placa"] = $vehiculo->getPlaca();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase VehiculoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Vehiculo $vehiculo) {
        try {
            $sql = sprintf("update Vehiculo set Placa = %s,
                                                Annio = %s,
                                                Modelo = %s,
                                                Color = %s, 
                                                Puntuacion = %s, 
                                                Estado = %s,
                                                Ubicacion_actual = point(%s,%s)
                            where Placa = %s",
                    $this->labAdodb->Param("Annio"),
                    $this->labAdodb->Param("Modelo"),
                    $this->labAdodb->Param("Color"),
                    $this->labAdodb->Param("Puntuacion"),
                    $this->labAdodb->Param("Estado"),
                    $this->labAdodb->Param("Ubicacion_actual"),
                    $this->labAdodb->Param("Placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Annio"]               = $vehiculo->getAnnio();
            $valores["Modelo"]              = $vehiculo->getModelo();
            $valores["Color"]               = $vehiculo->getColor();
            $valores["Puntuacion"]          = $vehiculo->getPuntuacion();
            $valores["Estado"]              = $vehiculo->getEstado();
            $valores["Ubicacion_actual"]    = $vehiculo->getUbicacion_actual();
            $valores["Placa"]               = $vehiculo->getPlaca();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase VehiculoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Vehiculo $vehiculo) {

        
        try {
            $sql = sprintf("delete from Vehiculo where  Placa = %s",
                            $this->labAdodb->Param("Placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["Placa"] = $vehiculo->getPlaca();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase VehiculoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Vehiculo $vehiculo) {
        $returnVehiculo = null;
        try {
            $sql = sprintf("select * from Vehiculo where  Placa = %s",
                            $this->labAdodb->Param("Placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["Placa"] = $vehiculo->Placa();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnVehiculo = Vehiculo::createNullVehiculo();
                $returnVehiculo->setPlaca($resultSql->Fields("Placa"));
                $returnVehiculo->setAnnio($resultSql->Fields("Annio"));
                $returnVehiculo->setModelo($resultSql->Fields("Modelo"));
                $returnVehiculo->setColor($resultSql->Fields("Color"));
                $returnVehiculo->setPuntuacion($resultSql->Fields("Puntuacion"));
                $returnVehiculo->setEstado($resultSql->Fields("Estado"));
                $returnVehiculo->setUbicacion_actual($resultSql->Fields("Ubicacion_actual"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase VehiculoDao), error:'.$e->getMessage());
        }
        return $returnVehiculo;
    }

    //***********************************************************
    //obtiene la información de las vehiculo en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from travelSiteDB.vehiculo");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase VehiculoDao), error:'.$e->getMessage());
        }
    }

}
