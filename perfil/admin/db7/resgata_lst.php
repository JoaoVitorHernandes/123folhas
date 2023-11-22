<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Resgata</title>
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
                $sql = "SELECT r.Cod_resgate, r.fk_Cliente_Cod_Cliente, r.fk_Brinde_Cod_produto, r.Quantidade, c.Nome AS NomeCliente, b.Nome AS NomeProduto
                FROM resgata r
                INNER JOIN cliente c ON r.fk_Cliente_Cod_Cliente = c.Cod_Cliente
                INNER JOIN brinde b ON r.fk_Brinde_Cod_produto = b.Cod_produto
                WHERE r.Cod_resgate = '$busca'
                OR c.Nome LIKE '%$busca%'
                OR b.Nome LIKE '%$busca%'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_resgate, fk_Cliente_Cod_Cliente, fk_Brinde_Cod_produto, Quantidade FROM resgata";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_resgate, fk_Cliente_Cod_Cliente, fk_Brinde_Cod_produto, Quantidade FROM resgata";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
 
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="resgata_add.php">+ Adicionar Resgate</a>
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
                <th>Brinde</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="resgata_info.php?Cod_resgate=<?php echo $row['Cod_resgate']?>"><?php echo $row['Cod_resgate']?></a>
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
                        $fkCod_Lugar = $row['fk_Brinde_Cod_produto'];
                        $sqlLugar = "SELECT Nome FROM Brinde WHERE Cod_produto = $fkCod_Lugar";
                        $resultLugar = $conn->query($sqlLugar);  
                        $LugarData = $resultLugar->fetch_assoc();
                        echo $LugarData['Nome'];
                    ?>
                </td>
                <td><?php echo $row['Quantidade']?></td>
                <td onclick="remove(<?php echo $row['Cod_resgate']?>);">
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
                location.href = 'resgata_del_php.php?Cod_resgate='+ID
            }
        }
    </script>
</body>
</html>