<?php

function checkUsuarioLogado($mysqli) {
  if (!isset($_SESSION['codigo'], $_SESSION['loginString']))
    return false;
  
  $codigo = $_SESSION['codigo'];
  $loginString = $_SESSION['loginString'];
    
  $SQL = "
    SELECT senhaHash 
    FROM funcionario_clinica
    WHERE codigo = ?
  ";
  
  $stmt = $mysqli->prepare($SQL);
  $stmt->execute([$codigo]);
  
  if ($row = $stmt->fetch()) {
    $loginStringCheck = hash('sha512', $row['senhaHash'] . $_SERVER['HTTP_USER_AGENT']);
    
    if (hash_equals($loginStringCheck, $loginString))
      return true;
  }
  
  return false;
}

function checkUsuarioLogadoOrDie($mysqli) {
  if (!checkUsuarioLogado($mysqli)) {
    header("Location: ../login/index.html");
    die();
  }
}