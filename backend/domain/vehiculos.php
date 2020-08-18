<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Vehiculo extends BaseDomain implements \JsonSerializable{

    //attributes
    private $Placa;
    private $Annio;
    private $Modelo;
    private $Color;
    private $Puntuacion;
    private $Estado;
    private $Ubicacion_actual;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullVehiculo() {
        $instance = new self();
        return $instance;
    }

    public static function createVehiculo($Placa, $Annio, $Modelo, $Color, $Puntuacion, $Estado, $Ubicacion_actual) {
        $instance = new self();
        $instance->Placa                = $Placa;
        $instance->Annio                = $Annio;
        $instance->Modelo               = $Modelo;
        $instance->Color                = $Color;
        $instance->Puntuacion           = $Puntuacion;
        $instance->Estado               = $Estado;
        $instance->Ubicacion_actual     = $Ubicacion_actual;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPlaca() {
        return $this->Placa;
    }

    public function setPlaca($Placa){
        $this->Placa = $Placa;
    }

    /****************************************************************************/

    public function getAnnio() {
        return $this->Annio;
    }

    public function setAnnio($Annio) {
        $this->Annio = $Annio;
    }

    /****************************************************************************/

    public function getModelo() {
        return $this->Modelo;
    }

    public function setModelo($Modelo) {
        $this->Modelo = $Modelo;
    }

    /****************************************************************************/

    public function getEstado() {
        return $this->Estado;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    /****************************************************************************/

    public function getColor() {
        return $this->Color;
    }

    public function setColor($Color) {
        $this->Color = $Color;
    }

    /****************************************************************************/

    public function getPuntuacion() {
        return $this->Puntuacion;
    }

    public function setPuntuacion($Puntuacion) {
        $this->Puntuacion = $Puntuacion;
    }

    /****************************************************************************/

    public function getUbicacion_actual() {
        return $this->Ubicacion_actual;
    }

    public function setUbicacion_actual($Ubicacion_actual) {
        $this->Ubicacion_actual = $Ubicacion_actual;
    }

    /****************************************************************************/


    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}