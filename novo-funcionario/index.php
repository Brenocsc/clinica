<?php
    require_once "../autenticacao.php";
    require_once "../conexaoMysql.php";
    
    session_start();
    $pdo = mysqlConnect();
    // checkUsuarioLogadoOrDie($pdo);
?>
<!DOCTYPE html>
<html lang='pt-BR'>

    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <title>HxH - Novo Funcionario</title>
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
            <div>
                <button id="btn_medico" type="button" onclick="showMedico()">
                    SOU MEDICO
                </button>
                <button id="btn_nao_medico" type="button" onclick="hideMedico()">
                    NÃO SOU MÉDICO
                </button>
            </div>

            <form name="formCadastro" action="cadastrar-funcionario.php" method="post">
                <h2>Dados Básicos:</h2>
                <div>
                    <label for="nome">Nome completo: </label>
                    <input type="text" name="nome" placeholder="nome..." size="50" required>
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
                    <input type="email" name="email" placeholder="email..." size="50" required>
                </div>
                <div>
                    <label for="telefone">Telefone: </label>
                    <input type="tel" name="telefone" placeholder="telefone..." size="50" required>
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

                <h2>Informações do Contrato:</h2>
                <div>
                    <label for="dataContrato">Início do Contrato: </label>
                    <input type="date" name="dataContrato" required>
                </div>
                <div>
                    <label for="salario">Salário: </label>
                    <input type="number" name="salario"  min="1" step="any" required>
                </div>
                <div>
                    <label for="senha">Senha: </label>
                    <input type="password" name="senha" min="0" required>
                </div>

                <div id="divMedico"></div>
                
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

