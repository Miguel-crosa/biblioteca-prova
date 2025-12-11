<?php

$servername = "localhost";
$database = "biblioteca";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_css/formularios.css">
    <title>Cadastro Livro</title>
</head>

<body>

    <header class="site-header">
        <div class="wrap">
            <div class="brand">Biblioteca <small>Admin</small></div>
        </div>
    </header>

    <main class="container">
        <h1>Cadastro de Livro</h1>

        <div class="card">
            <form method="post" class="form">
                <div class="form-group">
                    <label for="nome">Nome da Obra</label>
                    <input type="text" name="nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="data">Data Lançamento</label>
                    <input type="date" name="data" id="data">
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <input type="text" name="categoria" id="categoria">
                </div>

                <div class="form-group">
                    <label for="subtitulo">Subtítulo</label>
                    <input type="text" name="subtitulo" id="subtitulo">
                </div>

                <div class="form-group">
                    <label for="autor">Autor</label>
                    <select name="autor" id="autor" required>
                        <option value="">Selecione um Autor</option>
                        <?php
                        $sqlPessoas = "SELECT cadastro_autor_id, cadastro_autor_nome_completo FROM cadastro_autor ORDER BY cadastro_autor_nome_completo";
                        $resP = $conn->query($sqlPessoas);
                        if ($resP) {
                            while ($r = $resP->fetch_assoc()) {
                                $id = $r['cadastro_autor_id'];
                                $nome_autor = htmlspecialchars($r['cadastro_autor_nome_completo']);
                                echo "<option value='$id'>$nome_autor</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="editora">Editora</label>
                    <select name="editora" id="editora" required>
                        <option value="">Selecione uma Editora</option>
                        <?php
                        $sqlEditora = "SELECT cadastro_editora_id, cadastro_editora_nome FROM cadastro_editora ORDER BY cadastro_editora_nome";
                        $resE = $conn->query($sqlEditora);
                        if ($resE) {
                            while ($r = $resE->fetch_assoc()) {
                                $id = $r['cadastro_editora_id'];
                                $nome_editora = htmlspecialchars($r['cadastro_editora_nome']);
                                echo "<option value='$id'>$nome_editora</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn">Cadastrar Livro</button>
                </div>
            </form>
        </div>
    </main>

    <section class="footer">
        <button type="button" class="btn ghost" onclick="window.location.href='../'">← Voltar</button>
    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $data = $_POST["data"];
        $categoria = $_POST["categoria"];
        $subtitulo = $_POST["subtitulo"];
        $autor = $_POST["autor"];
        $editora = $_POST["editora"];

        $sql = "INSERT INTO cadastro_obra(
        cadastro_obra_nome,
        cadastro_obra_datalancamento,
        cadastro_obra_categoria,
        cadastro_obra_subtitulo,
        cadastro_obra_autor_id,
        cadastro_obra_editora_id
        )VALUES(
        '$nome',
        '$data',
        '$categoria',
        '$subtitulo',
        '$autor',
        '$editora'
        )";


        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Livro cadastrado com sucesso!') </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }
    ?>

</body>

</html>