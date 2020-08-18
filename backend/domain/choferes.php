<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Chofer extends BaseDomain implements \JsonSerializable{

    //attributes
    private $Cedula;
    private $Tipo_licencia;
    private $Fecha_Vencimiento_licencia;
    private $Actual_chofer;
    private $Vehiculo_Placa;
    private $Usuario_PK_Username;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullChofer() {
        $instance = new self();
        return $instance;
    }

    public static function createChofer($Cedula, $Tipo_licencia, $Fecha_Vencimiento_licencia, $Actual_chofer, $Vehiculo_Placa, $Usuario_PK_Username) {
        $instance = new self();
        $instance->Cedula                       = $Cedula;
        $instance->Tipo_licencia                = $Tipo_licencia;
        $instance->Fecha_Vencimiento_licencia   = $Fecha_Vencimiento_licencia;
        $instance->Actual_chofer                = $Actual_chofer;
        $instance->Vehiculo_Placa               = $Vehiculo_Placa;
        $instance->Usuario_PK_Username          = $Usuario_PK_Username;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getCedula() {
        return $this->Cedula;
    }

    public function setCedula($Cedula){
        $this->Cedula = $Cedula;
    }

    /****************************************************************************/

    public function getTipo_licencia() {
        return $this->Tipo_licencia;
    }

    public function setTipo_licencia($Tipo_licencia) {
        $this->Tipo_licencia = $Tipo_licencia;
    }

    /****************************************************************************/

    public function getFecha_Vencimiento_licencia() {
        return $this->Fecha_Vencimiento_licencia;
    }

    public function setFecha_Vencimiento_licencia($Fecha_Vencimiento_licencia) {
        $this->Fecha_Vencimiento_licencia = $Fecha_Vencimiento_licencia;
    }

    /****************************************************************************/

    public function getUsuario_PK_Username() {
        return $this->Usuario_PK_Username;
    }

    public function setUsuario_PK_Username($Usuario_PK_Username) {
        $this->Usuario_PK_Username = $Usuario_PK_Username;
    }

    /****************************************************************************/

    public function getActual_chofer() {
        return $this->Actual_chofer;
    }

    public function setActual_chofer($Actual_chofer) {
        $this->Actual_chofer = $Actual_chofer;
    }

    /****************************************************************************/

    public function getVehiculo_Placa() {
        return $this->Vehiculo_Placa;
    }

    public function setVehiculo_Placa($Vehiculo_Placa) {
        $this->Vehiculo_Placa = $Vehiculo_Placa;
    }

   

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}