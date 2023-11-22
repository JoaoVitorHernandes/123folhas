<?php
    include("../connection.php");
    
    $Nome = $_POST['txtNome'];
    $CPF = $_POST['txtCPF'];
    $CEP = $_POST['txtCEP'];
    $Genero = $_POST['selectGenero'];
    $Data_Nasc = $_POST['dateData_Nasc'];
    $dateData_Nasc = date('Y-m-d', strtotime($Data_Nasc));
    $Email = $_POST['email'];
    $Senha = $_POST['txtSenha'];
    $Faixa_Preco = $_POST['numberFaixa_Preco'];
    $Inter_Nacional = $_POST['destinos'];



    try {
        $checkQuery = "SELECT * FROM Cliente WHERE Email = '$Email' OR CPF = '$CPF'";
        $checkResult = $conn->query($checkQuery);
        if ($checkResult && $checkResult->num_rows > 0) {
            throw new Exception('Ocorreu um erro ao executar a operação.');
        } else {
            $sql = "INSERT INTO cliente (Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_Preco, Inter_Nacional) VALUES ('$Nome', '$CPF', '$Email', '$Senha', '$Genero', '$CEP', '$dateData_Nasc', '$Faixa_Preco', '$Inter_Nacional')";
            if ($conn->query($sql) === TRUE) {
                $sqlC = "SELECT Cod_Cliente FROM cliente WHERE CPF = '$CPF'";
                $resultC = $conn->query($sqlC);
                $row = $resultC->fetch_assoc();
                session_start();
                $_SESSION["Cod_Cliente"] = $row["Cod_Cliente"];
                header("Location: /123folhas/index.php");
                exit;
            } else {
                throw new Exception('Ocorreu um erro ao executar a operação.');
            }
        } 
    } catch (Exception $e) {
        echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        exit;
    }
    
?>