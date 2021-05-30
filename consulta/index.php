<?php
require_once "../conexaoMysql.php";

$pdo = mysqlConnect();

try {
$sql = <<<SQL
SELECT DISTINCT especialidade FROM medico_clinica mc
SQL;

$stmt = $pdo->query($sql);
} catch (Exception $e) {
exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang='pt-BR'>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="main.css">
        <title>HxH - Novo Agendamento</title>
        <script src="script.js"></script>
    </head>

    <body>
        <header id="cabecalho">
            <a href="../"><img src="../images/logo.jpg" width="100" height="100"></a>
            <label>Health & Health</label>
            <button id="btn_login" type="button">
                LOGIN
            </button>
            <script>
                document.getElementById('btn_login').addEventListener("click", goLogin);
                function goLogin(e) {
                    window.location.href="../login/"
                }
            </script>
        </header>
        <nav id="navegacao">
            <a href="../galeria/">Galeria</a> |
            <a href="../novo-endereco/">Novo Endereço</a> |
            <a href="../consulta/">Agendamento Consulta</a>
        </nav>
        <main>
            <form id="principal" action="cadastra-agenda.php" method="post">
                <h2>Dados Pessoais:</h2>
                <div>
                    <label for="nome">Nome completo: </label>
                    <input type="text" name="nome" placeholder="nome..." size="50" required>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" name="email" placeholder="email..." size="50" required>
                </div>
                <div>
                    <label>Sexo: </label>
                    <select name="sexo">
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                    </select>
                </div>
                
                <h2>Dados da consulta</h2>
                <div>
                    <label>Especialidade Médica: </label>
                    <select name="especialidade" onchange="showMedico(event)" required>
                        <option disabled selected value> -- selecione uma opção -- </option>
                        <?php
                        while ($row = $stmt->fetch()) {
                            $especialidade = $row['especialidade'];
                            echo <<<HTML
                                <option value="{$especialidade}">$especialidade</option>
                            HTML;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="codigoMedico">Nome do Médico: </label>
                    <select id="selectMedico" name="codigoMedico" onchange="showHorario()" required disabled>
                    </select>
                </div>
                <div>
                    <label for="data">Data: </label>
                    <input id="inputData" type="date" name="data" onchange="showHorario()" required>
                </div>
                <div>
                    <label for="horario">Hora da consulta: </label>
                    <select id="selectHorario" name="horario" required disabled>
                    </select>
                </div>
                <input id="submit" type="submit" value="Submit">
            </form>
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

