<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Viaja</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db5/viaja_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_Viagem"])) {
            $id = $_GET["Cod_Viagem"];

            $sql = "SELECT Cod_Viagem, fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, DT_Ida, DT_Volta, Valor FROM Viaja WHERE Cod_Viagem = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Viaja: $id<br>";
                    echo "Chave Estrangeira Cliente: {$row['fk_Cliente_Cod_Cliente']}<br>";
                    $fkCod_Cliente = $row['fk_Cliente_Cod_Cliente'];
                    $sqlCliente = "SELECT Nome FROM Cliente WHERE Cod_Cliente = $fkCod_Cliente";
                    $resultCliente = $conn->query($sqlCliente);  
                    $clienteData = $resultCliente->fetch_assoc();
                    echo "Cliente: {$clienteData['Nome']}<br>";
                    echo "Chave Estrangeira Lugar: {$row['fk_Destino_Cod_Lugar']}<br>";
                    $fkCod_Lugar = $row['fk_Destino_Cod_Lugar'];
                    $sqlLugar = "SELECT Nome_Lugar FROM Destino WHERE Cod_Lugar = $fkCod_Lugar";
                    $resultLugar = $conn->query($sqlLugar);  
                    $LugarData = $resultLugar->fetch_assoc();
                    echo "Lugar: {$LugarData['Nome_Lugar']}<br>";
                    echo "Data de Ida: {$row['DT_Ida']}<br>";
                    echo "Data de Volta: {$row['DT_Volta']}<br>";
                    echo "Valor: {$row['Valor']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>