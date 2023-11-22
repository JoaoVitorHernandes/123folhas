<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Cupom</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db8/cupom_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_cupom"])) {
            $id = $_GET["Cod_cupom"];

            $sql = "SELECT Cod_cupom, Nome_cupom, Valor_cupom FROM Cupom WHERE Cod_cupom = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Cupom: $id<br>";
                    echo "Nome: {$row['Nome_cupom']}<br>";
                    echo "Valor: {$row['Valor_cupom']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>