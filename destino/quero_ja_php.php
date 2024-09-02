<?php 
    include("../connection.php"); 
    session_start();
    if (!isset($_SESSION["Cod_Cliente"])) {
        header("Location: /123folhas/login/index.php");
        exit();
    }

    $Select = $_POST['selectQueroJa'];
    $ID = $_POST['hidId'];

    if ($Select == 'queroir') {
        $Comentario = $_POST['comentario_queroir'];
        try {
            // Verificar se já existe um registro com os mesmos valores
            $checkQuery = "SELECT * FROM se_interessa WHERE fk_Cliente_Cod_Cliente = {$_SESSION['Cod_Cliente']} AND fk_Destino_Cod_Lugar = $ID";
            $checkResult = $conn->query($checkQuery);
    
            if ($checkResult && $checkResult->num_rows > 0) {
                // Já existe um registro com os mesmos valores, mostrar uma mensagem ou tomar alguma ação
                header("Location: /123folhas/perfil/queroir/index.php");
            } else {
                // Não existe registro, realizar a inserção
                $sql = "INSERT INTO se_interessa (fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, Comentario) VALUES ({$_SESSION['Cod_Cliente']}, $ID, '$Comentario')";
                if ($conn->query($sql) === TRUE) {
                    header("Location: /123folhas/perfil/queroir/index.php");
                    exit;
                } else {
                    throw new Exception('Ocorreu um erro ao executar a operação.');
                }
            }
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
            exit;
        }
    } else {
        $DT_Ida = $_POST['dataIda'];
        $_DT_Ida = date('Y-m-d', strtotime($DT_Ida));
        $DT_Volta = $_POST['dataVolta'];
        $_DT_Volta = date('Y-m-d', strtotime($DT_Volta));
        $Valor = $_POST['valor'];
        try {
            // Verificar se já existe um registro com os mesmos valores
            $checkQuery = "SELECT * FROM viaja WHERE fk_Cliente_Cod_Cliente = {$_SESSION['Cod_Cliente']} AND fk_Destino_Cod_Lugar = $ID";
            $checkResult = $conn->query($checkQuery);
    
            if ($checkResult && $checkResult->num_rows > 0) {
                // Já existe um registro com os mesmos valores, mostrar uma mensagem ou tomar alguma ação
                header("Location: /123folhas/perfil/jafui/index.php");
            } else {
                // Não existe registro, realizar a inserção
                $sql = "INSERT INTO viaja (fk_Cliente_Cod_Cliente, fk_Destino_Cod_Lugar, DT_Ida, DT_Volta, Valor) VALUES ({$_SESSION['Cod_Cliente']}, $ID, '$_DT_Ida', '$_DT_Volta', $Valor)";
                if ($conn->query($sql) === TRUE) {
                    header("Location: /123folhas/perfil/jafui/index.php");
                    exit;
                } else {
                    throw new Exception('Ocorreu um erro ao executar a operação.');
                }
            }
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'"); history.go(-1);</script>';
        }
    }
?>