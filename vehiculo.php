<?php
include "config.php";
include "utils.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("400 Bad Request");

$dbConn =  connect($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['placa']))
    {
      //
      $sql = $dbConn->prepare("SELECT * FROM vehiculo where placa=:placa");
      $sql->bindValue(':placa', $_GET['placa']);
      $sql->execute();
      header("200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
	  }
    else {
      //
      //$sql = $dbConn->prepare("SELECT * FROM vehiculo");
      //$sql->execute();
      //$sql->setFetchMode(PDO::FETCH_ASSOC);
      //header("200 OK");
      //echo json_encode( $sql->fetchAll()  );
      header("404 not found");
      $request =[
        'mensaje' => "404: No autorizado"
      ];
      echo json_encode($request);
      exit();
	}
}


?>