<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/usuarios.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class UsuarioDao {

    
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

    public function add(Usuario $usuario) {
        try {
            $sql = sprintf("insert into travelSiteDB.usuario (PK_Username, nombre, contrasena, apellido1, apellido2, email, fecNacimiento, telefono, tipoUsuario, Ubicacion, sexo) 
                                          values (%s,%s,%s,%s,%s,%s,%s,%s,%s,point(%s,%s),%s)",
                    $this->labAdodb->Param("PK_Username"),
                    $this->labAdodb->Param("nombre"),
                    $this->labAdodb->Param("contrasena"),
                    $this->labAdodb->Param("apellido1"),
                    $this->labAdodb->Param("apellido2"),
                    $this->labAdodb->Param("email"),
                    $this->labAdodb->Param("fecNacimiento"),
                    $this->labAdodb->Param("telefono"),
                    $this->labAdodb->Param("tipoUsuario"),
                    $this->labAdodb->Param("lat"),
                    $this->labAdodb->Param("long"),
                    $this->labAdodb->Param("sexo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_Username"]     = $usuario->getPK_Username();
            $valores["nombre"]          = $usuario->getnombre();
            $valores["contrasena"]      = $usuario->getcontrasena();
            $valores["apellido1"]       = $usuario->getapellido1();
            $valores["apellido2"]       = $usuario->getapellido2();
            $valores["email"]           = $usuario->getemail();
            $valores["fecNacimiento"]   = $usuario->getfecNacimiento();
            $valores["telefono"]        = $usuario->gettelefono();
            $valores["tipoUsuario"]     = $usuario->gettipoUsuario();
            $valores["lat"]             = $usuario->getUbicacion()[0];
            $valores["long"]            = $usuario->getUbicacion()[1];
            $valores["sexo"]            = $usuario->getsexo();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase UsuarioDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Usuario $usuario) {
        $exist = false;
        try {
            $sql = sprintf("select * from travelSiteDB.Usuario where  PK_Username = %s ",
                            $this->labAdodb->Param("PK_Username"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_Username"] = $usuario->getPK_Username();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase UsuarioDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Usuario $usuario) {
        try {
            $sql = sprintf("update Usuario set PK_Username = %s,
                                                nombre = %s,
                                                contrasena = %s,
                                                apellido1 = %s, 
                                                apellido2 = %s, 
                                                email = %s, 
                                                fecNacimiento = %s, 
                                                telefono = %s,  
                                                tipoUsuario = %s, 
                                                Ubicacion = point(%s,%s), 
                                                sexo = %s
                            where PK_Username = %s",
                    $this->labAdodb->Param("nombre"),
                    $this->labAdodb->Param("contrasena"),
                    $this->labAdodb->Param("apellido1"),
                    $this->labAdodb->Param("apellido2"),
                    $this->labAdodb->Param("email"),
                    $this->labAdodb->Param("fecNacimiento"),
                    $this->labAdodb->Param("telefono"),
                    $this->labAdodb->Param("tipoUsuario"),
                    $this->labAdodb->Param("Ubicacion"),
                    $this->labAdodb->Param("sexo"),
                    $this->labAdodb->Param("PK_Username"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["nombre"]          = $usuario->getnombre();
            $valores["contrasena"]      = $usuario->getcontrasena();
            $valores["apellido1"]       = $usuario->getapellido1();
            $valores["apellido2"]       = $usuario->getapellido2();
            $valores["email"]           = $usuario->getemail();
            $valores["fecNacimiento"]   = $usuario->getfecNacimiento();
            $valores["telefono"]        = $usuario->gettelefono();
            $valores["tipoUsuario"]     = $usuario->gettipoUsuario();
            $valores["Ubicacion"]       = $usuario->getUbicacion();
            $valores["sexo"]            = $usuario->getsexo();
            $valores["PK_Username"]       = $usuario->getPK_Username();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase UsuarioDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Usuario $usuario) {

        
        try {
            $sql = sprintf("delete from Usuario where  PK_Username = %s",
                            $this->labAdodb->Param("PK_Username"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["PK_Username"] = $usuario->getPK_Username();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase UsuarioDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Usuario $usuario) {
        $returnUsuario = null;
        try {
            $sql = sprintf("select * from Usuario where  PK_Username = %s",
                            $this->labAdodb->Param("PK_Username"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_Username"] = $usuario->PK_Username();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnUsuario = Usuario::createNullUsuario();
                $returnUsuario->setPK_Username($resultSql->Fields("PK_Username"));
                $returnUsuario->setnombre($resultSql->Fields("nombre"));
                $returnUsuario->setcontrasena($resultSql->Fields("contrasena"));
                $returnUsuario->setapellido1($resultSql->Fields("apellido1"));
                $returnUsuario->setapellido2($resultSql->Fields("apellido2"));
                $returnUsuario->setemail($resultSql->Fields("email"));
                $returnUsuario->setfecNacimiento($resultSql->Fields("fecNacimiento"));
                $returnUsuario->settelefono($resultSql->Fields("telefono"));
                $returnUsuario->settipoUsuario($resultSql->Fields("tipoUsuario"));
                $returnUsuario->setUbicacion($resultSql->Fields("Ubicacion"));
                $returnUsuario->setsexo($resultSql->Fields("sexo"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase UsuarioDao), error:'.$e->getMessage());
        }
        return $returnUsuario;
    }

    //***********************************************************
    //obtiene la información de las usuario en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from travelSiteDB.usuario");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase UsuarioDao), error:'.$e->getMessage());
        }
    }

}
