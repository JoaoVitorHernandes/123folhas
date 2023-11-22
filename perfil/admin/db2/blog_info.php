<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Blog</title>
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <style>
        body {
            font-family: verdana;
        }
    </style>   
</head>
<body>
    <a href="../db2/blog_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_Blog"])) {
            $id = $_GET["Cod_Blog"];

            $sql = "SELECT Cod_Blog, Titulo, Autor, Data_publicada, Gostei, Deslike, HTML_blog FROM Blog WHERE Cod_blog = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Blog: $id<br>";
                    echo "Titulo: {$row['Titulo']}<br>";
                    echo "Autor: {$row['Autor']}<br>";
                    echo "Data de Publicação: {$row['Data_publicada']}<br>";
                    echo "Número de Likes: {$row['Gostei']}<br>";
                    echo "Número de Dislikes: {$row['Deslike']}<br>";
                    echo "HTML da Pagina: {$row['HTML_blog']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>