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

            echo'
            <div class="cuerpoCentral">
            <form action="procesarRegistro.php" method="POST">
            <label for="nombreInput">Nombre y apellidos</label>
            <input class="formInput" id="nombreInput" type="text" name="nombre"  placeholder="Nombre y Apellidos" required>
            <label for="emailInput">Email</label>
            <input class="formInput" id="emailInput" type="email" name="email"  placeholder="Email usuario" required>
            <label for="contraInput">Contraseña</label>
            <input class="formInput" id="contraInput" type="password" name="contra" placeholder="Contraseña" onchange="validatePassword()" required>
            <label for="contraInput2">Repite la contraseña</label>
            <input class="formInput" id="contraInput2" type="password" name="contra2" placeholder="Repite la contraseña" onchange="validatePassword()" required>
            <button class="formSubmitButton" type="submit"> Enviar </button>
            </form>
            </div>
            ';

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
    <script src="js/registro.js"></script>
</body>
</html>