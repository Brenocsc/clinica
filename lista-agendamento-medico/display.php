<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
  SELECT a.data as data, a.horario as horario, a.nome as nome, a.sexo as sexo, a.email as email
  FROM agenda a right join medico m on a.codigoMedico = m.codigo
  WHERE m.crm = CRM
  SQL;

  //deve receber o crm do médico q estiver logado

  $stmt = $pdo->query($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HxH - Lista Agendamentos Médicos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header id="cabecalho">
        <a href="../"><img src="../images/logo.jpg" width="100" height="100"></a>
        <label>Health & Health</label>
    </header>
    <nav id="navegacao">
        <a href="../novo-funcionario/">Cadastra Funcionario</a> |
        <a href="../novo-paciente/">Cadastra Paciente</a> |
        <a href="../lista-funcionario/">Lista Funcionario</a> |
        <a href="../lista-paciente/">Lista Paciente</a> |
        <a href="../lista-endereco/">Lista Endereço</a> |
        <a href="../lista-agendamento/">Lista Todos Agendamentos</a> |
        <a href="../lista-agendamento-medico/">Lista Meus Agendamento</a>
    </nav>
    <main>
        <div class="container">
            <h3>Funcionários Cadastrados</h3>
            <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Data</th>
                <th>Horario</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Email</th>
            </tr>

            <?php
            while ($row = $stmt->fetch()) {
                data as data, a.horario as horario, a.nome as nome, a.sexo as sexo, a.email as email
                // Limpa os dados produzidos pelo usuário
                // com possibilidade de ataque XSS
                $nome = htmlspecialchars($row['nome']);
                $sexo = htmlspecialchars($row['sexo']);
                $email = htmlspecialchars($row['email']);
                $horario = htmlspecialchars($row['horario']);
                
                $data = new DateTime($row['data']);
                $dataFormatoDiaMesAno = $data->format('d-m-Y');

                echo <<<HTML
                <tr>
                    <td>$dataFormatoDiaMesAno</td>
                    <td>$horario</td>
                    <td>$nome</td> 
                    <td>$sexo</td>
                    <td>$email</td>
                </tr>      
                HTML;
            }
            ?>

            </table>
        </div>
    </main>
    <footer id="rodape">
        <div>
            <h4>Informações de Contato</h4>
            Email: <a href="mailto:abs_ferr@mail.com">abs_ferr@mail.com</a>  |  
            Telefone: <a href="tel:039-3225-9243">039-3225-9243</a>
            <p><i><strong>Como dizia Edgard Abbehusen, </strong></i>
                <q cite="https://www.42frases.com.br/frases-de-fisioterapia/">
                    Fisioterapia é gratidão e missão. Felicidade por mais uma etapa vencida ao final de um dia. É a certeza de que vale a pena ser guardião do movimento do mundo.
                </q>
            </p>
        </div>
    </footer>

</body>

</html>