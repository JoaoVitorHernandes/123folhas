<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" defer>
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Admin</title>
</head>
<?php
    include("../db0/connection.php");

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

<body>
    <div id="voltar_deslogar">
        <div><a href="../../">Voltar</a></div>
    </div>

    <section id="section_links">
    <div class="class_div">
            <span class="titulo">Clientes</span>
            <span>Delete e atualize clientes existentes ou crie novos clientes</span>
            <div class="botoes_acessar"><a href="../db/users_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Destinos</span>
            <span>Delete e atualize destinos existentes ou crie novos destinos</span>
            <div class="botoes_acessar"><a href="../db1/destino_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Blog</span>
            <span>Delete e atualize blogs existentes ou crie novos blogs</span>
            <div class="botoes_acessar"><a href="../db2/blog_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Brindes</span>
            <span>Delete e atualize brindes existentes ou crie novos brindes</span>
            <div class="botoes_acessar"><a href="../db3/brinde_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Cupons</span>
            <span>Delete e atualize cupons existentes ou crie novos cupons</span>
            <div class="botoes_acessar"><a href="../db8/cupom_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Interesses</span>
            <span>Acesso ao banco de dados relacional de cliente com viagem</span>
            <div class="botoes_acessar"><a href="../db4/interessa_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Viajados</span>
            <span>Acesso ao banco de dados relacional de cliente com viagem</span>
            <div class="botoes_acessar"><a href="../db5/viaja_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Acessos blog</span>
            <span>Acesso ao banco de dados relacional de cliente com blog</span>
            <div class="botoes_acessar"><a href="../db6/acessa_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Resgates de brindes</span>
            <span>Acesso ao banco de dados relacional de cliente com brindes</span>
            <div class="botoes_acessar"><a href="../db7/resgata_lst.php">Acessar</a></div>
        </div>

        <div class="class_div">
            <span class="titulo">Cupons usados</span>
            <span>Acesso ao banco de dados relacional de cliente com cupons</span>
            <div class="botoes_acessar"><a href="../db9/uso_lst.php">Acessar</a></div>
        </div>
    </section>


</body>

</html>