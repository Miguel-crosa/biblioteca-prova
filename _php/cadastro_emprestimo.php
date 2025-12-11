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
    <title>Cadastro Empréstimo</title>
</head>

<body>

    <header class="site-header">
        <div class="wrap">
            <div class="brand">Biblioteca <small>Admin</small></div>
        </div>
    </header>

    <main class="container">
        <h1>Cadastro de Empréstimo</h1>

        <div class="card">
            <form method="post" class="form">
                <div class="form-group">
                    <label for="data_saida">Data de Saída</label>
                    <input type="date" name="data_saida" id="data_saida" required>
                </div>

                <div class="form-group">
                    <label for="data_limite">Data Limite</label>
                    <input type="date" name="data_limite" id="data_limite" required>
                </div>

                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <select name="usuario" id="usuario" required>
                        <option value="">Selecione um Usuário</option>
                        <?php
                        $sqlUsuarios = "SELECT cadastro_usuario_id, cadastro_usuario_nome FROM cadastro_usuarios ORDER BY cadastro_usuario_nome";
                        $resU = $conn->query($sqlUsuarios);
                        if ($resU) {
                            while ($u = $resU->fetch_assoc()) {
                                $id = $u['cadastro_usuario_id'];
                                $nome = htmlspecialchars($u['cadastro_usuario_nome']);
                                echo "<option value='$id'>$nome</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="obra">Obra</label>
                    <select name="obra" id="obra" required>
                        <option value="">Selecione uma Obra</option>
                        <?php
                        $sqlObras = "SELECT cadastro_obra_id, cadastro_obra_nome FROM cadastro_obra ORDER BY cadastro_obra_nome";
                        $resO = $conn->query($sqlObras);
                        if ($resO) {
                            while ($o = $resO->fetch_assoc()) {
                                $id = $o['cadastro_obra_id'];
                                $nomeObra = htmlspecialchars($o['cadastro_obra_nome']);
                                echo "<option value='$id'>$nomeObra</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn">Cadastrar Empréstimo</button>
                </div>
            </form>
        </div>
    </main>

    <div class="footer">
        <button type="button" class="btn ghost" onclick="window.location.href='../'">← Voltar</button>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data_saida = $_POST['data_saida'];
        $data_limite = $_POST['data_limite'];
        $usuario = $_POST['usuario'];
        $obra = $_POST['obra'];



        $sql = "INSERT INTO cadastro_emprestimos (
                cadastro_emprestimo_data_saida,
                cadastro_emprestimo_id_usuario,
                cadastro_emprestimo_id_obra,
                cadastro_emprestimo_data_limite
            ) VALUES (
                '$data_saida',
                '$usuario',
                '$obra',
                '$data_limite'
            )";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Empréstimo cadastrado com sucesso!') </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }
    ?>

</body>

</html>