<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Viaje extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idViaje;
    private $Fecha;
    private $Ubicacion_final;
    private $Tiempo_llegada_punto_inicio;
    private $Tiempo_viaje;
    private $Costo;
    private $Chofer_Cedula;
    private $Usuario_PK_Username;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullViaje() {
        $instance = new self();
        return $instance;
    }

    public static function createViaje($Fecha, $Ubicacion_final, $Tiempo_llegada_punto_inicio, $Tiempo_viaje, $Costo, $Chofer_Cedula, $Usuario_PK_Username) {
        $instance = new self();
        $instance->Fecha                        = $Fecha;
        $instance->Ubicacion_final              = $Ubicacion_final;
        $instance->Tiempo_llegada_punto_inicio  = $Tiempo_llegada_punto_inicio;
        $instance->Tiempo_viaje                 = $Tiempo_viaje;
        $instance->Costo                        = $Costo;
        $instance->Chofer_Cedula                = $Chofer_Cedula;
        $instance->Usuario_PK_Username          = $Usuario_PK_Username;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getidViaje() {
        return $this->idViaje;
    }

    public function setidViaje($idViaje){
        $this->idViaje = $idViaje;
    }

    /****************************************************************************/

    public function getFecha() {
        return $this->Fecha;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    /****************************************************************************/

    public function getUbicacion_final() {
        return $this->Ubicacion_final;
    }

    public function setUbicacion_final($Ubicacion_final) {
        $this->Ubicacion_final = $Ubicacion_final;
    }

    /****************************************************************************/

    public function getCosto() {
        return $this->Costo;
    }

    public function setCosto($Costo) {
        $this->Costo = $Costo;
    }

    /****************************************************************************/

    public function getTiempo_llegada_punto_inicio() {
        return $this->Tiempo_llegada_punto_inicio;
    }

    public function setTiempo_llegada_punto_inicio($Tiempo_llegada_punto_inicio) {
        $this->Tiempo_llegada_punto_inicio = $Tiempo_llegada_punto_inicio;
    }

    /****************************************************************************/

    public function getTiempo_viaje() {
        return $this->Tiempo_viaje;
    }

    public function setTiempo_viaje($Tiempo_viaje) {
        $this->Tiempo_viaje = $Tiempo_viaje;
    }

    /****************************************************************************/

    public function getChofer_Cedula() {
        return $this->Chofer_Cedula;
    }

    public function setChofer_Cedula($Chofer_Cedula) {
        $this->Chofer_Cedula = $Chofer_Cedula;
    }

    /****************************************************************************/

    public function getUsuario_PK_Username() {
        return $this->Usuario_PK_Username;
    }

    public function setUsuario_PK_Username($Usuario_PK_Username) {
        $this->Usuario_PK_Username = $Usuario_PK_Username;
    }

    /****************************************************************************/


    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}