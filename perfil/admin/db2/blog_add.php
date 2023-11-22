<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Blog</title>
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
    <h1>Adição de Blog</h1>
    <form id="form1" name="form1" method="post" action="blog_add_php.php">
        <label for="txtTitulo">Titulo: <input type="text" id="txtTitulo" name="txtTitulo" value="" maxlength="255" required></label>

        <label for="txtAutor">Autor: <input type="text" id="txtAutor" name="txtAutor" value="" maxlength="100" required></label>

        <label for="dateData_Pub">Data de Publicação: <input type="date" id="dateData_Pub" name="dateData_Pub" value="" max="9999-12-31" required></label>

        <label for="txtHTML">HTML da Pagina: 
        <textarea id="txtHTML" name="txtHTML" rows="5" cols="30" style="resize: none;" required></textarea></label>

        <input type="submit" value="Enviar">
        <a href="../db2/blog_lst.php">Cancelar</a>
    </form>
</body>
</html>