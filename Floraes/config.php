<?php

//use es\fdi\ucm\aw\Aplicacion;
//namespace es\fdi\ucm\aw;

require_once __DIR__.'/Aplicacion.php';

/**
 * Configuracion del soporte UTF-8, localizacion (idioma y pais)
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');

date_default_timezone_set('Europe/Madrid');

session_start();

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost'); //para el contenedor vm07.db.swarm.test
define('BD_NAME', 'floraes');
define('BD_USER', 'root');
define('BD_PASS', ''); //para el contendor cDHOP07E4smhI8

// Inicializa la aplicacion
$app = Aplicacion::getInstancia();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

/**
 * @see http://php.net/manual/en/function.register-shutdown-function.php
 * @see http://php.net/manual/en/language.types.callable.php
 */
//register_shutdown_function(array($app, 'shutdown'));