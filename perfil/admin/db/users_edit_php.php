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

    $id = $_POST["hidId"];
    $Nome = $_POST['txtNome'];
    $CPF = $_POST['txtCPF'];
    $CEP = $_POST['txtCEP'];
    $Genero = $_POST['selectGenero'];
    $Data_Nasc = $_POST['dateData_Nasc'];
    $Email = $_POST['email'];
    $Senha = $_POST['txtSenha'];
    $Faixa_Preco = $_POST['numberFaixa_Preco'];
    $Inter_Nacional = $_POST['selectInter_Nacional'];
    $Pontos = $_POST['numberPontos'];
    try {
        $sql = "UPDATE cliente SET Nome = '$Nome', CPF = '$CPF', CEP = '$CEP', Genero = '$Genero', Email = '$Email', Senha_login = '$Senha', Inter_Nacional = '$Inter_Nacional', 123Pontos = $Pontos, Faixa_preco = $Faixa_Preco, DT_Nasc = '$Data_Nasc' WHERE Cod_Cliente = $id";
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