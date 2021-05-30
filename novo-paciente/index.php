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
        <title>HxH - Novo Paciente</title>
        <script src="script.js"></script>
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
            <a href="../lista-agendamento/">Lista Todos Agendamentos</a>
            <?php
            if (isset($_SESSION['crm'])) {
                echo <<<HTML
                | <a href="../lista-agendamento-medico/">Lista Meus Agendamento</a>
                HTML;
            }
            ?>
        </nav>
        <main>
            <form action="cadastrar-paciente.php" method="post">
                <h2>Dados Básicos:</h2>
                <div>
                    <label for="nome">Nome completo: </label>
                    <input type="text" name="nome" placeholder="nome..." size="50">
                </div>
                <div>
                    <label>Sexo: </label>
                    <select name="sexo">
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                    </select>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" name="email" placeholder="email..." size="50">
                </div>
                <div>
                    <label for="telefone">Telefone: </label>
                    <input type="tel" name="telefone" placeholder="telefone..." size="50">
                </div>

                <h2>Endereço:</h2>
                <div>
                    <label for="cep">CEP: </label>
                    <input type="text" name="cep" onkeyup="searchEndereco(event)" size="9" required>
                </div>
                <div>
                    <label for="logradouro">Logradouro: </label>
                    <input type="text" id="logradouro" name="logradouro" required>
                </div>
                <div>
                    <label for="cidade">Cidade: </label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
                <div>
                    <label for="estado">Estado: </label>
                    <input type="text" id="estado" name="estado" required>
                </div>

                <h2>Informações Pessoais:</h2>
                <div>
                    <label for="peso">Peso (Kg): </label>
                    <input type="number" name="peso" min="0" required>
                </div>
                <div>
                    <label for="altura">Altura (cm): </label>
                    <input type="number" name="altura" min="0" required>
                </div>
                <div>
                    <label for="tipoSanguineo">Tipo Sanguíneo: </label>
                    <select name="tipoSanguineo">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                
                <input id="div_submit" type="submit" value="Submit">
                
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

