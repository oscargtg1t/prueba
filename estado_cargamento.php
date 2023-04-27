<?php
include "config.php";
include "utils.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("400 Bad Request");

$dbConn3 =  connect3($db3);


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_cargamento']))
    {
      
      $sql = $dbConn3->prepare("SELECT * FROM estado_cargamento where id_cargamento=:id_cargamento");
      $sql->bindValue(':id_cargamento', $_GET['id_cargamento']);
      $sql->execute();
      header("200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
	  }
    else {
      
      $sql = $dbConn3->prepare("SELECT * FROM estado_cargamento");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO estado_cargamento
          (id_cargamento, estado_cargamento, estado_cuenta, mensaje)
          VALUES
          (:id_cargamento, :estado_cargamento, :estado_cuenta, :mensaje)";
    $statement = $dbConn3->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn3->lastInsertId();
    echo json_encode("200 Ok: Estado de cargamento creado");
    if($postId)
    {
      $input['id_cargamento'] = $postId;
      header("200 OK");
      $request =[
        'mensaje' => "200 Ok"
      ];
      echo json_encode($request);
      exit();
	 }
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_cargamento'];
    $fields = getParams($input);

    $sql = "
          UPDATE estado_cargamento
          SET $fields
          WHERE id_cargamento='$postId'
           ";

    $statement = $dbConn3->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("201 OK");
    $request =[
      'mensaje' => "201: Estado de cargamento Actualizado"
    ];
    echo json_encode($request);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id_cargamento'];
  $statement = $dbConn3->prepare("DELETE FROM estado_cargamento where id_cargamento=:id_cargamento");
  $statement->bindValue(':id_cargamento', $id);
  $statement->execute();
	header("200 OK");
  $request =[
    'mensaje' => "Estado de cargamento Borrado"
  ];
  echo json_encode($request);
	exit();
}

?>
