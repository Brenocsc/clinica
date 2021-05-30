<?php
  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $data = $nome = $sexo = $email = "";

  try {
    if (isset($_POST["data"])) $data = $_POST["data"];
    if (isset($_POST["horario"])) $horario = $_POST["horario"];
    if (isset($_POST["nome"])) $nome = $_POST["nome"];
    if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
    if (isset($_POST["email"])) $email = $_POST["email"];
    if (isset($_POST["codigoMedico"])) $codigoMedico = $_POST["codigoMedico"];

    $stmt = $pdo->prepare('INSERT INTO agenda_clinica (data, horario, nome, sexo, email, codigoMedico) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$data, $horario, $nome, $sexo, $email, $codigoMedico]);

    header("location: index.php");
    exit();
  }
  catch (Exception $e) {
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
?>