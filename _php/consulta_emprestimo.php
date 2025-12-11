<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_css/formularios.css">
    <title>Consulta Empréstimos</title>
    <style>
        body {
            color: white;
        }

        th {
            color: white;
        }

        .status-expired,
        .status-warn,
        .status-ok {
            color: white;
        }
    </style>
</head>

<body>

    <header class="site-header">
        <div class="wrap">
            <div class="brand">Biblioteca <small>Admin</small></div>
        </div>
    </header>

    <main class="container">
        <h1>Consulta de Empréstimos</h1>

        <div class="card">
            <?php

            $servername = "localhost";
            $database = "biblioteca";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Conexão falhou: " . mysqli_connect_error());
            }

            // VERIFICA ESCOLHA DE CAMPOS
            $sql = "SELECT
                emp.cadastro_emprestimos_id,
                us.cadastro_usuario_nome,
                us.cadastro_usuario_id,
                obra.cadastro_obra_nome,
                obra.cadastro_obra_id,
                emp.cadastro_emprestimo_data_saida,
                emp.cadastro_emprestimo_data_limite
            FROM
                cadastro_emprestimos emp
            INNER JOIN
                cadastro_usuarios us ON emp.cadastro_emprestimo_id_usuario = us.cadastro_usuario_id
            INNER JOIN
                cadastro_obra obra ON emp.cadastro_emprestimo_id_obra = obra.cadastro_obra_id
            ";

            $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

            if (mysqli_num_rows($resultado) > 0) {
                echo "<table>";
                echo "<thead><tr>";
                echo "<th>ID</th>";
                echo "<th>Usuário</th>";
                echo "<th>Obra</th>";
                echo "<th>Data Saída</th>";
                echo "<th>Data Limite</th>";
                echo "<th>Status</th>";
                echo "</tr></thead>";
                echo "<tbody>";

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $dataSaida = $linha['cadastro_emprestimo_data_saida'];
                    $dataLimite = $linha['cadastro_emprestimo_data_limite'];
                    $hoje = date('Y-m-d');

                    $dataLimitoObj = new DateTime($dataLimite);
                    $hojeObj = new DateTime($hoje);
                    $diferenca = $hojeObj->diff($dataLimitoObj);

                    if ($hojeObj > $dataLimitoObj) {
                        $diasVencidos = $diferenca->days;
                        $status = "<span class='status-expired'>Vencido há $diasVencidos dias</span>";
                    } elseif ($diferenca->days == 0) {
                        $status = "<span class='status-warn'>Termina hoje</span>";
                    } else {
                        $diasRestantes = $diferenca->days;
                        $status = "<span class='status-ok'>Faltam $diasRestantes dias</span>";
                    }

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($linha['cadastro_emprestimos_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($linha['cadastro_usuario_nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($linha['cadastro_obra_nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($dataSaida) . "</td>";
                    echo "<td>" . htmlspecialchars($dataLimite) . "</td>";
                    echo "<td>$status</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p class='meta'>Nenhum empréstimo registrado.</p>";
            }

            mysqli_close($conn);

            ?>
        </div>

        <div class="btn-group">
            <button type="button" class="btn ghost" onclick="window.location.href='../'">← Voltar</button>
        </div>
    </main>

    <footer class="site-footer">
        <div class="wrap">
            <div class="muted">&copy; <span id="year"></span> Biblioteca</div>
        </div>
    </footer>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

</body>

</html>