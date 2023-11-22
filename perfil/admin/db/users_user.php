<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Informações do Usuário</title>
</head>
<body>
    <a href="../db/users_lst.php">Voltar</a>
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
    
        if (isset($_GET["Cod_Cliente"])) {
            $id = $_GET["Cod_Cliente"];

            $sql = "SELECT Cod_Cliente, Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_preco, Inter_Nacional, 123Pontos FROM cliente WHERE Cod_Cliente = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Codigo do Cliente: $id<br>";
                    echo "Nome: {$row['Nome']}<br>";
                    echo "CPF: {$row['CPF']}<br>";
                    echo "CEP: {$row['CEP']}<br>";
                    echo "Genero: {$row['Genero']}<br>";
                    echo "Data de Nascimento: {$row['DT_Nasc']}<br>";
                    echo "Email: {$row['Email']}<br>";
                    echo "Senha_login: {$row['Senha_login']}<br>";
                    echo "Faixa de Preço: {$row['Faixa_preco']}<br>";
                    echo "Preferencia de Viagem: {$row['Inter_Nacional']}<br>";
                    echo "Pontos Possuidos: {$row['123Pontos']}<br>";
                }
            }  
        }     
    ?>
    </table>
</body>
</html>