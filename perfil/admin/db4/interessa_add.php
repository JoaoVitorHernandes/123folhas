<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Interessa</title>
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
    <h1>Adição de Interessa</h1>
    <form id="form1" name="form1" method="post" action="interessa_add_php.php" onsubmit="verificar()">
        <label for="txtCliente">Nome do Cliente: <input type="text" id="txtCliente" name="txtCliente" maxlength="100" value="" required></label>

        <label for="txtLugar">Nome do Lugar: <input type="text" id="txtLugar" name="txtLugar" maxlength="50" value="" required></label>

        <label for="txtComentario">Comentario: <input type="text" id="txtComentario" name="txtComentario" maxlength="255" value=""></label>

        <input type="submit" value="Enviar">
        <a href="../db4/interessa_lst.php">Cancelar</a>
    </form>
    <script>
        const txtCliente = document.getElementById('txtCliente')
        const txtLugar = document.getElementById('txtLugar')
        function verificar() {
            if (isNomeValido(txtCliente.value)) {
                if (isNomeValido(txtLugar.value)){
                    return true
                } else {
                    window.alert("Nome do lugar inválido!")
                    return false
                }
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