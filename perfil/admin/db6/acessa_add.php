<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Acessa</title>
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
    <h1>Adição de Acessa</h1>
    <form id="form1" name="form1" method="post" action="acessa_add_php.php">
        <label for="txtCliente">Nome do Cliente: <input type="text" id="txtCliente" name="txtCliente" maxlength="100" value="" required></label>

        <label for="txtBlog">Titulo do Blog: <input type="text" id="txtBlog" name="txtBlog" maxlength="255" value="" required></label>
        
        <input type="submit" value="Enviar">
        <a href="../db6/acessa_lst.php">Cancelar</a>
    </form>
    <script>
        const txtCliente = document.getElementById('txtCliente')
        function verificar() {
            if (isNomeValido(txtCliente.value)) {
                return true
            } else {
                window.alert("Nome do cliente inválido!")
                return false
            }
        }

        function isNomeValido(nome) {
            const reN = /^\w*[a-zA-ZÀ-ú\s]+$/
            return reN.test(nome)
        }
    </script>
</body>
</html>