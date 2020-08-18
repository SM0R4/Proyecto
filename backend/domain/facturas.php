<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Factura extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idFactura;
    private $Historial_viajes_idViaje;
    private $Descripcion;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullFactura() {
        $instance = new self();
        return $instance;
    }

    public static function createFactura($Historial_viajes_idViaje, $Descripcion) {
        $instance = new self();
        $instance->Historial_viajes_idViaje     = $Historial_viajes_idViaje;
        $instance->Descripcion                  = $Descripcion;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getidFactura() {
        return $this->idFactura;
    }

    public function setidFactura($idFactura){
        $this->idFactura = $idFactura;
    }

    /****************************************************************************/

    public function getHistorial_viajes_idViaje() {
        return $this->Historial_viajes_idViaje;
    }

    public function setHistorial_viajes_idViaje($Historial_viajes_idViaje) {
        $this->Historial_viajes_idViaje = $Historial_viajes_idViaje;
    }

    /****************************************************************************/

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    /****************************************************************************/


    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}