<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Interessa</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db4/interessa_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_Inteteresse"])) {
            $id = $_GET["Cod_Inteteresse"];

            $sql = "SELECT Cod_Inteteresse, fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, Comentario, DT_Adicao FROM se_interessa WHERE Cod_Inteteresse = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Interessa: $id<br>";
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
                    echo "Comentario: {$row['Comentario']}<br>";
                    echo "Data de Adição: {$row['DT_Adicao']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>