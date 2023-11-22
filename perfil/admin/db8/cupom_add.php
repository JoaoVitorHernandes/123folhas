<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cupom</title>
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
    <h1>Adição de Cupom</h1>
    <form id="form1" name="form1" method="post" action="cupom_add_php.php">
        <label for="txtNome">Nome: <input type="text" id="txtNome" name="txtNome" value="" maxlength="10" required></label>

        <label for="numberValor">Valor: <input type="number" id="numberValor" name="numberValor" value="" max="2147483647" required></label>

        <input type="submit" value="Enviar">
        <a href="../db8/cupom_lst.php">Cancelar</a>
    </form>
</body>
</html>