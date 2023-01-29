<?php

require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/localizacion.php';
require_once __DIR__.'/planta.php';

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="nofollow" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">	
    <link rel="stylesheet" href="css/comun.css">
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body>

    <?php include __DIR__.'/navbar.php'; ?>


    <?php
    echo <<<EOF
    <div class="divPrincipal">
    EOF;

    if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "Admin") {
        
        echo <<<EOF
        <button type="button" class="greenButton" id="abrirModalLocButton" data-toggle="modal" data-target="#modalAnadirLoc">Añadir localización</button>

        <div class="modal fade" id="modalAnadirLoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir nueva localización</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form class="form" action="procesarAnadirLoc.php" method="POST" id="formLoc">
                    <div class="modal-body">
                        <label for="inputLoc" id="labelLoc">Nombre de la localización</label>
                        <input type="text" name="nombreLoc" id="inputLoc" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="anadirLocButton" class="btn btn-primary">Añadir</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <button type="button" class="greenButton" id="abrirModalButton" data-toggle="modal" data-target="#modalAnadirPlanta">Añadir planta</button>
        
        EOF;

        /* <button id="abrirModalLocButton" class="modalButton greenButton">Añadir Localización</button>
        <button id="abrirModalButton" class="modalButton greenButton">Añadir planta</button> */

        $contenidoModal = contenidoModal();
        echo <<<EOF
        <div class="modal fade" id="modalAnadirPlanta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir planta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form class="form" id="anadirPlantaForm" action="procesarAnadirPlanta.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {$contenidoModal}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Añadir planta</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        EOF;
    }

    mostrarListaPlantas();
    echo"</div>";

    echo "<div class=\"piePagina\"></div>";
    
    ?>

    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</body>
</html>


<?php
    function mostrarListaPlantas() {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("SELECT * FROM localizacion");

        $listaLocalizaciones = array();
        $listaPlantas = array();
        $listaRelacion = array();

        $listaLoc = Localizacion::getListaLocalizaciones();
        foreach($listaLoc as $loc)
        {
            $borrarLoc = "";

            if(!$loc->getListaPlantas() && isset($_SESSION["rol"]) && $_SESSION["rol"] == "Admin") {
                $borrarLoc .= <<<EOF
                <form class="form" action="procesarBorrarLoc.php" method="POST" id="formBorrarLoc" onsubmit="return confirm('¿Estás seguro?');">
                <button type="submit" name="idLoc" class="borrarButton" value="{$loc->getId()}">❌</button>
                </form>
                EOF;
            }

            echo <<<EOF
            <div>
            <h2 class="nombreLoc"> {$loc->getNombre()} $borrarLoc</h2>
            </div>
            EOF;

            foreach($loc->getListaPlantas() as $planta)
            {
                $imagenes = array();
                $imagenes = $planta->getIdsFotos(); //pone ids pero no solo es id, es 12.jpg
                $img = "default.jpg";
                if($imagenes != null) {
                    $firstKey = key($imagenes);
                    if($imagenes[$firstKey] != null) {
                        $img = $imagenes[$firstKey];
                    }
                }
                

                $borrarPlanta="";
                if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "Admin") {
                    $idPlanta = $planta->getId();
                    $idLoc = $loc->getId();
                    $borrarPlanta .= <<<EOF
                    <form class="form" action="procesarBorrarPlanta.php" class="borrarPlantaForm" onsubmit="return confirm('¿Estás seguro?');">
                    <input type="hidden" name="idPlanta" value="$idPlanta">
                    <input type="hidden" name="idLoc" value="$idLoc">
                    <button type="submit" class="borrarButton">❌</button>
                    </form>
                    EOF;
                    
                }

                echo <<<EOF
                <div class="divPlanta">
                <a class="myLink" href="verPlanta.php?idPlanta={$planta->getId()}&idLoc={$loc->getId()}">
                    <img class="imgPlanta" src="img/plantas/{$img}"> 
                    <p class="nombreEsp"> 
                    {$planta->getNombreEs()}
                    </p>
                    $borrarPlanta
                   <!-- <p class="nombreLatin"> 
                    {$planta->getNombreLa()}
                    </p> -->
                </a>
                </div>
                EOF;
                // antes en el <p> -Id planta: {$planta->getId()}  Nombre español: {$planta->getNombreEs()}  Nombre latin: {$planta->getNombreLa()} 
            }
        }
    
    }

    function contenidoModal(){
        $contenidoModal = "";

        $contenidoModal .= <<<EOF
        <label for="nombre" class="campoFormulario">Nombre común *</label>
        <input type="text" class="formInput" id="nombre" name="nombre" required>

        <label for="nombreLatin" class="campoFormulario">Nombre en latín</label>
        <input type="text" class="formInput" id="nombreLatin" name="nombreLatin">

        <label for="localizaciones" class="campoFormulario">Localizaciones de la planta (mantener ctrl para elegir varias a la vez) *</label>
        <select class="form-select formInput" id="localizaciones" name="localizacionesElegidas[]" size="5" multiple required>

        <option value="">Por favor, escoja las localizaciones de la planta</option>
        EOF;

        $lista = localizacion::getListaLocalizaciones();
        foreach ($lista as $loc){
            $contenidoModal .= <<<EOF
            <option value="{$loc->getId()}">{$loc->getNombre()}</option>
            EOF;
        }

        $contenidoModal .= <<<EOF
        </select>
        <label for="otrosNombres" class="campoFormulario">Otros nombres</label>
        <textarea id="otrosNombres" class="formInput" rows="4" cols="50" name="otrosNombres"></textarea>

        <label for="tam" class="campoFormulario">Tamaño medio</label>
        <input type="number" class="formInput" id="tam" name="tam" min="0">

        <label for="etimologia" class="campoFormulario">Etimología</label>
        <textarea id="etimologia" class="formInput" rows="4" cols="50" name="etimologia"></textarea>

        <label for="curiosidades" class="campoFormulario">Curiosidades</label>
        <textarea id="curiosidades" class="formInput" rows="4" cols="50" name="curiosidades"></textarea>

        <label for="parecidos" class="campoFormulario">Parecidos</label>
        <textarea id="parecidos" class="formInput" rows="4" cols="50" name="parecidos"></textarea>

        <label for="floracion" class="campoFormulario">Floración</label>
        <textarea id="floracion" class="formInput" rows="4" cols="50" name="floracion"></textarea>

        <label for="miniaturaPlanta" class="campoFormulario">Miniatura de la planta (formatos válidos: jpg, png, jpeg y webp)</label>
        <input type="file" class="formInput" name="miniatura" id="miniaturaPlanta">
        EOF;

        return $contenidoModal;
    }
?>