<?php
    include("../../connection.php"); 
    session_start(); 

    $id = $_GET["hidId"];
    
    try {
        $sql = "DELETE FROM se_interessa WHERE Cod_Inteteresse = $id";
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