<?php
include "config.php";
include "utils.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("400 Bad Request");

$dbConn4 =  connect4($db4);


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_cargamento']))
    {
      //
      $sql = $dbConn4->prepare("SELECT * FROM pesaje_total where id_cargamento=:id_cargamento");
      $sql->bindValue(':id_cargamento', $_GET['id_cargamento']);
      $sql->execute();
      header("200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
	  }
    else {
      //
      $sql = $dbConn4->prepare("SELECT * FROM pesaje_total");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}


?>
