<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Brinde</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db3/brinde_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_Produto"])) {
            $id = $_GET["Cod_Produto"];

            $sql = "SELECT Cod_Produto, Nome, Descricao, Preco FROM Brinde WHERE Cod_Produto = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Brinde: $id<br>";
                    echo "Nome: {$row['Nome']}<br>";
                    echo "Descrição: {$row['Descricao']}<br>";
                    echo "Preço: {$row['Preco']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>