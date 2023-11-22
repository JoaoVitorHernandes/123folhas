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
    $DT_Ida = $_POST['dateDT_Ida'];
    $DT_Volta = $_POST['dateDT_Volta'];
    $Valor = $_POST['numberValor'];
    $dateDT_Ida = date('Y-m-d', strtotime($DT_Ida));
    $dateDT_Volta = date('Y-m-d', strtotime($DT_Volta));


    try {
        $sql = "INSERT INTO viaja (fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, DT_Ida, DT_Volta, Valor) VALUES ($_Cliente, $_Lugar, '$dateDT_Ida', '$dateDT_Volta', $Valor)";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "viaja_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>