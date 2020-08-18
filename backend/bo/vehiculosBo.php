<?php


require_once("../domain/vehiculos.php");
require_once("../dao/vehiculosDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class VehiculoBo {

    private $vehiculoDao;

    public function __construct() {
        $this->vehiculoDao = new VehiculoDao();
    }

    public function getVehiculoDao() {
        return $this->vehiculoDao;
    }

    public function setVehiculoDao(VehiculoDao $vehiculoDao) {
        $this->vehiculoDao = $vehiculoDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Vehiculo $vehiculo) {
        try {
            if (!$this->vehiculoDao->exist($vehiculo)) {
                $this->vehiculoDao->add($vehiculo);
            } else {
                throw new Exception("El Vehiculo ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una persona a la base de datos
    //***********************************************************

    public function update(Vehiculo $vehiculo) {
        try {
            $this->vehiculoDao->update($vehiculo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Vehiculo $vehiculo) {
        try {
            $this->vehiculoDao->delete($vehiculo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Vehiculo $vehiculo) {
        try {
            return $this->vehiculoDao->searchById($vehiculo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las vehiculos de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->vehiculoDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class VehiculoBo
?>