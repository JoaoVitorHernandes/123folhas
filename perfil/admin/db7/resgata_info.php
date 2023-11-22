<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Resgata</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db7/resgata_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_resgate"])) {
            $id = $_GET["Cod_resgate"];

            $sql = "SELECT Cod_resgate, fk_Cliente_Cod_Cliente, fk_Brinde_Cod_produto, Quantidade FROM resgata WHERE Cod_resgate = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Resgata: $id<br>";
                    echo "Chave Estrangeira Cliente: {$row['fk_Cliente_Cod_Cliente']}<br>";
                    $fkCod_Cliente = $row['fk_Cliente_Cod_Cliente'];
                    $sqlCliente = "SELECT Nome FROM Cliente WHERE Cod_Cliente = $fkCod_Cliente";
                    $resultCliente = $conn->query($sqlCliente);  
                    $clienteData = $resultCliente->fetch_assoc();
                    echo "Cliente: {$clienteData['Nome']}<br>";
                    echo "Chave Estrangeira Brinde: {$row['fk_Brinde_Cod_produto']}<br>";
                    $fkCod_Brinde = $row['fk_Brinde_Cod_produto'];
                    $sqlBrinde = "SELECT Nome FROM Brinde WHERE Cod_produto = $fkCod_Brinde";
                    $resultBrinde = $conn->query($sqlBrinde);  
                    $LugarBrinde= $resultBrinde->fetch_assoc();
                    echo "Nome do Brine: {$LugarBrinde['Nome']}";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>