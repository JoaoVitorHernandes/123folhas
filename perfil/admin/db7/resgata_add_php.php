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
    $Produto = $_POST['txtProduto'];
    try {
        $sqlL = "SELECT Cod_produto FROM Brinde WHERE Nome LIKE '%$Produto%'";
        $resultL = $conn->query($sqlL);
        $rowL = $resultL->fetch_assoc();
        $_Produto = $rowL['Cod_produto'];
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
    $Quantidade = $_POST['numberQuantidade'];
    


    try {
        $sql = "INSERT INTO resgata (fk_Cliente_Cod_Cliente, fk_Brinde_Cod_produto, Quantidade) VALUES ($_Cliente, $_Produto, $Quantidade)";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso."); window.location.href = "resgata_lst.php";</script>';
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>