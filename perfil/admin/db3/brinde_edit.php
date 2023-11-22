<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Brinde</title>
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
        if (isset($_GET["Cod_Produto"])) {
            $id = $_GET["Cod_Produto"];
            $sql = "SELECT Cod_Produto, Nome, Descricao, Preco FROM Brinde WHERE Cod_Produto = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Nome = $row['Nome'];
                    $Descricao = $row['Descricao'];
                    $Preco = $row['Preco'];
                }
            }  
        }     
    ?>
    <h1>Edição de Brinde</h1>

    <form id="form1" name="form1" method="post" action="brinde_edit_php.php">
        <label>Codigo do Brinde: <?php echo $id?><input type="hidden" name="hidId" value="<?php echo $id?>"> <br></label>

        <label for="txtNome"> Nome: <input type="text" id="txtNome" name="txtNome" value="<?php echo $Nome?>" maxlength="100" required> </label>

        <label for="txtDesc"> Descrição do Produto: <input type="text" id="txtDesc" name="txtDesc" value="<?php echo $Descricao?>" maxlength="255" required> </label>

        <label for="numberPreco"> Preço: <input type="number" id="numberPreco" name="numberPreco" value="<?php echo $Preco?>" max="2147483647" required></label>
        
        <input type="submit" value="Atualizar">
        <a href="../db3/brinde_lst.php">Cancelar</a>
    </form>
</body>
</html>