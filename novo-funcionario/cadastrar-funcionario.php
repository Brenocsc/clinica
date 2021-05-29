<?php            
  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $nome = $sexo = $email = $telefone = $cep = $logradouro = "";
  $dataContrato = $salario = $senha = $cidade = $estado = "";

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
    if (isset($_POST["dataContrato"])) $dataContrato = $_POST["dataContrato"];
    if (isset($_POST["salario"])) $salario = $_POST["salario"];
    if (isset($_POST["senha"])) $senha = $_POST["senha"];
    if (isset($_POST["especialidade"])) $especialidade = $_POST["especialidade"];
    if (isset($_POST["crm"])) $crm = $_POST["crm"];


    $stmt = $pdo->prepare('INSERT INTO pessoa_clinica (nome, sexo, email, telefone, cep, logradouro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    if (! $stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado]))
      throw new Exception('Falha na operação 1');

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $ultimoIdInserido = $pdo->lastInsertId();
    $stmt = $pdo->prepare('INSERT INTO funcionario_clinica (codigo, dataContrato, salario, senhaHash) VALUES (?, ?, ?, ?)');
    if (! $stmt->execute([$ultimoIdInserido, $dataContrato, $salario, $senhaHash]))
      throw new Exception('Falha na operação 2');

    if (isset($especialidade) and isset($crm)) {
      // $ultimoIdInserido = $pdo->lastInsertId();
      $stmt = $pdo->prepare('INSERT INTO medico_clinica (codigo, especialidade, crm) VALUES (?, ?, ?)');
      if (! $stmt->execute([$ultimoIdInserido, $especialidade, $crm]))
        throw new Exception('Falha na operação 3');
    }

    $pdo->commit();

    header("location: index.php");
    exit();
  }
  catch (Exception $e) {
    $pdo->rollBack();
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
?>