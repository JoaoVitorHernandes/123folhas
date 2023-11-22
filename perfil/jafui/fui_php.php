<?php
    include("../../connection.php"); 
    session_start(); 

    $id = $_GET["hidId"];
    
    try {
        $sql = "DELETE FROM Viaja WHERE Cod_Viagem = $id";
        if ($conn->query($sql) === TRUE) {
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
?>