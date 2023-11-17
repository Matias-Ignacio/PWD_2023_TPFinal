<?php
    include_once '../../configuracion.php';
   

    $resp=false; 
    $objUsuario=new AbmUsuario();
    $datos=data_submitted();
    //$listaObj = $objUsuario->buscar($datos);
    
    var_dump($datos);
    if(isset($datos['accion'])){
        if(($datos['accion']=='Cambiar')){
            $datos["idusuario"] = intval($datos["idusuario"]);
            //echo "estoyaqui";
            if($objUsuario->modificacion($datos)){
                $resp=true; 
            }// fin if 
        }// fin if
        if($datos['accion']=='Borrar'){
            if($objUsuario->baja($datos)){
                $resp=true; 

            }// fin if 

        }// fin if 
        if($datos['accion']=='Nuevo'){
            //echo("<br> nuevo");
            $datos["idusuario"] = intval($datos["idUsuario"]);
            $datos["usnombre"] = intval($datos["nombreUsuario"]); 
            $datos["usmail"] = intval($datos["mail"]);
            $datos["usdeshabilitado"] = floatval($datos["deshabilitado"]);
            if($objUsuario->alta($datos)){
                $resp=true;
            }// fin if 

        }// fin if

        if($resp){
            $mensaje="La accion ".$datos['accion']."  se realizao correctamente " ;
        }
        else{
            //echo("mensaje error");
            $mensaje="Hubo un problema con la accion ".$datos['accion']." ";
            
        }

    }// fin if

    
?>

<div class="container">
    <?php
    echo($mensaje);
    ?>
</div>
<a href="indexUsuario.php">Volver</a>

<?php
include_once("../estructura/footer.php");
?>