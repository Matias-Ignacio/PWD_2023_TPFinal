<?php
$titulo="Login";
include_once '../Estructura/headLibre.php'; 
//include_once '../Estructura/headPrivado.php'; 
//$dato=data_submitted();

?>


 <main>
    <div class="container bg-white-50 d-flex justify-content-center mt-5">
        <form action="accionLogin.php" method="POST" class="row g-3 needs-validation" novalidate>
        <input type="hidden" name="accion" value="login">
            <div class="card" style="width: 18rem;">
                <img src="../imagenes/autenticacion.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center">Iniciar sesión</h5>

                    
                    <div class="col-md">
                        
                        <label for="validationCustom01" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="fulanito"  required>

                    </div>
                    <div class="col-md">
                        <label for="validationCustom02" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"  required>

                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn btn-primary" id="enviar" type="submit">Ingresar</button>
                        <a href="register.php" class="btn btn-secondary" id="enviar">Registrarse</a>
                    </div>
                    
                </div>
            </div> 

        </form>
        <div id="error"></div>
    </div>


</main>

<!--LINK JS-->
<script src="../Js/main.js"></script>


<?php  
include_once '../estructura/footer.php';
?>