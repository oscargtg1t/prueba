<?php
include "config.php";
include "utils.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("400 Bad Request");

$dbConn5 =  connect5($db5);


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_cargamento']))
    {
      //
      $sql = $dbConn5->prepare("SELECT * FROM estado_cuenta where id_cargamento=:id_cargamento");
      $sql->bindValue(':id_cargamento', $_GET['id_cargamento']);
      $sql->execute();
      header("200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
	  }
    else {
      //
      //$sql = $dbConn5->prepare("SELECT * FROM notificacion_cuenta");
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



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO estado_cuenta
          (id_cargamento, estado_cuenta, mensaje)
          VALUES
          (:id_cargamento, :estado_cuenta, :mensaje)";
    $statement = $dbConn5->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn5->lastInsertId();
    echo json_encode("200 Ok: Estado de cuenta creado");
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
          UPDATE estado_cuenta
          SET $fields
          WHERE id_cargamento='$postId'
           ";

    $statement = $dbConn5->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("201 OK");
    $request =[
      'mensaje' => "201: Estado de cuenta Actualizado"
    ];
    echo json_encode($request);
    exit();
}

/*
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id_cargamento'];
  $statement = $dbConn5->prepare("DELETE FROM estado_cuenta where id_cargamento=:id_cargamento");
  $statement->bindValue(':id_cargamento', $id);
  $statement->execute();
	header("200 OK");
  $request =[
    'mensaje' => "Estado de cuenta Borrado"
  ];
  echo json_encode($request);
	exit();
}
*/
?>
