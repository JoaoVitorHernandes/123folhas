<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Destino</title>
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
            if (!empty($busca)) {
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, HTML_pagina, Desc_Destino 
                FROM destino 
                WHERE Cod_Lugar = '$busca' 
                    OR Nome_Lugar LIKE '%$busca%' 
                    OR Cidade LIKE '%$busca%' 
                    OR Estado LIKE '%$busca%' 
                    OR Pais LIKE '%$busca%' 
                    OR Continente LIKE '%$busca%'";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            } else {
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, HTML_pagina, Desc_Destino FROM destino";
                $result = $conn->query($sql);
                echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
            }
        } else {
            $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, HTML_pagina, Desc_Destino FROM destino";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    ?>
     <div id="div_centralizar_elementos">
        <a id="ADD" href="destino_add.php">+ Adicionar Destino</a>
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
                <th>Destino</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>País</th>
                <th>Continente</th>
                <th>Descrição</th>
                <th>Dificuldade</th>
                <th>Preço</th>
            </tr>
        </thead>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="destino_info.php?Cod_Lugar=<?php echo $row['Cod_Lugar']?>"><?php echo $row['Cod_Lugar']?></a>
                </td>
                <td><?php echo $row['Nome_Lugar']?></td>
                <td><?php echo $row['Cidade']?></td>
                <td><?php echo $row['Estado']?></td>
                <td><?php echo $row['Pais']?></td>
                <td><?php echo $row['Continente']?></td>
                <td><?php echo $row['Desc_Destino']?></td>
                <td><?php echo $row['Nivel_dificul']?></td>
                <td><?php echo $row['Preco_aprox']?></td>
                <td>
                    <a id="Editar" href="destino_edit.php?Cod_Lugar=<?php echo $row['Cod_Lugar']?>" style="display: inline;">Editar</a>
                </td>
                <td onclick="remove(<?php echo $row['Cod_Lugar']?>);">
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
                location.href = 'destino_del_php.php?Cod_Lugar='+ID
            }
        }
    </script>
</body>
</html>