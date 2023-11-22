<?php
    include("connection.php");
    session_start();

    $Nome = $_POST['txtNome'];
    $CEP = $_POST['txtCEP'];
    $Email = $_POST['email'];
    $Senha = $_POST['txtSenha'];
    $Faixa_Preco = $_POST['numberFaixa_Preco'];
    $Inter_Nacional = $_POST['destinos'];
    try {
        $sql = "UPDATE cliente SET Nome = '$Nome', CEP = '$CEP', Email = '$Email', Senha_login = '$Senha', Inter_Nacional = '$Inter_Nacional', Faixa_preco = $Faixa_Preco WHERE Cod_Cliente = {$_SESSION['Cod_Cliente']}";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Operação concluída com sucesso.");</script>';
            header("Location: /123folhas/");
            exit;
        } else {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        }
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
?>