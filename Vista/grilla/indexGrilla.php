<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$objSession = new Session();    //Cambio
if ($objSession->validar() ) {  //Cambio
  
//if (isset($datos) && isset($datos['logeado']) && $datos['logeado'] == 'si') {  //Cambio
  include_once '../estructura/headPrivado.php';
} else {
  include_once '../estructura/headLibre.php';
  echo ("<script> let a=false; </script>");
} //fin else
$token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;
$objProducto = new AbmProducto();
$listaProductos = $objProducto->buscar(null);

$count = 0;
// RECORIDO DE LOS PRODUCTOS CON SU IMAGEN, NOMBRE Y PRECIO
?>

<div class="d-flex flex-wrap pb-5 justify-content-center">
  <div id="prueba"></div>
  <?php
  foreach ($listaProductos as $unProducto) {

  ?>

    <div class="card m-3 justify-content-between" style="width: 18rem; max-height:400px;">
      <img src="../imagenes/<?php echo $unProducto->getId() ?>.jpg" class="card-img" style="max-height:200px;object-fit:contain" alt="...">
      <div class="card-body d-flex flex-column justify-content-end" style="max-height:200px">
        <h5 class="card-title"><?php echo ($unProducto->getNombre()) ?></h5>
        <p class="card-text"> <?php echo ($unProducto->getDetalle()) ?> </p>
        <p class="card-text"> <?php echo ("$" . $unProducto->getPrecio()) ?> </p>
        <btn class="btn btn-primary carrito" data-id="<?php echo $unProducto->getId() ?>">Añadir al Carrito</btn>
      </div>
    </div>
  <?php
    $count++;
  } //fin for 
  ?>
</div>

<?php
include_once "../estructura/footer.php"; ?>