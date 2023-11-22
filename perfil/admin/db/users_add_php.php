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
    $CPF = $_POST['txtCPF'];
    $CEP = $_POST['txtCEP'];
    $Genero = $_POST['selectGenero'];
    $Data_Nasc = $_POST['dateData_Nasc'];
    $dateData_Nasc = date('Y-m-d', strtotime($Data_Nasc));
    $Email = $_POST['email'];
    $Senha = $_POST['txtSenha'];
    $Faixa_Preco = $_POST['numberFaixa_Preco'];
    $Inter_Nacional = $_POST['selectInter_Nacional'];
    $Pontos = $_POST['numberPontos'];

    try {
        $sql = "INSERT INTO cliente (Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_Preco, Inter_Nacional, 123Pontos) VALUES ('$Nome', '$CPF', '$Email', '$Senha', '$Genero', '$CEP', '$dateData_Nasc', '$Faixa_Preco', '$Inter_Nacional', '$Pontos')";
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