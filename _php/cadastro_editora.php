<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_css/formularios.css">
    <title>Cadastro Editora</title>
</head>

<body>

    <header class="site-header">
        <div class="wrap">
            <div class="brand">Biblioteca <small>Admin</small></div>
        </div>
    </header>

    <main class="container">
        <h1>Cadastro de Editora</h1>

        <div class="card">
            <form method="post" class="form">
                <div class="form-group">
                    <label for="Nome">Nome da Editora</label>
                    <input type="text" id="Nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="Foco">Categorias Focadas</label>
                    <input type="text" id="Foco" name="foco">
                </div>
                <div class="form-group">
                    <label for="Fundacao">Data Fundação</label>
                    <input type="date" id="Fundacao" name="fundacao">
                </div>
                <div class="form-group">
                    <label for="Cnpj">CNPJ</label>
                    <input type="text" id="Cnpj" name="cnpj">
                </div>
                <div class="form-group">
                    <label for="Endereco">Endereço</label>
                    <input type="text" id="Endereco" name="endereco">
                </div>
                <div class="form-group">
                    <label for="Bairro">Bairro</label>
                    <input type="text" id="Bairro" name="bairro">
                </div>
                <div class="form-group">
                    <label for="Cidade">Cidade</label>
                    <input type="text" id="Cidade" name="cidade">
                </div>
                <div class="form-group">
                    <label for="Estado">Estado</label>
                    <input type="text" id="Estado" name="estado">
                </div>
                <div class="form-group">
                    <label for="Cep">CEP</label>
                    <input type="text" id="Cep" name="cep" onblur="buscarCep()">
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

    if ($_SERVER["REQUEST_METHOD"] == ("POST")) {
        $servername = "localhost";
        $database = "biblioteca";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($servername, $username, $password, $database);

        $nome = $_POST["nome"];
        $foco = $_POST["foco"];
        $fundacao = $_POST["fundacao"];
        $cnpj = $_POST["cnpj"];
        $endereco = $_POST["endereco"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $cep = $_POST["cep"];


        $sql = "INSERT INTO cadastro_editora(
        cadastro_editora_nome,
        cadastro_editora_foco,
        cadastro_editora_fundacao,
        cadastro_editora_cnpj,
        cadastro_editora_endereco,
        cadastro_editora_bairro,
        cadastro_editora_cidade,
        cadastro_editora_estado,
        cadastro_editora_cep
        )VALUES(
        '$nome',
        '$foco',
        '$fundacao',
        '$cnpj',
        '$endereco',
        '$bairro',
        '$cidade',
        '$estado',
        '$cep'
        )";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Editora cadastrada com sucesso!') </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }

        mysqli_close($conn);
    }

    ?>

    <script src="../_js/editora.js" defer></script>

</body>

</html>