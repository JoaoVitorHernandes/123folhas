<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Viaja</title>
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
                $sql = "SELECT v.Cod_Viagem, v.fk_Cliente_Cod_Cliente, v.fk_Destino_Cod_Lugar, v.DT_Ida, v.DT_Volta, v.Valor
                FROM viaja v
                INNER JOIN cliente c ON v.fk_Cliente_Cod_Cliente = c.Cod_Cliente
                INNER JOIN destino d ON v.fk_Destino_Cod_Lugar = d.Cod_Lugar
                WHERE v.Cod_Viagem = '$busca' OR c.Nome LIKE '%$busca%' OR d.Nome_lugar LIKE '%$busca%'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_Viagem, fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, DT_Ida, DT_Volta, Valor FROM viaja";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_Viagem, fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, DT_Ida, DT_Volta, Valor FROM viaja";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="viaja_add.php">+ Adicionar Viaja</a>
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
                <th>Destino</th>
                <th>Ida</th>
                <th>Volta</th>
                <th>Preço</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="viaja_info.php?Cod_Viagem=<?php echo $row['Cod_Viagem']?>"><?php echo $row['Cod_Viagem']?></a>
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
                        $fkCod_Lugar = $row['fk_Destino_Cod_Lugar'];
                        $sqlLugar = "SELECT Nome_Lugar FROM Destino WHERE Cod_Lugar = $fkCod_Lugar";
                        $resultLugar = $conn->query($sqlLugar);  
                        $LugarData = $resultLugar->fetch_assoc();
                        echo $LugarData['Nome_Lugar'];
                    ?>
                </td>
                <td><?php echo date('d/m/Y', strtotime($row['DT_Ida']))?></td>
                <td><?php echo date('d/m/Y', strtotime($row['DT_Volta']))?></td>
                <td><?php echo $row['Valor']?></td>
                <td onclick="remove(<?php echo $row['Cod_Viagem']?>);">
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
                location.href = 'viaja_del_php.php?Cod_Viagem='+ID
            }
        }
    </script>
</body>
</html>