<?php


class Producto{

    private $idProducto;
    private $nombre; 
    private $detalle; 
    private $cantStock; 
   // private $precio; 
    private $mensaje; 
    private $arregloPrecios=[
        1=>56860,
        7=>36000,
        8=>74560,
        9=>24580,
        10=>35746,
        11=>12900,
        12=>98500,
        13=>6500,
        14=>38750,
        15=>26870
    ];

    // METODO CONSTRUCTOR 
    public function __construct()
    {

        $this->idProducto=0;
        $this->nombre=""; 
        $this->detalle="";
        $this->cantStock=0; 
        $this->mensaje=""; 
        //$this->precio=0; 
    }// fin metodo constructor 

    // METODO SETEAR 
    public function setear ($id,$nombre,$detalle,$stock){
        $this->idProducto=$id;
        $this->nombre=$nombre;
        $this->detalle=$detalle;
        $this->setStock($stock); 
        //$this->precio=$precio; 

    }// fin metodo setear 

    // METODOS GET
    public function getId(){
        return $this->idProducto; 
    }// fin metodo get

    public function getNombre(){
        return $this->nombre; 
    }// fin metodo get

    public function getDetalle(){
        return $this->detalle; 
    }// fin metodo get

    public function getStock(){
        return $this->cantStock; 
    }// fin metodo get

   // public function getPrecio(){
     //   return $this->precio; 
    //}// fin metodo get

    public function getMensaje(){
        return $this->mensaje; 
    }
    
    public function getPrecio(){
        return $this->arregloPrecios[$this->getId()];
    }
    // fin metodo get

    // METODOS SET
    public function setId($id){
        $this->idProducto=$id;
    }// fin metodo set

    public function setNombre($name){
        $this->nombre=$name;
    }// fin metodo set

    public function setDetalle($detalle){
        $this->detalle=$detalle;
    }// fin metodo set

    public function setStock($cant){
        $this->cantStock=$cant;
    }// fin metodo set

    //public function setPrecio($precio){
      //  $this->precio=$precio;
    //}// fin metodo set

    public function setMensaje($msj){
        $this->mensaje=$msj;
    }// fin metodo set

    /**METODO CARGAR 
     * @return boolean
     */
    public function cargar(){
        $salida=false;
        $baseDatos=new BaseDatos();
        $sql="SELECT * FROM producto WHERE idproducto=".$this->getId();
        if($baseDatos->Iniciar()){// inicializa la conexion
            $salida=$baseDatos->Ejecutar($sql); 
            if($salida>-1){
                if($salida>0){
                    $salida=true; 
                    $R=$baseDatos->Registro(); // recupera los registros de la tabla  con la ID dada
                    
                    $this->setear($R['idproducto'],$R['pronombre'],$R['prodetalle'],$R['procantstock']);

                }// fin if 

            }// fin if


        }// fin if 
        else{
            $this->setMensaje("Error en la Tabla producto").$baseDatos->getError();
        }// fin else

        return $salida; 

    }// fin function 

    /** METODO INSERTAR 
     * Ingresa un registro en la base de datos 
     * @return boolean
     */
    public function insertar(){
        $salida=false; // inicializacion del valor de retorno
        //$id=$this->getId();
        $baseDatos=new BaseDatos();
        
        $sql="INSERT INTO producto (pronombre,prodetalle,procantstock)
        VALUES ('".$this->getNombre()."','".$this->getDetalle()."',".$this->getStock().");"; 
        if($baseDatos->Iniciar()){
            if($baseDatos->Ejecutar($sql)){
                $salida=true;

            }// fin if 
            else{
                $this->setMensaje("producto - > Insertar").$baseDatos->getError();
            }// fin else

        }// fin if 
        else{
            $this->setMensaje("producto - > Insertar").$baseDatos->getError();

        }// fin else
        
        return $salida; 


    }// fin function insertar 

    /**
     * METODO MODIFICAR
     * @return boolean
     */
    public function modificar(){
        $salida=false;
        $baseDatos=new BaseDatos();
        var_dump($this->getNombre());
        $sql="UPDATE producto SET pronombre='".$this->getNombre()."', prodetalle='".$this->getDetalle()."', 
        procantstock=".$this->getStock()."  WHERE idproducto=".$this->getId();

        if($baseDatos->Iniciar()){
            if($baseDatos->Ejecutar($sql)){
                $salida=true;

            }// fin if 
            else{
                $this->setMensaje("Tabla producto Modificar ").$baseDatos->getError();

            }// fin else


        } // fin if
        else{
            $this->setMensaje("Tabla producto Modificar ").$baseDatos->getError();

        } // fin else

        return $salida; 


    }// fin function modificar

    /**
     * METODO ELIMINAR 
     * @return boolean
     */
    public function eliminar(){
        $salida=false;
        $baseDatos=new BaseDatos();
        $sql="DELETE FROM producto WHERE idproducto=".$this->getId();
        if($baseDatos->Iniciar()){
            if($baseDatos->Ejecutar($sql)){
                $salida=true;

            }// fin if
            else{
                $this->setMensaje("Tabla producto-> eliminar".$baseDatos->getError()); 
            }// fin else

        }// fin if
        else{
            $this->setMensaje("Tabla producto-> eliminar".$baseDatos->getError());
        }// fin else

        return $salida; 
    }// fin function eliminar


    /**
     * METODO LISTAR 
     * DEVUELVE TODOS LOS USUARIOS EN LA BASE DE DATOS
     * @param string $parametro
     * @return array 
     */
    public function listar($parametro=""){
        $arrayProductos=array();
        $baseDatos=new BaseDatos();
        $sql="SELECT * FROM producto ";
        //
        if($parametro!=""){
            $sql.=' WHERE '.$parametro;
        }// fin if 
        if($baseDatos->Iniciar()){
            $respuesta=$baseDatos->Ejecutar($sql);
            if($respuesta>-1){
                if($respuesta>0){
                    
                    while($row=$baseDatos->Registro()){
                    $obj=new Producto();

                    $obj->setear($row['idproducto'],$row['pronombre'],$row['prodetalle'],$row['procantstock']);
                     
                    array_push($arrayProductos,$obj); 
                    //var_dump($row['procantstock']);
                    //var_dump($obj->getStock());  
                    }// fin while 


                }// fin if 
            }// fin if 
        }// fin if 
        return $arrayProductos; 
    }// fin function listar


}// fin clase 

?>