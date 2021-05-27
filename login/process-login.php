<?php
  require "../conexaoMysql.php";
  $pdo = mysqlConnect();
  
  $email = $_POST['email'] ?? '';
  $senha = $_POST['senha'] ?? '';

  $sql = <<<SQL
  SELECT senhaHash
  FROM pessoa_clinica p INNER JOIN funcionario_clinica f ON p.codigo = f.codigo
  WHERE email = ?
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);

  if ($row = $stmt->fetch()) {
    $checkSenha = $row['senhaHash'];
  //   // if (password_verify($senha, $row['senhaHash'])) {
    if ($senha == $row['senhaHash']) {
      $res['success'] = true;
    } else {
      $res['success'] = false;
    }
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
