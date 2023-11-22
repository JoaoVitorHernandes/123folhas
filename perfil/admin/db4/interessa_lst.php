<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Se Interessa</title>
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
                $sql = "SELECT s.Cod_Inteteresse, s.fk_Cliente_Cod_Cliente, s.fk_Destino_Cod_Lugar, s.Comentario, s.DT_Adicao 
                FROM se_interessa s
                INNER JOIN cliente c ON s.fk_Cliente_Cod_Cliente = c.Cod_Cliente
                INNER JOIN destino d ON s.fk_Destino_Cod_Lugar = d.Cod_Lugar
                WHERE s.Cod_Inteteresse = '$busca' OR c.Nome LIKE '%$busca%' OR d.Nome_lugar LIKE '%$busca%'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_Inteteresse, fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, Comentario, DT_Adicao FROM se_interessa";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_Inteteresse, fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, Comentario, DT_Adicao FROM se_interessa";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="interessa_add.php">+ Adicionar Interesse</a>
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
                <th>Comentário</th>
                <th>Adição</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="interessa_info.php?Cod_Inteteresse=<?php echo $row['Cod_Inteteresse']?>"><?php echo $row['Cod_Inteteresse']?></a>
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
                <td><?php echo $row['Comentario']?></td>
                <td><?php echo date('d/m/Y', strtotime($row['DT_Adicao']))?></td>
                <td onclick="remove(<?php echo $row['Cod_Inteteresse']?>);">
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
                location.href = 'interessa_del_php.php?Cod_Inteteresse='+ID
            }
        }
    </script>
</body>
</html>