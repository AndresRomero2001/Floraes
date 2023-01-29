<?php

require_once __DIR__.'/localizacion.php';

$n = "aravaca2";
$r = localizacion::existePorNombre($n);

echo "<p></p>";
echo $r;

/* echo " returned: ".$r." "; */

if($r) {
    echo " ya existe ";
} else {
    echo " no existe ";
}

?>