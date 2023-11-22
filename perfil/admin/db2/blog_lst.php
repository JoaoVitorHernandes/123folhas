<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Blog</title>
    <link rel="stylesheet" href="../style_lst.css">
</head>
<body>
    <?php
        include("../db0/connection.php");

        session_start(); 
        if (!isset($_SESSION["Cod_Cliente"])) {
            header("Location: /123folhas/");
            exit();
        }

        if ($_SESSION["Cod_Cliente"] > 13) {
            header("Location: ../db0/erro.php");
            exit();
        }
        $sqlID = "SELECT Nome FROM Cliente WHERE Cod_cliente = {$_SESSION['Cod_Cliente']}";
        $resultID = $conn->query($sqlID);
        $rowID = $resultID->fetch_assoc();
        echo "<p>Nome Do Utilizador: " . $rowID['Nome'] . "</p>";
        if (isset($_GET['busca'])) {
            $busca = $_GET['busca'];
            if (!empty($busca)){
                $sql = "SELECT Cod_Blog, Titulo, Autor, Data_publicada, Gostei, Deslike, HTML_blog 
                FROM Blog 
                WHERE Cod_Blog = '$busca' 
                    OR Titulo LIKE '%$busca%' 
                    OR Autor LIKE '%$busca%'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_Blog, Titulo, Autor, Data_publicada, Gostei, Deslike, HTML_blog FROM Blog";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_Blog, Titulo, Autor, Data_publicada, Gostei, Deslike, HTML_blog FROM Blog";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    ?>
      <div id="div_centralizar_elementos">
        <a id="ADD" href="blog_add.php">+ Adicionar Blog</a>
        <a id="Voltar" href="../db0/inicio.php">Voltar</a>
        <form method="get" action="" id="formulario">
            <input type="text" name="busca" id="busca" placeholder="Buscar">
            <input type="submit" value="Buscar" id="button_submit">
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Publicação</th>
                <th>Like</th>
                <th>Deslike</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="blog_info.php?Cod_Blog=<?php echo $row['Cod_Blog']?>"><?php echo $row['Cod_Blog']?></a>
                </td>
                <td><?php echo $row['Titulo']?></td>
                <td><?php echo $row['Autor']?></td>
                <td><?php echo date('d/m/Y', strtotime($row['Data_publicada']))?></td>
                <td><?php echo $row['Gostei']?></td>
                <td><?php echo $row['Deslike']?></td>
                <td>
                    <a id="Editar" href="blog_edit.php?Cod_blog=<?php echo $row['Cod_Blog']?>" style="display: inline;">Editar</a>
                </td>
                <td onclick="remove(<?php echo $row['Cod_Blog']?>);">
                    <a id="Excluir" href="#" style="display: inline;">Excluir</a>
                </td>
            </tr>
        <?php
                }
             }
        ?> 
    </table>
    <script>
        function remove(ID) {
            if (confirm("Tem certeza que deseja excluir ese registro?")) {
                location.href = 'blog_del_php.php?Cod_blog='+ID
            }
        }
    </script>
</body>
</html>