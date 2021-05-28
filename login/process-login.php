<?php
  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  session_start();
  
  $email = $_POST['email'] ?? '';
  $senha = $_POST['senha'] ?? '';

  $sql = <<<SQL
  SELECT f.codigo, senhaHash
  FROM pessoa_clinica p INNER JOIN funcionario_clinica f ON p.codigo = f.codigo
  WHERE email = ?
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);

  if ($row = $stmt->fetch()) {
  //   // if (password_verify($senha, $row['senhaHash'])) {
    if ($senha == $row['senhaHash']) {
      $response['success'] = true;
      $response['detail'] = '../principal-restrita/';

      $_SESSION['codigo'] = $row['codigo'];
      $_SESSION['email'] = $email;
      $_SESSION['loginString'] = hash('sha512', $row['senhaHash'] . $_SERVER['HTTP_USER_AGENT']);
    } else {
      $response['success'] = false;
      $response['detail'] = 'Senha incorreta';
    }
  } else {
    $response['success'] = false;
    $response['detail'] = 'Email não cadastrado';
  }

  echo json_encode($response);
