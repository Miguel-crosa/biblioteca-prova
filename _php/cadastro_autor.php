<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_css/formularios.css">
    <title>Cadastro Autor</title>
    <style>
    </style>
</head>

<body>

    <header class="site-header">
        <div class="wrap">
            <div class="brand">Biblioteca <small>Admin</small></div>
        </div>
    </header>

    <main class="container">
        <h1>Cadastro de Autor</h1>

        <div class="card">
            <form method="post" class="form">
                <div class="form-group">
                    <label for="Nome">Nome</label>
                    <input type="text" id="Nome" placeholder="Nome da Pessoa" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="Pseudonimo">Pseudônimo</label>
                    <input type="text" id="Pseudonimo" placeholder="Pseudônimo da Pessoa" name="pseudonimo">
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
                    <label for="Data_Nascimento">Data de Nascimento</label>
                    <input type="date" id="Data_Nascimento" name="data">
                </div>
                <div class="form-group">
                    <label for="Celular">Número Celular</label>
                    <input type="tel" id="Celular" name="celular">
                </div>
                <div class="form-group">
                    <label for="Endereco">Endereço</label>
                    <input type="text" id="Endereco" name="endereco">
                </div>
                <div class="form-group">
                    <label for="Numero">Número Residência</label>
                    <input type="number" id="Numero" name="numero">
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
        $pseudonimo = $_POST["pseudonimo"];
        $cpf = $_POST["cpf"];
        $rg = $_POST["rg"];
        $data = $_POST["data"];
        $celular = $_POST["celular"];
        $endereco = $_POST["endereco"];
        $numero = $_POST["numero"];
        $cep = $_POST["cep"];


        $data2 = strtotime($data);
        $dataFinal = date("Y/m/d", $data2);


        $sql = "INSERT INTO cadastro_autor(
        cadastro_autor_nome_completo,
        cadastro_autor_pseudonimo,
        cadastro_autor_cpf,
        cadastro_autor_rg,
        cadastro_autor_nascimento,
        cadastro_autor_celular,
        cadastro_autor_endereco,
        cadastro_autor_numero_residencia,
        cadastro_autor_cep
        )VALUES
        (
        '$nome',
        '$pseudonimo',
        '$cpf',
        '$rg',
        '$dataFinal',
        '$celular',
        '$endereco',
        '$numero',
        '$cep'
        )";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Autor cadastrado com sucesso!') </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }

        mysqli_close($conn);
    }

    ?>

    <script src="../_js/autor.js" defer></script>

</body>

</html>