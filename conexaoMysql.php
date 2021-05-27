<?php

function mysqlConnect() {
  $db_host = "db"; //"fdb30.awardspace.net";
  $db_username = "3770853_db";
  $db_password = "tucano2016";
  $db_name = "3770853_db";

  // dsn é apenas um acrônimo de database source name
  $dsn = "mysql:host=$db_host;port=3306;dbname=$db_name;charset=utf8mb4";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ativa o modo de erros para lançar exceções    
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // altera o modo padrão do método fetch para FETCH_ASSOC
  ];

    $pdo = new PDO($dsn, $db_username, $db_password, $options);
    return $pdo;
}

?>
