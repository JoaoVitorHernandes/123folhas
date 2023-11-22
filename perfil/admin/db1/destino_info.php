<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Destino</title>
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db1/destino_lst.php">Voltar</a>
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

    
        if (isset($_GET["Cod_Lugar"])) {
            $id = $_GET["Cod_Lugar"];

            $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, HTML_pagina, Desc_Destino FROM destino WHERE Cod_Lugar = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Lugar: $id<br>";
                    echo "Nome: {$row['Nome_Lugar']}<br>";
                    echo "Cidade: {$row['Cidade']}<br>";
                    echo "Estado: {$row['Estado']}<br>";
                    echo "Pais: {$row['Pais']}<br>";
                    echo "Pais: {$row['Continente']}<br>";
                    echo "Descrição: {$row['Desc_Destino']}<br>";
                    echo "Nivel de Dificuldade: {$row['Nivel_dificul']}<br>";
                    echo "Preço Aproximado: {$row['Preco_aprox']}<br>";
                    echo "HTML da Pagina: {$row['HTML_pagina']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>