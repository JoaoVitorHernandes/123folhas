<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="../style_lst.css">
</head>

<body>
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

    $sqlID = "SELECT Nome FROM Cliente WHERE Cod_cliente = {$_SESSION['Cod_Cliente']}";
        $resultID = $conn->query($sqlID);
        $rowID = $resultID->fetch_assoc();
        echo "<p>Nome Do Utilizador: " . $rowID['Nome'] . "</p>";
    if (isset($_GET['busca'])) {
        $busca = $_GET['busca'];
        if (!empty($busca)) {
            $sql = "SELECT Cod_Cliente, Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_preco, Inter_Nacional, 123Pontos 
                FROM cliente 
                WHERE Cod_Cliente = '$busca' 
                    OR CPF = '$busca' 
                    OR Nome LIKE '%$busca%' 
                    OR Email LIKE '%$busca%'";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        } else {
            $sql = "SELECT Cod_Cliente, Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_preco, Inter_Nacional, 123Pontos FROM cliente";
            $result = $conn->query($sql);
            echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
        }
    } else {
        $sql = "SELECT Cod_Cliente, Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_preco, Inter_Nacional, 123Pontos FROM cliente";
        $result = $conn->query($sql);
        echo "<p>Número de registros na tabela: " . $result->num_rows . "</p>";
    }
    ?>
    <div id="div_centralizar_elementos">
        <a id="ADD" href="users_add.php">+ Adicionar Usuário</a>
        <a id="Voltar" href="../db0/inicio.php">Voltar</a>
        <form method="get" action="" id="formulario">
            <input type="text" name="busca" id="busca" placeholder="Buscar">
            <input type="submit" value="Buscar" id="button_submit">
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Cod</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Gênero</th>
                <th>CEP</th>
                <th>Nascimento</th>
                <th>Pontos</th>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <a href="users_user.php?Cod_Cliente=<?php echo $row['Cod_Cliente'] ?>">
                            <?php echo $row['Cod_Cliente'] ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $row['Nome'] ?>
                    </td>
                    <td>
                        <?php echo $row['CPF'] ?>
                    </td>
                    <td>
                        <?php echo $row['Email'] ?>
                    </td>
                    <td>
                        <?php echo $row['Genero'] ?>
                    </td>
                    <td>
                        <?php echo $row['CEP'] ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($row['DT_Nasc'])) ?>
                    </td>
                    <td>
                        <?php echo $row['123Pontos'] ?>
                    </td>
                    <td>
                        <a id="Editar" href="users_edit.php?id=<?php echo $row['Cod_Cliente'] ?>"
                            style="display: inline;">Editar</a>
                    </td>
                    <td onclick="remove(<?php echo $row['Cod_Cliente'] ?>);">
                        <a id="Excluir" href="#" style="display: inline;">Excluir</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <script>
        function retornar() {
            window.location.href = '../db0/inicio.php'
        }
        function remove(ID) {
            if (confirm("Tem certeza que deseja excluir ese registro?")) {
                location.href = 'users_del_php.php?Cod_Cliente=' + ID
            }
        }
    </script>
</body>

</html>