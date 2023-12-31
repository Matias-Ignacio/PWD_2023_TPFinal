<?php
include_once '../../configuracion.php';


//Crea el objeto session
$objSession = new Session();
$datos=data_submitted();
//Si se agregó un producto...
if (isset($datos["idAgregar"])) {
    //Agrega el producto al carrito y retorna la cantidad de productos en el carrito
    echo $objSession->agregarAlCarrito($datos["idAgregar"]);
}
//Elimina el producto al carrito y retorna la cantidad de productos en el carrito
if (isset($datos["idEliminar"])) {
    echo $objSession->eliminarDelCarrito($datos['idEliminar']);
}

if (isset($datos["obtenerCarrito"])) {
    $arregloProductos = $objSession->getCarrito();
    foreach ($arregloProductos as $producto) {
        $retorno['productos'][] = [
            'nombre' => $producto->getNombre(),
            'detalle' => $producto->getDetalle(),
            'precio' => $producto->getPrecio(),
            'id' => $producto->getId(),
            'stock' => $producto->getStock()
        ];
    }
    //echo($retorno['productos']['stock']);
    header('Content-Type: application/json');
    echo json_encode($retorno);
}

//Si la llamada es para actualizar el ícono del carrito...
if (isset($datos['actualizarIcono'])) {
    //Retorna la cantidad de productos en el carrito
    echo count($objSession->getCarrito());
}

if (isset($datos["enviarCantidades"])) {
    // Almacenamos lo que recibimos del post en $cantidades
    $cantidades = $datos["enviarCantidades"];
    //Obtener el carrito
    $carrito = $objSession->getCarrito();
    //Obtener la cantidad de productos en el carrito
    $cantCarrito = count($carrito);
    if ($cantCarrito != 0) {
        //Inicializamos $arregloCantidades
        $arregloCantidades = [];
        // Iteramos $cantidades para acceder a la cantidad que le corresponde a cada producto
        foreach ($cantidades as $producto) {
            $id = $producto['id'];
            $cantidad = $producto['cantidad'];
            //Iteramos en los productos en el carrito
            for ($i = 0; $i < $cantCarrito; $i++) {
                //Si el id del producto en carrito en la posicion $i es igual al $id del arreglo de ids asociados a cantidades...
                if ($carrito[$i]->getId() == $id) {
                    //Agregamos el par $id, $cantidad al $arregloCantidades
                    $arregloCantidades[] = [
                        "id" => $id,
                        "cantidad" => $cantidad
                    ];
                }
            }
        }
        //Como ya se envió la compra, vaciamos el carrito
        $objSession->vaciarCarrito();
        $idUsuario=$objSession->getUsuario()->getId();
        //Ejemplo para trabajar con las asociaciones
        $i=0;
        foreach ($arregloCantidades as $producto) {
            $datos[$i]= "idproducto:" . $producto["id"] . "cantidad: " . $producto["cantidad"];
            
        } //...Haciendo uso de arregloCantidades, se pueden crear los objetos compraItem
        //$datos['idusuario']=$idUsuario;
        echo $datos;
    }
}
