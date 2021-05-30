<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
  SELECT horario
  FROM agenda_clinica 
  WHERE data=? and codigoMedico =?
  SQL;

  $data = $_GET['data'] ?? '';
  $codigoMedico = $_GET['codigoMedico'] ?? '';

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$data, $codigoMedico]);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

$array = array();
while ($row = $stmt->fetch()) {
  $array[] = $row['horario'];
}
  
echo json_encode($array);