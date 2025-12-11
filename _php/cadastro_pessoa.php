<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_css/formularios.css">
    <title>Cadastro Pessoa</title>
</head>

<body>

    <header class="site-header">
        <div class="wrap">
            <div class="brand">Biblioteca <small>Admin</small></div>
        </div>
    </header>

    <main class="container">
        <h1>Cadastro de Pessoa</h1>

        <div class="card">
            <form method="post" class="form">
                <div class="form-group">
                    <label for="Nome">Nome</label>
                    <input type="text" id="Nome" placeholder="Nome da Pessoa" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="Data_Nascimento">Data de Nascimento</label>
                    <input type="date" id="Data_Nascimento" name="data" required>
                </div>
                <div class="form-group">
                    <label for="Cpf">CPF</label>
                    <input type="text" id="Cpf" placeholder="000.000.000-00" name="cpf">
                </div>
                <div class="form-group">
                    <label for="Rg">RG</label>
                    <input type="text" id="Rg" name="rg">
                </div>
                <div class="form-group">
                    <label for="Endereco">Endereço</label>
                    <input type="text" id="Endereco" name="endereco">
                </div>
                <div class="form-group">
                    <label for="Numero">Número</label>
                    <input type="number" id="Numero" name="numero">
                </div>
                <div class="form-group">
                    <label for="Bairro">Bairro</label>
                    <input type="text" id="Bairro" name="bairro">
                </div>
                <div class="form-group">
                    <label for="Cep">CEP</label>
                    <input type="text" id="Cep" onblur="buscarCep()" name="cep">
                </div>
                <div class="form-group">
                    <label for="Cidade">Cidade</label>
                    <input type="text" id="Cidade" name="cidade">
                </div>
                <div class="form-group">
                    <label for="Celular">Número Celular</label>
                    <input type="tel" id="Celular" name="celular">
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn">Enviar</button>
                </div>
            </form>
        </div>

    </main>

    <div class="footer">
        <button type="button" class="btn ghost" onclick="window.location.href='../'">← Voltar</button>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === ("POST")) {

        $servername = "localhost";
        $database = "biblioteca";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Conexão falhou: " . mysqli_connect_error());
        }


        $nome = $_POST["nome"];
        $data = $_POST["data"];
        $cpf = $_POST["cpf"];
        $rg = $_POST["rg"];
        $endereco = $_POST["endereco"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cep = $_POST["cep"];
        $cidade = $_POST["cidade"];
        $celular = $_POST["celular"];


        $data2 = strtotime($data);
        $dataFinal = date("Y/m/d", $data2);


        $sql = "INSERT INTO cadastro_usuarios(
        cadastro_usuario_nome,
        cadastro_usuario_data_nascimento,
        cadastro_usuario_cpf,
        cadastro_usuario_rg,
        cadastro_usuario_endereco,
        cadastro_usuario_numero,
        cadastro_usuario_bairro,
        cadastro_usuario_cep,
        cadastro_usuario_cidade,
        cadastro_usuario_numero_celular
        )VALUES
        (
        '$nome',
        '$dataFinal',
        '$cpf',
        '$rg',
        '$endereco',
        '$numero',
        '$bairro',
        '$cep',
        '$cidade',
        '$celular'
        )";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Pessoa cadastrada com sucesso!') </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }

        mysqli_close($conn);
    }

    ?>

    <script src="../_js/pessoa.js" defer></script>

</body>

</html>