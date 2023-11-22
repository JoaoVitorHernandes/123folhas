<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Acessa</title>
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db6/acessa_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_acesso"])) {
            $id = $_GET["Cod_acesso"];

            $sql = "SELECT Cod_acesso, fk_Cliente_Cod_Cliente, fk_Blog_Cod_blog FROM acessa WHERE Cod_acesso = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Acessa: $id<br>";
                    echo "Chave Estrangeira Cliente: {$row['fk_Cliente_Cod_Cliente']}<br>";
                    $fkCod_Cliente = $row['fk_Cliente_Cod_Cliente'];
                    $sqlCliente = "SELECT Nome FROM Cliente WHERE Cod_Cliente = $fkCod_Cliente";
                    $resultCliente = $conn->query($sqlCliente);  
                    $clienteData = $resultCliente->fetch_assoc();
                    echo "Cliente: {$clienteData['Nome']}<br>";
                    echo "Chave Estrangeira Blog: {$row['fk_Blog_Cod_blog']}<br>";
                    $fkCod_Blog = $row['fk_Blog_Cod_blog'];
                    $sqlBlog = "SELECT Titulo FROM Blog WHERE Cod_blog = $fkCod_Blog";
                    $resultBlog = $conn->query($sqlBlog);  
                    $BlogData = $resultBlog->fetch_assoc();
                    echo "Titulo do Blog: {$BlogData['Titulo']}";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>