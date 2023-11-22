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

    $Cliente = $_POST['txtCliente'];
    try {
        $sqlC = "SELECT Cod_Cliente FROM cliente WHERE Nome LIKE '%$Cliente%'";
        $resultC = $conn->query($sqlC);
        $rowC = $resultC->fetch_assoc();
        $_Cliente = $rowC['Cod_Cliente'];
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    $Blog = $_POST['txtBlog'];
    try {
        $sqlL = "SELECT Cod_blog FROM Blog WHERE Titulo LIKE '%$Blog%'";
        $resultL = $conn->query($sqlL);
        $rowL = $resultL->fetch_assoc();
        $_Blog = $rowL['Cod_blog'];
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }

    try {
        $sql = "INSERT INTO acessa (fk_Cliente_Cod_Cliente, fk_Blog_Cod_blog) VALUES ($_Cliente, $_Blog)";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "acessa_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>