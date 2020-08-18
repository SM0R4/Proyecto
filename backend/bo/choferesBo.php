<?php


require_once("../domain/choferes.php");
require_once("../dao/choferesDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class ChoferBo {

    private $choferDao;

    public function __construct() {
        $this->choferDao = new ChoferDao();
    }

    public function getChoferDao() {
        return $this->choferDao;
    }

    public function setChoferDao(ChoferDao $choferDao) {
        $this->choferDao = $choferDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Chofer $chofer) {
        try {
            if (!$this->choferDao->exist($chofer)) {
                $this->choferDao->add($chofer);
            } else {
                throw new Exception("El Chofer ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una persona a la base de datos
    //***********************************************************

    public function update(Chofer $chofer) {
        try {
            $this->choferDao->update($chofer);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Chofer $chofer) {
        try {
            $this->choferDao->delete($chofer);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Chofer $chofer) {
        try {
            return $this->choferDao->searchById($chofer);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las choferes de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->choferDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class ChoferBo
?>