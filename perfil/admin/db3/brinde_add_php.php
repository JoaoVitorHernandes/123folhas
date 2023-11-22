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
    $Descricao = $_POST['txtDesc'];
    $Preco = $_POST['numberPreco'];


    try {
        $sql = "INSERT INTO Brinde (Nome, Descricao, Preco) VALUES ('$Nome', '$Descricao', $Preco)";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "brinde_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>