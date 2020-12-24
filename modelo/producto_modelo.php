<?php


require_once 'config/database.php';
class Producto extends DatabaseConnection {
    #private $id;
    /* Variables */
    private $descripcion;
    private $categoria;
    private $precio_unitario;
    private $existencia;

    /* Setters y getter */
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;    
    }
  
    public function getCategoria() {
        return $this->categoria;
    }
    public function setCategoria($categoria) {
        $this->categoria = $categoria;      
    }


    public function getPrecioUnitario() {
       return $this->precio_unitario;
    }
    public function setPrecioUnitario($precioUnitario) {
        $this->precio_unitario = $precioUnitario;       
    }  


    public function getExistencia() {
        return $this->existencia;
    }
    public function setExistencia($existencia) {
        $this->existencia = $existencia;       
    }

    
   //CRUD 
   
   /* public function guardarProducto() {  
    $conectar = parent::conexion();
    parent::set_name();
    $sql = "INSERT INTO producto(descripcion, categoria, precio_unitario, existencia)VALUES(
    :descripcion, :categoria, :precio_unitario, :existencia
    );";
    $sentencia = $conectar->prepare($sql);    
    $sentencia->bindValue(":descripcion",$this->descripcion);
    $sentencia->bindValue(":categoria",$this->categoria);
    $sentencia->bindValue(":precio_unitario",$this->precio_unitario);
    $sentencia->bindValue(":existencia",$this->existencia);    
    $excec =  $sentencia->execute();
    if ($excec) {
        # code...
        echo "Se guardo con exito";        
    } else {
        # code...
        echo "No se  guardo con exito";        
    }      
 }  */

     public function guardarProducto() {  
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "INSERT INTO producto(descripcion, categoria, precio_unitario, existencia)VALUES(
        '{$this->descripcion}','{$this->categoria}','{$this->precio_unitario}','{$this->existencia}'
        );";

        $sql = $conectar->prepare($sql);
        $sql->execute();  
     } 
    

     public function obtenerProductos() {       
 $conectar = parent::conexion();
        parent::set_name();
        $sql = "SELECT *  FROM producto ORDER BY id DESC;";
        $sql = $conectar->prepare($sql);
        $sql->execute();        
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    

     public function obtenerProducto($id) {
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "SELECT *  FROM producto WHERE id = $id;";
        $sql = $conectar->prepare($sql);
        $sql->execute() ;         
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
 

     public function actualizarProducto($id) {     
        $conectar = parent::conexion();
        parent::set_name();        
        $sql = "UPDATE producto SET  descripcion=  '{$this->descripcion}', categoria = '{$this->categoria}', 
        precio_unitario = '{$this->precio_unitario}', existencia='{$this->existencia}'"
                . "WHERE id = $id;";
        $sql = $conectar->prepare($sql);
        $sql->execute();                       
    }

 

     public  function eliminarProducto($id) {     
       $conectar = parent::conexion();
        parent::set_name();
        $sql = "DELETE  FROM producto WHERE id = $id;";
        $sql = $conectar->prepare($sql);
        $sql->execute(); 
         
      
            }
     





}
