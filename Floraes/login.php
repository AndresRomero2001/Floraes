<?php

require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/navbar.css">	
    <link rel="stylesheet" href="css/comun.css">
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

            if(isset($_SESSION["logeado"]))
            {
                echo "Perfil de usuario {$_SESSION['email']}";
            }
            else{
                echo'<div class="centeredDiv" style="margin-top:5em">
                <form action="procesarLogin.php" method="post">
                <label for="emailInput">Email</label>
                <input class="formInput" id="emailInput" type="email" name="email"  placeholder="Email del usuario" value="" required>
                <label for="contraInput">Contraseña</label>
                <input class="formInput" id="contraInput" type="password" name="contra" placeholder="Contraseña" value="" required>
                <button class="formSubmitButton" type="submit" style="font-size:1.2em"> Iniciar sesión </button>
                </form>';    
                /* echo '</br><p> *Debug* Datos para inicio </p>
                <p>Admin: email: admin@mail Password: admin </p>
                <p>Usuario normal: email: a@gmail.com Password: asd </p>
                </div>'; */
            }


            ?>

			
		</article>
	</main>
            
	<?php
   // require ('sidebarDer.php');
?>

<?php
    echo "<div class=\"piePagina\"></div>";
    //require ('pie.php');
?>

</div> <!-- Fin del contenedor -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</body>
</html>