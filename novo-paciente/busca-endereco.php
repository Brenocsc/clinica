<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

class Endereco
{
  public $logradouro;
  public $cidade;
  public $estado;

  function __construct($logradouro, $cidade, $estado)
  {
    $this->logradouro = $logradouro;
    $this->cidade = $cidade; 
    $this->estado = $estado;
  }
}

try {
  $sql = <<<SQL
  SELECT logradouro, cidade, estado
  FROM base_enderecos_ajax_clinica
  WHERE cep=?
  SQL;

  $cep = $_GET['cep'] ?? '';

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

if ($row = $stmt->fetch()) {
  $endereco = new Endereco($row['logradouro'], $row['cidade'], $row['estado']);
} else {
  $endereco = new Endereco('', '', '');
}
  
echo json_encode($endereco);