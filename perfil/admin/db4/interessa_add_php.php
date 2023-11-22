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
    $Lugar = $_POST['txtLugar'];
    try {
        $sqlL = "SELECT Cod_Lugar FROM Destino WHERE Nome_Lugar LIKE '%$Lugar%'";
        $resultL = $conn->query($sqlL);
        $rowL = $resultL->fetch_assoc();
        $_Lugar = $rowL['Cod_Lugar'];
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    $Comentario = $_POST['txtComentario'];


    try {
        $sql = "INSERT INTO se_interessa (fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, Comentario) VALUES ($_Cliente, $_Lugar, '$Comentario')";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "interessa_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>