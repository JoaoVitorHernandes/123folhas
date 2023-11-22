<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Resgata</title>
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
    <h1>Adição de Resgata</h1>
    <form id="form1" name="form1" method="post" action="resgata_add_php.php"  onsubmit="verificar()">
        <label for="txtCliente">Nome do Cliente: <input type="text" id="txtCliente" name="txtCliente" maxlength="100" value="" required></label>

        <label for="txtProduto">Nome do Produto: <input type="text" id="txtProduto" name="txtProduto" maxlength="100" value="" required></label>

        <label for="numberQuantidade">Quantidade: <input type="number" id="numberQuantidade" name="numberQuantidade" max="2147483647" value="" required></label>
        
        <input type="submit" value="Enviar">
        <a href="../db7/resgata_lst.php">Cancelar</a>
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