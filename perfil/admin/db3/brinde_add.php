<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Brinde</title>
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
    <h1>Adição de Brinde</h1>
    <form id="form1" name="form1" method="post" action="brinde_add_php.php">
        <label for="txtNome">Nome: <input type="text" id="txtNome" name="txtNome" value="" maxlength="100" required></label>

        <label for="txtDesc">Descrição do Produto: <input type="text" id="txtDesc" name="txtDesc" value="" maxlength="255" required></label>

        <label for="numberPreco">Preço: <input type="number" id="numberPreco" name="numberPreco" value="0" max="50000" required></label>

        <input type="submit" value="Enviar">
        <a href="../db3/brinde_lst.php">Cancelar</a>
    </form>
</body>
</html>