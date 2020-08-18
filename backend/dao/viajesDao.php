<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/viajes.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class ViajeDao {

    
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

    public function add(Viaje $viaje) {
        try {
            $sql = sprintf("insert into travelSiteDB.Historial_viajes (Fecha, Ubicacion_final, Tiempo_llegada_punto_inicio, Tiempo_viaje, Costo, Chofer_Cedula, Usuario_PK_Username) 
                                          values (%s,point(%s,%s),%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("Fecha"),
                    $this->labAdodb->Param("lat"),
                    $this->labAdodb->Param("long"),
                    $this->labAdodb->Param("Tiempo_llegada_punto_inicio"),
                    $this->labAdodb->Param("Tiempo_viaje"),
                    $this->labAdodb->Param("Costo"),
                    $this->labAdodb->Param("Chofer_Cedula"),
                    $this->labAdodb->Param("Usuario_PK_Username"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Fecha"]                           = $viaje->getFecha();
            $valores["lat"]                             = $viaje->getUbicacion_final()[0];
            $valores["long"]                            = $viaje->getUbicacion_final()[1];
            $valores["Tiempo_llegada_punto_inicio"]     = $viaje->getTiempo_llegada_punto_inicio();
            $valores["Tiempo_viaje"]                    = $viaje->getTiempo_viaje();
            $valores["Costo"]                           = $viaje->getCosto();
            $valores["Chofer_Cedula"]                   = $viaje->getChofer_Cedula();
            $valores["Usuario_PK_Username"]             = $viaje->getUsuario_PK_Username();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Viaje $viaje) {
        $exist = false;
        try {
            $sql = sprintf("select * from travelSiteDB.Historial_viajes where  idViaje = %s ",
                            $this->labAdodb->Param("idViaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idViaje"] = $viaje->getidViaje();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Viaje $viaje) {
        try {
            $sql = sprintf("update Historial_viajes set idViaje = %s,
                                                Fecha = %s,
                                                Ubicacion_final = point(%s,%s),
                                                Tiempo_llegada_punto_inicio = %s, 
                                                Tiempo_viaje = %s, 
                                                Costo = %s, 
                                                Chofer_Cedula = %s, 
                                                Usuario_PK_Username = %s
                            where idViaje = %s",
                    $this->labAdodb->Param("Fecha"),
                    $this->labAdodb->Param("Ubicacion_final"),
                    $this->labAdodb->Param("Tiempo_llegada_punto_inicio"),
                    $this->labAdodb->Param("Tiempo_viaje"),
                    $this->labAdodb->Param("Costo"),
                    $this->labAdodb->Param("Chofer_Cedula"),
                    $this->labAdodb->Param("Usuario_PK_Username"),
                    $this->labAdodb->Param("idViaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Fecha"]                       = $viaje->getFecha();
            $valores["Ubicacion_final"]             = $viaje->getUbicacion_final();
            $valores["Tiempo_llegada_punto_inicio"] = $viaje->getTiempo_llegada_punto_inicio();
            $valores["Tiempo_viaje"]                = $viaje->getTiempo_viaje();
            $valores["Costo"]                       = $viaje->getCosto();
            $valores["Chofer_Cedula"]               = $viaje->getChofer_Cedula();
            $valores["Usuario_PK_Username"]         = $viaje->getUsuario_PK_Username();
            $valores["idViaje"]                     = $viaje->getidViaje();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Viaje $viaje) {

        
        try {
            $sql = sprintf("delete from Historial_viajes where  idViaje = %s",
                            $this->labAdodb->Param("idViaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["idViaje"] = $viaje->getidViaje();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Viaje $viaje) {
        $returnViaje = null;
        try {
            $sql = sprintf("select * from Historial_viajes where  idViaje = %s",
                            $this->labAdodb->Param("idViaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idViaje"] = $viaje->idViaje();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnViaje = Viaje::createNullViaje();
                $returnViaje->setidViaje($resultSql->Fields("idViaje"));
                $returnViaje->setFecha($resultSql->Fields("Fecha"));
                $returnViaje->setUbicacion_final($resultSql->Fields("Ubicacion_final"));
                $returnViaje->setTiempo_llegada_punto_inicio($resultSql->Fields("Tiempo_llegada_punto_inicio"));
                $returnViaje->setTiempo_viaje($resultSql->Fields("Tiempo_viaje"));
                $returnViaje->setCosto($resultSql->Fields("Costo"));
                $returnViaje->setChofer_Cedula($resultSql->Fields("Chofer_Cedula"));
                $returnViaje->setUsuario_PK_Username($resultSql->Fields("Usuario_PK_Username"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase ViajeDao), error:'.$e->getMessage());
        }
        return $returnViaje;
    }

    //***********************************************************
    //obtiene la información de las viaje en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from travelSiteDB.Historial_viajes");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

}
