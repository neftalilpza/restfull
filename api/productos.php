<?php
///include_once '../clases/producto.php';
//echo 'Informacion: '. file_get_contents('php://input');

class ProductoAPI {

    public function API() {
        require_once ("./modelo/producto_modelo.php");       
        header("Content-Type: application/json");        
    switch ($_SERVER['REQUEST_METHOD']) {

            case 'POST'://guardar
               $_POST = json_decode(file_get_contents('php://input'), true);        
              
                $producto = new Producto();
                $producto->setDescripcion($_POST['descripcion']);
                $producto->setCategoria($_POST['categoria']);
                $producto->setPrecioUnitario($_POST['precio_unitario']);
                $producto->setExistencia($_POST['existencia']);
                $agregar= $producto->guardarProducto();  

                 /* Devololvemos los datos agregados*/
                 $input =array('datos'=>file_get_contents('php://input'));
                 $metodo=array();
                 /* Devololvemos el tipo de solicitud*/
                 $metodo['solicitud']=$_SERVER['REQUEST_METHOD'];                 
                 $metodo['input']=$input;               
                 $info =array();
                 $info['Info']=$metodo;
 
                 echo json_encode($info);
                //return $agregar;           
                break;

            case 'GET'://Obtener
                if (isset($_GET['id'])) {                    
                    $productos = new Producto();
                    $lista_producto= $productos->obtenerProducto($_GET['id']);                    
                    $prducto=array();
                    $producto['Productos']=$lista_producto; 

                    /* Devololvemos el tipo de solicitud*/

                    $metodo=array();
                    $metodo['solicitud']=$_SERVER['REQUEST_METHOD'];
                    $metodo['id']=$_GET['id'];                
                    $producto['Info']=$metodo;
                               
                    echo json_encode($producto);


                        //echo json_encode($producto);
                } else {                   
                      $producto = new Producto();
                      $lista_productos= $producto->obtenerProductos();                     
                      $productos=array();
                      $productos['Productos']=$lista_productos;

                      /* Devololvemos el tipo de solicitud*/
                      $metodo=array();
                      $metodo['solicitud']=$_SERVER['REQUEST_METHOD'];                                 
                      $productos['Info']=$metodo;
                       



                      echo json_encode($productos); 
                      
                      //echo json_encode($productos);
               }

                break;


            case 'PUT': //actualizar            
                $_PUT = json_decode(file_get_contents('php://input'), true);
                $producto = new Producto();
                $producto->setDescripcion($_PUT['descripcion']);
                $producto->setCategoria($_PUT['categoria']);
                $producto->setPrecioUnitario($_PUT['precio_unitario']);
                $producto->setExistencia($_PUT['existencia']);
                $actulizar= $producto->actualizarProducto($_GET['id']);    
                
                /* Devololvemos los datos modificados*/
                $update =array('datos'=>file_get_contents('php://input'));
                $metodo=array();
                /* Devololvemos el tipo de solicitud*/
                $metodo['solicitud']=$_SERVER['REQUEST_METHOD'];
                $metodo['id']=$_GET['id'];
                $metodo['update']=$update;  
                            
                $info =array();
                $info['Info']=$metodo;

                echo json_encode($info);


                
                break;

            case 'DELETE'://eliminar
                $productos = new Producto();
                $eliminar=$productos->eliminarProducto($_GET['id']);
                 
                $metodo=array();
                    $metodo['solicitud']=$_SERVER['REQUEST_METHOD'];
                    $metodo['id']=$_GET['id'];                
                $info=array();
                      $info['Info']=$metodo;
                      
                      echo json_encode($info);  
                break;
                
            default:       //metodo no sosportado        
            echo 'METODO NO SOPORTADO';
            
                break;
        }
        
        
        

        
        
    }

}
