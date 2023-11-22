<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img_principais/icon_logo.png" type="image/x-icon">
    <title>Login</title>
</head>

<html>

<body>
    <?php
    include("connection.php");
    session_start();
    if (isset($_SESSION["Cod_Cliente"])) {
        header("Location: /123folhas/index.php");
        exit();
    }
    ?>
    <div id="div-login">

        <a id="voltar-home" onclick="voltarPagina()">&times;</a>

        <a title="Voltar à Home" href="../"><img src="../img_principais/logo_login.png" alt="Logo 123 Folhas" id="logo-login"></a>

        <h3 class="login-h3">Fazer login</h3>
        <h5 class="login-h5">Digite seu e-mail e senha</h5>

        <form name="form1" method="post" action="../perfil/admin/db0/login_php.php">
            <input type="email" class="input-login" placeholder="E-mail" name="txtLogin" maxlength="100" required>
            <input type="password" class="input-login" placeholder="Senha" name="txtPassword" maxlength="20" required>

            <div id="buttons">
                <a id="criar-button" href="../cadastro/index.php">Criar conta</a>
                <input type="submit" id="entrar-button" value="Entrar">
            </div>
        </form>

        <p id="text123"><a href="../">&copy;123folhas</a></p>
    </div>

    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>

</html>