<?php
include "config.php";
include "utils.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("400 Bad Request");

$dbConn =  connect($db);


//metodo GET para obtener dato de agricultor
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_agricultor']))
    {
      //Mostrar un agricultor
      $sql = $dbConn->prepare("SELECT * FROM agricultores where id_agricultor=:id_agricultor");
      $sql->bindValue(':id_agricultor', $_GET['id_agricultor']);
      $sql->execute();
      header("200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
	  }
    else {
      //Mostrar lista de agricultores
      //$sql = $dbConn2->prepare("SELECT * FROM agricultores");
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


//metodo POST para registar un agricultor
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO agricultores
          (id_agricultor, nombre_agricultor, correo_agricultor, pass)
          VALUES
          (:id_agricultor, :nombre_agricultor, :correo_agricultor, :pass)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    echo json_encode("200 Ok: Agricultor Registrado");
    if($postId)
    {
      $input['id_agricultor'] = $postId;
      header("200 OK");
      $request =[
        'mensaje' => "200 Ok"
      ];
      echo json_encode($request);
      exit();
	 }
}


//metodo PUT para Actualizar datos de agricultor
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_agricultor'];
    $fields = getParams($input);

    $sql = "
          UPDATE agricultores
          SET $fields
          WHERE id_agricultor='$postId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("201 OK");
    $request =[
      'mensaje' => "201: Datos Actualizados"
    ];
    echo json_encode($request);
    exit();
}

/*
//metodo DELETE 
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id_agricultor'];
  $statement = $dbConn->prepare("DELETE FROM agricultores where id_agricultor=:id_agricultor");
  $statement->bindValue(':id_agricultor', $id);
  $statement->execute();
	header("200 OK");
  $request =[
    'mensaje' => "Datos del Agricultor Borrado"
  ];
  echo json_encode($request);
	exit();
}
*/

?>
