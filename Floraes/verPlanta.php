<?php
require_once __DIR__.'/localizacion.php';
require_once __DIR__.'/planta.php';
require_once __DIR__.'/localizacionPlantas.php';
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="nofollow" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">	
    <link rel="stylesheet" href="css/comun.css">
    <link rel="stylesheet" href="css/verPlanta.css"> 
    
</head>
<body>
   <!--  <div>
        <img class="fotoBanner" src="img/banner3bueno.jpg">
    </div> -->

    <?php include __DIR__.'/navbar.php'; ?>

    <?php

    if(!isset($_GET['idPlanta']) && !isset($_GET['idLoc'])) {
        echo "ERROR, no se ha encontrado el idPlanta en la URL";
    } else {
        $idPlanta = $_GET['idPlanta'];
        $idLoc = $_GET['idLoc'];

        $modificarPlanta = "";
        $borrarPlantaTotal = "";
        $añadirFotos = "";
        $anadirFotosButton = "";
        $planta = Planta::getPlantaById($_GET['idPlanta']);
        $loc = Localizacion::getLocById($idLoc);

        if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "Admin") {
            

            $modificarPlanta = '<button id="modificarModalButton" class="modalButton" data-toggle="modal" data-target="#modalEditarPlanta">✏️</button>';

            $borrarPlantaTotal = <<<EOF
            <form action="procesarBorrarPlanta.php" id="borrarPlantaForm" onsubmit="return confirm('¿Estás seguro?');">
            <input type="hidden" name="idPlanta" value="$idPlanta">
            <button type="submit" id="borrarPlantaTotal">❌</button>
            </form>
            EOF;

            $contenidoModal = contenidoModal($planta);
            echo <<<EOF
            <div class="modal fade" id="modalEditarPlanta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar planta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="modificarPlantaForm" action="procesarModificarPlanta.php">
                        <div class="modal-body">
                            {$contenidoModal}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="anadirLocButton" class="btn btn-primary">Guardar</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
            EOF;

            $anadirFotosButton .= <<<EOF
            <button id="fotosModalButton" class="modalButton" data-toggle="modal" data-target="#anadirFotoModal">➕</button>
            EOF;

            echo <<<EOF
            <div class="modal fade" id="anadirFotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Añadir nueva foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="anadirFotoForm" action="procesarAnadirFoto.php" method="POST" enctype="multipart/form-data"">
                        <div class="modal-body">
                            <label for="foto" class="campoFormulario">Foto de la planta</label>
                            <input type="file" class="formInput" name="foto" id="foto">
                            <input type="hidden" name="idPlanta" value="$idPlanta">
                            <input type="hidden" name="idLoc" value="$idLoc">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="anadirFotoButton" class="btn btn-primary">Añadir</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
            EOF;
        }

        $imagenes = array();
        $imagenes = $planta->getIdsFotos(); //pone ids pero no solo es id, es 12.jpg
        /* var_dump($imagenes);
        echo reset($imagenes); */
        $img = "default.jpg";
        if($imagenes != null) {
            $firstKey = key($imagenes);
            if($imagenes[$firstKey] != null) {
                $img = $imagenes[$firstKey];
            }
        }
        /* echo "imagenes: $imagenes ";
        echo "img: $img "; */
        $fotosTotales = "";
        foreach($imagenes as $key => $im) {
            $botonBorrarFoto = "";

            if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "Admin") {
                $botonBorrarFoto .= <<<EOF
                <div class="centeredDiv">
                    <form class="formBorrarFoto" action="procesarBorrarFoto.php" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                        <input type="hidden" name="idFoto" value="$key">
                        <input type="hidden" name="idPlanta" value="$idPlanta">
                        <input type="hidden" name="idLoc" value="$idLoc">
                        <button class="borrarFotoButton" type="submit">❌</button>
                    </form>
                </div>
                EOF;
            }
            
            $fotosTotales .= <<<EOF
            <div class="inlineBlock leftMargin">
                <img class="foto" src="img/plantas/$im">
                $botonBorrarFoto
            </div>
            EOF;
        }

        $cont = 0;
        $localizaciones = "";
        $listaLocs = localizacionPlantas::getLocsPlanta($idPlanta);
        foreach ($listaLocs as $idL){ // idL es la id, no un objeto loc
            $nombreLoc = localizacion::getNombreById($idL);
            $cont++;
            if($cont == count($listaLocs)) {
                $localizaciones .= $nombreLoc;
            } else {

                $localizaciones .= $nombreLoc.", "; 
            }
        }

        
        echo <<<EOF
        <div class="cuerpoPlanta">
            <h1 id="nombreEs" class="nombre">{$planta->getNombreEs()}</h1>
            $modificarPlanta
            $borrarPlantaTotal
            <div class="filaInicial">
                <div class="fotoCol">
                    <img class="imgPlanta" src="img/plantas/$img">
                </div>
                <div class="nombreCol">
                    <h2 class="sepVertical">Nombre en latín: {$planta->getNombreLa()}</h2>
                    <h2 class="sepVertical">Localizaciones: $localizaciones</h2>
                    <h2 class="sepVertical">Tamaño medio: {$planta->getTam()} cm</h2>
                    <h2 class="sepVertical">Floración: {$planta->getFloracion()}</h2>
                    
                </div>
            </div>

            <div class="textosLargos">
                <div class="otrosNombres">
                    <h1>Otros nombres</h1>
                    <div class="alignLeft">
                        <p>{$planta->getOtrosNombres()}</p>
                    </div>
                </div>
                <div class="etimologia">
                    <h1>Etimología</h1>
                    <div class="alignLeft">
                        <p>{$planta->getEtimologia()}</p>
                    </div>
                </div>
                <div class="curiosidades">
                    <h1>Curiosidades</h1>
                    <div class="alignLeft">
                        <p>{$planta->getCuriosidades()}</p>
                    </div>
                </div>
                <div class="parecidos">
                    <h1>Parecidos</h1>
                    <div class="alignLeft">
                        <p>{$planta->getParecidos()}</p>
                    </div>
                </div>
            </div>

            <div id="cuerpoFotos">
                <h1 id="tituloFotos">Fotos</h1>
                $anadirFotosButton
                <div id="divFotos">
                    <div class="fotos">
                        $fotosTotales
                    </div>
                </div>
            </div>
        EOF;


// --------- COMENTARIOS COMENTADOS -------  //

/*         $comentarios = array();
        $comentarios = $planta->getComentarios();
        echo "<h1 class=\"tituloComentarios\">Comentarios</h1>";

        if(isset($_SESSION["logeado"]))
        {
            echo <<<EOF


            <div class = "divComentario">
                <h3>Escribe un comentario </h3>
                <form action="nuevoComen.php" method="post">
                <textarea name="coment" rows="4" cols="50" placeholder="Escribe tu comentario aqui"></textarea>
                <input type="hidden" name="idPlanta" value={$_GET['idPlanta']}>
                <input type="hidden" name="idLoc" value={$_GET['idLoc']}>
                <button class="botonComen" type="submit">Enviar</button>
                </form>
            </div>
        EOF;
        }
        

        foreach($comentarios as $com)
        {
            echo <<<EOF
            <div class = "divComentario">
                <div>
                    <h3> 👤{$com->getEmail()} </h3>
            EOF;
                    if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "Admin")
                    {
                        echo <<<EOF
                        <form class="botonBorrarComenForm" action="borrarComen.php" method="post">
                        <button class="botonBorrarComen" type="submit" name="idComen" value={$com->getId()}>❌</button>
                        <input type="hidden" name="idPlanta" value={$_GET['idPlanta']}>
                        <input type="hidden" name="idLoc" value={$_GET['idLoc']}>
                        </form>
                        EOF;
                    }
            echo <<<EOF
            </div>
                <p> {$com->getDesc()} </p>
            </div>
                
            EOF;
        } */

// --------- FIN DE COMENTARIOS COMENTADOS -------  //
        
        echo "</div>";

        echo "<div class=\"piePagina\"></div>";

    }

    ?>

    <script src="js/verPlanta.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>

<?php
    function contenidoModal($planta){
        $contenidoModal = "";

        $idPlanta = $planta->getId();
        $nombre = $planta->getNombreEs();
        $nombreLa = $planta->getNombreLa();
        $otrosNombres = $planta->getOtrosNombres();
        $etimologia = $planta->getEtimologia();
        $curiosidades = $planta->getCuriosidades();
        $parecidos = $planta->getParecidos();
        $floracion = $planta->getFloracion();
        $tam = $planta->getTam();

        $contenidoModal .= <<<EOF
        <label for="nombre" class="campoFormulario">Nombre común</label>
        <input type="text" class="formInput" id="nombre" name="nombre" value="$nombre" required>

        <label for="nombreLatin" class="campoFormulario">Nombre en latín</label>
        <input type="text" class="formInput" id="nombreLatin" name="nombreLatin" value="$nombreLa">

        <label for="localizaciones" class="campoFormulario">Localizaciones de la planta</label>
        <select class="form-select formInput" id="localizaciones" name="localizacionesElegidas[]" size="5" multiple required>

        <option value="">Por favor, escoja las localizaciones</option>
        EOF;

        $lista = localizacion::getListaLocalizaciones();
        $locsPlanta = localizacionPlantas::getLocsPlanta($idPlanta);
        foreach ($lista as $loc){
            
            if(array_search($loc->getId(), $locsPlanta) !== false) {
                $contenidoModal .= <<<EOF
                <option value="{$loc->getId()}" selected>{$loc->getNombre()}</option>
                EOF;
            } else {
                $contenidoModal .= <<<EOF
                <option value="{$loc->getId()}">{$loc->getNombre()}</option>
                EOF;
            }
        }

        $contenidoModal .= <<<EOF
        </select>
        <label for="otrosNombres" class="campoFormulario">Otros nombres</label>
        <textarea id="otrosNombres" class="formInput" rows="4" cols="50" name="otrosNombres">$otrosNombres</textarea>

        <label for="tam" class="campoFormulario">Tamaño medio</label>
        <input type="number" class="formInput" id="tam" name="tam" value="$tam" min="0">

        <label for="etimologia" class="campoFormulario">Etimología</label>
        <textarea id="etimologia" class="formInput" rows="4" cols="50" name="etimologia">$etimologia</textarea>

        <label for="curiosidades" class="campoFormulario">Curiosidades</label>
        <textarea id="curiosidades" class="formInput" rows="4" cols="50" name="curiosidades">$curiosidades</textarea>

        <label for="parecidos" class="campoFormulario">Parecidos</label>
        <textarea id="parecidos" class="formInput" rows="4" cols="50" name="parecidos">$parecidos</textarea>

        <label for="floracion" class="campoFormulario">Floracion</label>
        <textarea id="floracion" class="formInput" rows="4" cols="50" name="floracion">$floracion</textarea>

        <input type="hidden" name="idPlanta" value="$idPlanta">
        <input type="hidden" name="idLoc" value={$_GET['idLoc']}">
        EOF;

        return $contenidoModal;
    }
?>