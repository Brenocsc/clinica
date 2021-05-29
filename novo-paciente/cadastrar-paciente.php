<?php            
  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $nome = $sexo = $email = $telefone = $cep = $logradouro = "";
  $peso = $altura = $cidade = $estado = $tipoSanguineo = "";

  try {
    $pdo->beginTransaction();

    if (isset($_POST["nome"])) $nome = $_POST["nome"];
    if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
    if (isset($_POST["email"])) $email = $_POST["email"];
    if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
    if (isset($_POST["cep"])) $cep = $_POST["cep"];
    if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
    if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];
    if (isset($_POST["peso"])) $peso = $_POST["peso"];
    if (isset($_POST["altura"])) $altura = $_POST["altura"];
    if (isset($_POST["tipoSanguineo"])) $tipoSanguineo = $_POST["tipoSanguineo"];

    $stmt = $pdo->prepare('INSERT INTO pessoa_clinica (nome, sexo, email, telefone, cep, logradouro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    if (! $stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado]))
      throw new Exception('Falha na operação 1');

    $ultimoIdInserido = $pdo->lastInsertId();
    $stmt = $pdo->prepare('INSERT INTO paciente_clinica (codigo, peso, altura, tipoSanguineo) VALUES (?, ?, ?, ?)');
    if (! $stmt->execute([$ultimoIdInserido, $peso, $altura, $tipoSanguineo]))
      throw new Exception('Falha na operação 2');

    $pdo->commit();

    header("location: index.php");
    exit();
  }
  catch (Exception $e) {
    $pdo->rollBack();
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
?>