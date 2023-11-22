<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Uso</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db9/uso_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_uso"])) {
            $id = $_GET["Cod_uso"];

            $sql = "SELECT Cod_uso, fk_Cliente_Cod_Cliente, fk_Cupom_Cod_cupom, DT_uso FROM usa WHERE Cod_uso = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Uso: $id<br>";
                    echo "Chave Estrangeira Cliente: {$row['fk_Cliente_Cod_Cliente']}<br>";
                    $fkCod_Cliente = $row['fk_Cliente_Cod_Cliente'];
                    $sqlCliente = "SELECT Nome FROM Cliente WHERE Cod_Cliente = $fkCod_Cliente";
                    $resultCliente = $conn->query($sqlCliente);  
                    $clienteData = $resultCliente->fetch_assoc();
                    echo "Cliente: {$clienteData['Nome']}<br>";
                    echo "Chave Estrangeira Cupom: {$row['fk_Cupom_Cod_cupom']}<br>";
                    $fkCod_Brinde = $row['fk_Cupom_Cod_cupom'];
                    $sqlBrinde = "SELECT Nome_cupom FROM Cupom WHERE Cod_cupom = $fkCod_Brinde";
                    $resultBrinde = $conn->query($sqlBrinde);  
                    $LugarBrinde= $resultBrinde->fetch_assoc();
                    echo "Nome do cupom: {$LugarBrinde['Nome_cupom']} <br>";
                    echo "Data de uso: {$row['DT_uso']}";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>