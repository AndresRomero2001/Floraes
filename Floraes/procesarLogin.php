<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/Usuario.php';

if(!isset($_SESSION["logeado"]))
{    
    $result = array();

    $u = Usuario::login($_POST["email"], $_POST["contra"]);


    if(!$u)
    {
        //echo"{$_POST["email"]} {$_POST["contra"]}";
        //  header('Location: login.php');
        // $result[] = "Usuario o contraseña incorrectos"; //mensaje de error global que se mostrara por encima del formulario
    }
    else{
        $_SESSION["logeado"] = true;
        $_SESSION["rol"] = $u->getRol();
        $_SESSION["email"] = $u->getEmail();
        header('Location: index.php');
    }
        
} 

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/navbar.css">	
    <link rel="stylesheet" href="css/comun.css">
    <link rel="stylesheet" href="css/plantas.css">
</head>


    
<body>


<?php include __DIR__.'/navbar.php'; ?>


<div id="contenedor">



<?php
    //require ('sidebarIzq.php');
?>

	<main>
	  <article>

            <?php


                echo'<div class="centeredDiv">
                <p style="color:rgb(185, 12, 12);"> Usuario o contraseña incorrectos <p>
                <form action="procesarLogin.php" method="post">
                <label for="emailInput">Email</label>
                <input class="formInput" id="emailInput" type="email" name="email"  placeholder="Email usuario" value="" required>
                <label for="contraInput">Contraseña</label>
                <input class="formInput" id="contraInput" type="password" name="contra" placeholder="Contraseña" value="" required>
                <button class="formSubmitButton" type="submit"> Enviar </button>
                </form>';    
                echo '</br><p> *Debug* Datos para inicio </p>
                <p>Admin: email: admin@mail Password: admin </p>
                <p>Usuario normal: email: a@gmail.com Password: asd </p>
                </div>';
            


            ?>

			
		</article>
	</main>

	<?php
   // require ('sidebarDer.php');
?>

<?php
    //require ('pie.php');
?>

</div> <!-- Fin del contenedor -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</body>
</html>

