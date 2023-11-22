<?php
    include("../connection.php");
    session_start();

    $Cliente = $_SESSION["Cod_Cliente"];
    $Produto = $_POST['hidID'];
    $Valor = $_POST['hidValue'];
    $Quantidade = $_POST['quantidade_brinde'];

    try {
        // Verifica a pontuação do cliente
        $pontosDisponiveis = 0;
        $queryPontos = "SELECT 123Pontos FROM cliente WHERE Cod_Cliente = $Cliente";
        $resultPontos = $conn->query($queryPontos);
        
        if ($resultPontos->num_rows > 0) {
            $row = $resultPontos->fetch_assoc();
            $pontosDisponiveis = $row["123Pontos"];
        }

        // Verifica se o cliente tem pontos suficientes
        if ($pontosDisponiveis >= $Valor) {
            // Desconta os pontos do cliente
            $novaPontuacao = $pontosDisponiveis - $Valor;
            $updatePontos = "UPDATE cliente SET 123Pontos = $novaPontuacao WHERE Cod_Cliente = $Cliente";
            if ($conn->query($updatePontos) === TRUE) {
                // Insere o resgate no banco de dados
                $sql = "INSERT INTO resgata (fk_Cliente_Cod_Cliente, fk_Brinde_Cod_produto, Quantidade) VALUES ($Cliente, $Produto, $Quantidade)";
                if ($conn->query($sql) === TRUE) {
                    header("Location: /123folhas/123recompensa/resgatado/index.php");
                    exit;
                } else {
                    throw new Exception('Ocorreu um erro ao executar a operação.');
                }
            } else {
                throw new Exception('Ocorreu um erro ao descontar os pontos do cliente.');
            }
        } else {
            throw new Exception('O cliente não tem pontos suficientes para resgatar este produto.');
        }
    } catch (Exception $e) {
        echo '<script>alert("' . $e->getMessage() . '"); history.go(-1);</script>';
        exit;
    }

?>