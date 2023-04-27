<?php


//agricultor   ---->    beneficio
//conexion para tabla cargamento del beneficio
$db = [
    'host' => 'host:port',
    'username' => 'root',
    'password' => 'root',
    'db' => 'db_beneficio' //Cambiar al nombre de tu base de datos
];

/*
//conexion
$db2 = [
    'host' => 'host:port',
    'username' => '',
    'password' => '',
    'db' => '' //Cambiar al nombre de tu base de datos
];
*/

//beneficio  ------>  agricultor
//conexion para tabla estado cargamento del agricultor
$db3 = [
    'host' => 'host:port',
    'username' => '',
    'password' => '',
    'db' => 'db_agricultor' //Cambiar al nombre de tu base de datos
];


//beneficio  ----->  peso cabal
//conexion para tabla pesaje total del peso cabal
$db4 = [
    'host' => 'host:port',
    'username' => '',
    'password' => '',
    'db' => 'db_pesocabal' //cambiar al nombre de tu base de datos
];


//peso cabal ----> beneficio
//conexion para tabla notificaion cuenta del beneficio
$db5 = [
    'host' => 'host:port',
    'username' => '',
    'password' => '',
    'db' => 'db_beneficio' //cambiar al nombre de tu base de datos
];
?>
