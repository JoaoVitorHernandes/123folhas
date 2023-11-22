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


    $Titulo = $_POST['txtTitulo'];
    $Autor = $_POST['txtAutor'];
    $Data_Pub = $_POST['dateData_Pub'];
    $dateData_Pub = date('Y-m-d', strtotime($Data_Pub));;
    $HTML_pagina = $_POST['txtHTML'];


    try {
        $sql = "INSERT INTO Blog (Titulo, Autor, Data_publicada, HTML_blog ) VALUES ('$Titulo', '$Autor', '$dateData_Pub', '$HTML_pagina' )";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "blog_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>