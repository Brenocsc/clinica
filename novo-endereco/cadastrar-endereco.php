<?php            
  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $cep = $logradouro = $cidade = $estado = "";

  try {
    if (isset($_POST["cep"])) $cep = $_POST["cep"];
    if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
    if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
    if (isset($_POST["estado"])) $estado = $_POST["estado"];

    $stmt = $pdo->prepare('INSERT INTO base_enderecos_ajax_clinica (cep, logradouro, cidade, estado) VALUES (?, ?, ?, ?)');
    $stmt->execute([$cep, $logradouro, $cidade, $estado]);

    header("location: index.html");
    exit();
  }
  catch (Exception $e) {
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
?>