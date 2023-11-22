<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img_principais/icon_logo.png" type="image/x-icon">
    <title>Perfil</title>
</head>

<html>

<body>
    <?php
    include('../connection.php');
    session_start();
    $sqlN = "SELECT Nome FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
    $resultN = $conn->query($sqlN);
    $rowN = $resultN->fetch_assoc();
    $nomeCompleto = $rowN['Nome'];

    $sqlE = "SELECT Email FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
    $resultE = $conn->query($sqlE);
    $rowE = $resultE->fetch_assoc();
    $EmailCompleto = $rowE['Email'];

    if (!isset($_SESSION["Cod_Cliente"])) {
        header("Location: /123folhas/");
        exit();
    }

    $sqlI = "SELECT COUNT(*) AS Total_Interesses FROM se_interessa WHERE fk_Cliente_Cod_Cliente = {$_SESSION['Cod_Cliente']}";
    $resultI = $conn->query($sqlI);
    $rowI = $resultI->fetch_assoc();
    $InteresseCompleto = $rowI['Total_Interesses'];

    $sqlV = "SELECT COUNT(*) AS Total_Viaja FROM viaja WHERE fk_Cliente_Cod_Cliente = {$_SESSION['Cod_Cliente']}";
    $resultV = $conn->query($sqlV);
    $rowV = $resultV->fetch_assoc();
    $ViajaCompleto = $rowV['Total_Viaja'];
    ?>
    <div id="div_perfil">

        <span id="voltar_home" onclick="voltarPagina()"><a>&times;</a></span>

        <a title="Voltar à Home" href="../"><img src="../img_principais/logo_login.png" alt="Logo 123 Folhas" id="logo"></a>

        <div id="user_name">
            <img src="../img_principais/perfil_padrao.jpg" alt="foto de perfil" id="foto_perfil">

            <div id="nome_email">
                <p id="nome_completo"><?php echo $nomeCompleto ?></p>
                <p id="email_user"><?php echo $EmailCompleto ?></p>
                <?php if ($_SESSION['Cod_Cliente'] < 13) : ?>
                    <div id="botoes_editar_admin">
                        <a href="editar/" id="botao_editar">Editar</a>
                        <a href="admin/db0/inicio.php" id="botao_admin">Admin</a>
                    </div>
                <?php else : ?>
                    <div id="botoes_editar_admin">
                        <a href="editar/" id="botao_editar">Editar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="destinos_salvos">
            <span id="titulo_destinos">Destinos salvos</span>

            <a href="queroir/">
                <div class="quero_fui"><img src="../img_principais/icone_queroir.png" alt="icone quero ir">
                    <p>Quero ir</p><span><?php echo $InteresseCompleto ?> destinos</span>
                </div>
            </a>

            <a href="jafui/">
                <div class="quero_fui"><img src="../img_principais/icone_jafui.png" alt="icone já fui">
                    <p>Já fui</p><span><?php echo $ViajaCompleto ?> destinos</span>
                </div>
            </a>
        </div>

        <span id="botao_sair"><a href="../perfil/admin/db0/logout.php">Sair</a></span>

        <p id="text123"><a href="../">&copy;123folhas</a></p>
    </div>

    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>

</html>