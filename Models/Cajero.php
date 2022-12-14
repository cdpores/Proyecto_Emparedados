<?php 
require_once('Conexion.php');

class Cajero extends Conexion{

  public function __construct(){
    $this->db=parent::__construct();
  }

  public function agregar($idCajero, $nombreCajero, $apellidoCajero, $direccionCajero, $telefonoCajero, $numeroTipoDoc, $idTipoDoc_FK){
    $agregar=$this->db->prepare("INSERT INTO  Cajero (idCajero, nombreCajero, apellidoCajero, direccionCajero, telefonoCajero, numeroTipoDoc, idTipoDoc_FK) VALUES (:idCajero, :nombreCajero, :apellidoCajero, :direccionCajero, :telefonoCajero, :numeroTipoDoc, :idTipoDoc_FK);");
    $agregar->bindparam(':idCajero', $idCajero);
    $agregar->bindparam(':nombreCajero', $nombreCajero);
    $agregar->bindparam(':apellidoCajero', $apellidoCajero);
    $agregar->bindparam(':direccionCajero', $direccionCajero);
    $agregar->bindparam(':telefonoCajero', $telefonoCajero);
    $agregar->bindparam(':numeroTipoDoc', $numeroTipoDoc);
    $agregar->bindparam(':idTipoDoc_FK', $idTipoDoc_FK);
    
    
    if($agregar->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function consultar(){
    $rows=null;
    $mostrar=$this->db->prepare("SELECT *from Cajero as c join TipoDoc as td on c.idTipoDoc_FK=td.idTipoDoc; join Usuario as u on u.idUsuario=c.idUsuario_FK;");
    $mostrar->execute();
    while($result=$mostrar->fetch()){
      $rows[]=$result;
    }
    return $rows;
  }

  public function consultarxid($idCajero){
    $rows=null;
    $mostrar=$this->db->prepare("SELECT * FROM Cajero AS cj JOIN TipoDoc AS tp ON cj.idTipoDoc_FK=tp.idTipoDoc WHERE idCajero=:idCajero;");
    $mostrar->bindparam(':idCajero', $idCajero);
    $mostrar->execute();
    while($result=$mostrar->fetch()){
      $rows[]=$result;
    }
    return $rows;
  }

  public function verUs($idCajero){
    $rows=null;
    $mostrar=$this->db->prepare("SELECT * FROM Cajero AS c JOIN usuario AS u ON u.idUsuario=c.idUsuario_FK JOIN TipoDoc AS tp ON c.idTipoDoc_FK=tp.idTipoDoc WHERE c.idCajero=:idCajero;");
    $mostrar->bindparam(':idCajero', $idCajero);
    $mostrar->execute();
    while($result=$mostrar->fetch()){
      $rows[]=$result;
    }
    return $rows;
  }

  public function actualizar($idCajero, $nombreCajero, $apellidoCajero, $direccionCajero, $telefonoCajero, $numeroTipoDoc, $idTipoDoc_FK){
    $editar=$this->db->prepare("UPDATE Cajero SET idCajero=:idCajero, nombreCajero=:nombreCajero, apellidoCajero=:apellidoCajero, direccionCajero=:direccionCajero, telefonoCajero=:telefonoCajero, numeroTipoDoc=:numeroTipoDoc, idTipoDoc_FK=:idTipoDoc_FK WHERE idCajero=:idCajero;");
    $editar->bindparam(':idCajero', $idCajero);
    $editar->bindparam(':nombreCajero', $nombreCajero);
    $editar->bindparam(':apellidoCajero', $apellidoCajero);
    $editar->bindparam(':direccionCajero', $direccionCajero);
    $editar->bindparam(':telefonoCajero', $telefonoCajero);
    $editar->bindparam(':numeroTipoDoc', $numeroTipoDoc);
    $editar->bindparam(':idTipoDoc_FK', $idTipoDoc_FK);  
    if($editar->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function delete($id){
    $rows=null;
    $eliminar=$this->db->prepare("DELETE FROM Cajero WHERE idCajero=:id");
    $eliminar->bindparam(':id', $id);
    $eliminar->execute();
    if($eliminar->execute()){
      return true;
    }else{
      return false;
    }
  }


}
?>