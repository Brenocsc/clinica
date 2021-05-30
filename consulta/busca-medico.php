<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

class Medico {
  public $codigo;
  public $nome;

  function __construct($codigo, $nome) {
    $this->codigo = $codigo;
    $this->nome = $nome; 
  }
}

try {
  $sql = <<<SQL
  SELECT m.codigo, p.nome
  FROM pessoa_clinica p INNER JOIN medico_clinica m on p.codigo = m.codigo 
  WHERE especialidade=?
  SQL;

  $especialidade = $_GET['especialidade'] ?? '';

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$especialidade]);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

$array = array();
while ($row = $stmt->fetch()) {
  $array[] = new Medico($row['codigo'], htmlspecialchars($row['nome']));
}
  
echo json_encode($array);