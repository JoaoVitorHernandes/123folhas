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


    $Nome = $_POST['txtNome'];
    $Cidade = $_POST['txtCidade'];
    $Estado = $_POST['txtEstado'];
    $Pais = $_POST['txtPais'];
    $Continente = $_POST['txtContinente'];
    $Nivel_dificul = $_POST['selectNivel_dificul'];
    $Preco_aprox = $_POST['numberPreco_aprox'];
    $HTML_pagina = $_POST['txtHTML'];
    $Descricao = $_POST['txtDescricao'];


    try {
        $sql = "INSERT INTO destino (Nome_Lugar, Cidade, Estado, Pais, Continente, Desc_Destino, Nivel_dificul, Preco_aprox, HTML_pagina) VALUES ('$Nome', '$Cidade', '$Estado', '$Pais', '$Continente', '$Descricao', $Nivel_dificul, $Preco_aprox, '$HTML_pagina' )";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "destino_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>