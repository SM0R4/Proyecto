<?php


require_once("../domain/facturas.php");
require_once("../dao/facturasDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class FacturaBo {

    private $facturaDao;

    public function __construct() {
        $this->facturaDao = new FacturaDao();
    }

    public function getFacturaDao() {
        return $this->facturaDao;
    }

    public function setFacturaDao(FacturaDao $facturaDao) {
        $this->facturaDao = $facturaDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Factura $factura) {
        try {
            if (!$this->facturaDao->exist($factura)) {
                $this->facturaDao->add($factura);
            } else {
                throw new Exception("El Factura ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una persona a la base de datos
    //***********************************************************

    public function update(Factura $factura) {
        try {
            $this->facturaDao->update($factura);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Factura $factura) {
        try {
            $this->facturaDao->delete($factura);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Factura $factura) {
        try {
            return $this->facturaDao->searchById($factura);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las facturas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->facturaDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class FacturaBo
?>