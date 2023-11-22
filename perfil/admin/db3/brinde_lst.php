<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Brinde</title>
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
                $sql = "SELECT Cod_Produto, Nome, Descricao, Preco 
                FROM Brinde 
                WHERE Cod_Produto = '$busca' 
                    OR Nome LIKE '%$busca%' 
                    OR Preco = '$busca'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_Produto, Nome, Descricao, Preco FROM Brinde";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_Produto, Nome, Descricao, Preco FROM Brinde";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="brinde_add.php">+ Adicionar Brinde</a>
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
                <th>Brinde</th>
                <th>Descrição</th>
                <th>Preço</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="brinde_info.php?Cod_Produto=<?php echo $row['Cod_Produto']?>"><?php echo $row['Cod_Produto']?></a>
                </td>
                <td><?php echo $row['Nome']?></td>
                <td><?php echo $row['Descricao']?></td>
                <td><?php echo $row['Preco']?></td>
                <td>
                    <a id="Editar" href="brinde_edit.php?Cod_Produto=<?php echo $row['Cod_Produto']?>" style="display: inline;">Editar</a>
                </td>
                <td onclick="remove(<?php echo $row['Cod_Produto']?>);">
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
                location.href = 'brinde_del_php.php?Cod_Produto='+ID
            }
        }
    </script>
</body>
</html>