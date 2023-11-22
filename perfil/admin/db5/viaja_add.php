<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Viaja</title>
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
    <h1>Adição de Viaja</h1>
    <form id="form1" name="form1" method="post" action="viaja_add_php.php">
        <label for="txtCliente">Cliente: <input type="text" id="txtCliente" maxlength="100" name="txtCliente" value="" required></label>

        <label for="txtLugar">Lugar: <input type="text" id="txtLugar" maxlength="50" name="txtLugar" value="" required></label>

        <label for="dateDT_Ida">Data de Ida: <input type="date" id="dateDT_Ida" name="dateDT_Ida" max="9999-12-31" value="" required></label>

        <label for="dateDT_Volta">Data de Volta: <input type="date" id="dateDT_Volta" name="dateDT_Volta" max="9999-12-31" value="" required></label>

        <label for="numberValor">Valor: <input type="number" id="numberValor" name="numberValor" max="2147483647" value="" required></label>
        
        <input type="submit" value="Enviar">
        <a href="../db5/viaja_lst.php">Cancelar</a>
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