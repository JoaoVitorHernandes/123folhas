<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Blog</title>
    <link rel="stylesheet" href="../style_form.css">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
</head>
<body>
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

    ?>
    <?php
        include("../db0/connection.php");
        if (isset($_GET["Cod_blog"])) {
            $id = $_GET["Cod_blog"];
            $sql = "SELECT Cod_Blog, Titulo, Autor, Data_publicada, HTML_blog FROM Blog WHERE Cod_blog = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Titulo = $row['Titulo'];
                    $Autor = $row['Autor'];
                    $Data_pub = $row['Data_publicada'];
                    $HTML_pagina = $row['HTML_blog'];
                }
            }  
        }     
    ?>
    <h1>Edição de Blog</h1>

    <form id="form1" name="form1" method="post" action="blog_edit_php.php">
        <label>Codigo de Blog: <?php echo $id?><input type="hidden" name="hidId" value="<?php echo $id?>"> </label><br>

        <label for="txtTitulo"> Titulo: <input type="text" id="txtTitulo" name="txtTitulo" value="<?php echo $Titulo?>" maxlength="255" required> </label>

        <label for="txtAutor"> Autor: <input type="text" id="txtAutor" name="txtAutor" value="<?php echo $Autor?>" maxlength="100" required> </label>

        <label for="dateData_Pub"> Data de Publicação: <input type="date" id="dateData_Pub" name="dateData_Pub" max="9999-12-31" value="<?php echo date('Y-m-d', strtotime($Data_pub))?>"> </label>

        <label for="txtHTML"> HTML da Pagina:
        <textarea id="txtHTML" name="txtHTML" rows="5" cols="30" style="resize: none;" required><?php echo $HTML_pagina?></textarea></label>
        
        <input type="submit" value="Atualizar">
        <a href="../db2/blog_lst.php">Cancelar</a>
    </form>
</body>
</html>