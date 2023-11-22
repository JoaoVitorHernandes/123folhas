<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Acessa</title>
    <link rel="stylesheet" href="../style_lst.css">
</head>
<body>
    <?php
        session_start(); 
        if (!isset($_SESSION["Cod_Cliente"])) {
            header("Location: /123folhas/");
            exit();
        }

        if ($_SESSION["Cod_Cliente"] > 13) {
            header("Location: ../db0/erro.php");
            exit();
        }

        include("../db0/connection.php");
        $sqlID = "SELECT Nome FROM Cliente WHERE Cod_cliente = {$_SESSION['Cod_Cliente']}";
        $resultID = $conn->query($sqlID);
        $rowID = $resultID->fetch_assoc();
        echo "<p>Nome Do Utilizador: " . $rowID['Nome'] . "</p>";
        if (isset($_GET['busca'])) { 
            $busca = $_GET['busca'];
            if (!empty($busca)){
                $sql = "SELECT a.Cod_acesso, a.fk_Cliente_Cod_Cliente, a.fk_Blog_Cod_blog
                FROM acessa a
                INNER JOIN cliente c ON a.fk_Cliente_Cod_Cliente = c.Cod_Cliente
                INNER JOIN Blog b ON a.fk_Blog_Cod_blog = b.Cod_blog
                WHERE a.Cod_acesso = '$busca' OR c.Nome LIKE '%$busca%' OR b.Titulo LIKE '%$busca%'";                 
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_acesso, fk_Cliente_Cod_Cliente, fk_Blog_Cod_blog FROM acessa";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_acesso, fk_Cliente_Cod_Cliente, fk_Blog_Cod_blog FROM acessa";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="acessa_add.php">+ Adicionar Acesso</a>
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
                <th>Nome</th>
                <th>Blog</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="acessa_info.php?Cod_acesso=<?php echo $row['Cod_acesso']?>"><?php echo $row['Cod_acesso']?></a>
                </td>
                <td>
                    <?php 
                        $fkCod_Cliente = $row['fk_Cliente_Cod_Cliente'];
                        $sqlCliente = "SELECT Nome FROM Cliente WHERE Cod_Cliente = $fkCod_Cliente";
                        $resultCliente = $conn->query($sqlCliente);  
                        $clienteData = $resultCliente->fetch_assoc();
                        echo $clienteData['Nome'];
                    ?>
                </td>
                <td>
                    <?php 
                        $fkCod_Lugar = $row['fk_Blog_Cod_blog'];
                        $sqlLugar = "SELECT Titulo FROM Blog WHERE Cod_blog = $fkCod_Lugar";
                        $resultLugar = $conn->query($sqlLugar);  
                        $LugarData = $resultLugar->fetch_assoc();
                        echo $LugarData['Titulo'];
                    ?>
                </td>
                <td onclick="remove(<?php echo $row['Cod_acesso']?>);">
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
                location.href = 'acessa_del_php.php?Cod_acesso='+ID
            }
        }
    </script>
</body>
</html>