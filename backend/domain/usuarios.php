<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Usuario extends BaseDomain implements \JsonSerializable{

    //attributes
    private $PK_Username;
    private $nombre;
    private $contrasena;
    private $apellido1;
    private $apellido2;
    private $email;
    private $fecNacimiento;
    private $telefono;
    private $tipoUsuario;
    private $Ubicacion;
    private $sexo;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullUsuario() {
        $instance = new self();
        return $instance;
    }

    public static function createUsuario($PK_Username, $nombre, $contrasena, $apellido1, $apellido2, $email, $fecNacimiento, $sexo, $telefono, $tipoUsuario, $Ubicacion) {
        $instance = new self();
        $instance->PK_Username        = $PK_Username;
        $instance->nombre           = $nombre;
        $instance->contrasena       = $contrasena;
        $instance->apellido1        = $apellido1;
        $instance->apellido2        = $apellido2;
        $instance->email            = $email;
        $instance->fecNacimiento    = $fecNacimiento;
        $instance->sexo             = $sexo;
        $instance->telefono         = $telefono;
        $instance->tipoUsuario      = $tipoUsuario;
        $instance->Ubicacion        = $Ubicacion;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPK_Username() {
        return $this->PK_Username;
    }

    public function setPK_Username($PK_Username){
        $this->PK_Username = $PK_Username;
    }

    /****************************************************************************/

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /****************************************************************************/

    public function getcontrasena() {
        return $this->contrasena;
    }

    public function setcontrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    /****************************************************************************/

    public function getemail() {
        return $this->email;
    }

    public function setemail($email) {
        $this->email = $email;
    }

    /****************************************************************************/

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    /****************************************************************************/

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    /****************************************************************************/

    public function getFecNacimiento() {
        return $this->fecNacimiento;
    }

    public function setFecNacimiento($fecNacimiento) {
        $this->fecNacimiento = $fecNacimiento;
    }

    /****************************************************************************/

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    /****************************************************************************/

    public function gettelefono() {
        return $this->telefono;
    }

    public function settelefono($telefono) {
        $this->telefono = $telefono;
    }

    /****************************************************************************/

    public function gettipoUsuario() {
        return $this->tipoUsuario;
    }

    public function settipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    /****************************************************************************/

    public function getUbicacion() {
        return $this->Ubicacion;
    }

    public function setUbicacion($Ubicacion) {
        $this->Ubicacion = $Ubicacion;
    }

    /****************************************************************************/


    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}