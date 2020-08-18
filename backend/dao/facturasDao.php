<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/facturas.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class FacturaDao {

    
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

    public function add(Factura $factura) {
        try {
            $sql = sprintf("insert into travelSiteDB.factura (Historial_viajes_idViaje, Descripcion) 
                                          values (%s,%s)",
                    $this->labAdodb->Param("Historial_viajes_idViaje"),
                    $this->labAdodb->Param("Descripcion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Historial_viajes_idViaje"]    = $factura->getHistorial_viajes_idViaje();
            $valores["Descripcion"]                 = $factura->getDescripcion();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase FacturaDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Factura $factura) {
        $exist = false;
        try {
            $sql = sprintf("select * from travelSiteDB.Factura where  idFactura = %s ",
                            $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idFactura"] = $factura->getidFactura();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase FacturaDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Factura $factura) {
        try {
            $sql = sprintf("update Factura set idFactura = %s,
                                                Historial_viajes_idViaje = %s,
                                                Descripcion = %s
                            where idFactura = %s",
                    $this->labAdodb->Param("Historial_viajes_idViaje"),
                    $this->labAdodb->Param("Descripcion"),
                    $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Historial_viajes_idViaje"]    = $factura->getHistorial_viajes_idViaje();
            $valores["Descripcion"]                 = $factura->getDescripcion();
            $valores["idFactura"]                   = $factura->getidFactura();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase FacturaDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Factura $factura) {

        
        try {
            $sql = sprintf("delete from Factura where  idFactura = %s",
                            $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["idFactura"] = $factura->getidFactura();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase FacturaDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Factura $factura) {
        $returnFactura = null;
        try {
            $sql = sprintf("select * from Factura where  idFactura = %s",
                            $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idFactura"] = $factura->idFactura();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnFactura = Factura::createNullFactura();
                $returnFactura->setidFactura($resultSql->Fields("idFactura"));
                $returnFactura->setHistorial_viajes_idViaje($resultSql->Fields("Historial_viajes_idViaje"));
                $returnFactura->setDescripcion($resultSql->Fields("Descripcion"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase FacturaDao), error:'.$e->getMessage());
        }
        return $returnFactura;
    }

    //***********************************************************
    //obtiene la información de las factura en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from travelSiteDB.factura");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase FacturaDao), error:'.$e->getMessage());
        }
    }

}
