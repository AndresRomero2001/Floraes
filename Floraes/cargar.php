<?php
require 'vendor/autoload.php' ;

$uri="mongodb://usuario:password@host_base_datos/base_de_datos?ssl=false";

$client=new MongoDB\Client($uri);

$collection = $client->base_de_datos->productos;

$result = $collection->insertOne( [ 'item' => 'producto1', 'cantidad' => '200' ] );

echo "Inserted with Object ID '{$result->getInsertedId()}'";
?>
