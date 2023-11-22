<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Uso</title>
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
                $sql = "SELECT u.Cod_uso, u.fk_Cliente_Cod_Cliente, u.fk_Cupom_Cod_cupom, u.DT_uso, c.Nome AS NomeCliente, p.Nome_cupom AS NomeCupom
                FROM usa u
                INNER JOIN cliente c ON u.fk_Cliente_Cod_Cliente = c.Cod_Cliente
                INNER JOIN cupom p ON u.fk_Cupom_Cod_cupom = p.Cod_cupom
                WHERE u.Cod_uso = '$busca'
                OR c.Nome LIKE '%$busca%'
                OR p.Nome_cupom LIKE '%$busca%'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_uso, fk_Cliente_Cod_Cliente, fk_Cupom_Cod_cupom, DT_uso FROM usa";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_uso, fk_Cliente_Cod_Cliente, fk_Cupom_Cod_cupom, DT_uso FROM usa";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
 
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="uso_add.php">+ Adicionar Uso</a>
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
                <th>Cupom</th>
                <th>Uso</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="uso_info.php?Cod_uso=<?php echo $row['Cod_uso']?>"><?php echo $row['Cod_uso']?></a>
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
                        $fkCod_Lugar = $row['fk_Cupom_Cod_cupom'];
                        $sqlLugar = "SELECT Nome_cupom FROM Cupom WHERE Cod_cupom = $fkCod_Lugar";
                        $resultLugar = $conn->query($sqlLugar);  
                        $LugarData = $resultLugar->fetch_assoc();
                        echo $LugarData['Nome_cupom'];
                    ?>
                </td>
                <td><?php echo date('d/m/Y', strtotime($row['DT_uso']))?></td>
                <td onclick="remove(<?php echo $row['Cod_uso']?>);">
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
                location.href = 'uso_del_php.php?Cod_uso='+ID
            }
        }
    </script>
</body>
</html>