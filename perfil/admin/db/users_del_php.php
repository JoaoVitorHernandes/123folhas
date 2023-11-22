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

    $id = $_GET["Cod_Cliente"];
    
    if ($id <= 13) {
        echo '<script>alert("Não é possível deletar contas Administradoras!"); window.location.href = "users_lst.php";</script>';
        exit;
    }
    
    try {
        $sql = "DELETE FROM cliente WHERE Cod_Cliente = $id";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "users_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
?>