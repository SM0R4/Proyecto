<?php


require_once("../domain/viajes.php");
require_once("../dao/viajesDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class ViajeBo {

    private $viajeDao;

    public function __construct() {
        $this->viajeDao = new ViajeDao();
    }

    public function getViajeDao() {
        return $this->viajeDao;
    }

    public function setViajeDao(ViajeDao $viajeDao) {
        $this->viajeDao = $viajeDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Viaje $viaje) {
        try {
            if (!$this->viajeDao->exist($viaje)) {
                $this->viajeDao->add($viaje);
            } else {
                throw new Exception("El Viaje ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una persona a la base de datos
    //***********************************************************

    public function update(Viaje $viaje) {
        try {
            $this->viajeDao->update($viaje);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Viaje $viaje) {
        try {
            $this->viajeDao->delete($viaje);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Viaje $viaje) {
        try {
            return $this->viajeDao->searchById($viaje);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las viajes de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->viajeDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class ViajeBo
?>