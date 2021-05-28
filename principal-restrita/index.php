<?php
    require_once "../autenticacao.php";
    require_once "../conexaoMysql.php";
    
    session_start();
    $pdo = mysqlConnect();
    checkUsuarioLogadoOrDie($pdo);
?>
<!DOCTYPE html>
<html lang='pt-BR'>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="main.css">
        <title>HxH - Início Restrita</title>
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
            <a href="../lista-agendamento/">Lista Agendamentos</a> |
            <a href="../lista-agendamento-medico/">Lista Agendamento Medicos</a>
        </nav>
        <main>
            <div id="info">
                <h1>Você esta na página restrita</h1>
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
