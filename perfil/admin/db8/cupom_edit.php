<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        if (isset($_GET["Cod_cupom"])) {
            $id = $_GET["Cod_cupom"];
            $sql = "SELECT Cod_cupom, Nome_cupom, Valor_cupom FROM Cupom WHERE Cod_cupom = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Nome = $row['Nome_cupom'];
                    $Valor = $row['Valor_cupom'];
                }
            }  
        }     
    ?>
    <h1>Edição de Cupom</h1>

    <form id="form1" name="form1" method="post" action="cupom_edit_php.php">
        <label>Codigo do Brinde: <?php echo $id?><input type="hidden" name="hidId" value="<?php echo $id?>"> <br></label>

        <label for="txtNome"> Nome: <input type="text" id="txtNome" name="txtNome" value="<?php echo $Nome?>" maxlength="10" required> </label>

        <label for="numberValor"> Preço: <input type="number" id="numberValor" name="numberValor" value="<?php echo $Valor?>" max="2147483647" required> </label>
        
        <input type="submit" value="Atualizar">
        <a href="../db8/cupom_lst.php">Cancelar</a>
    </form>
</body>
</html>