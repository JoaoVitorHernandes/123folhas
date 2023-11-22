<?php
    include("../db0/connection.php");

    $login = $_POST["txtLogin"];
    $password = $_POST["txtPassword"];

    $sql = "SELECT Cod_Cliente, Senha_login FROM Cliente WHERE Email = '$login'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["Senha_login"] == $password) {
                session_start();
                $_SESSION["Cod_Cliente"] = $row["Cod_Cliente"];
                header("Location: /123folhas/");
            } else {
?>
<script>
    alert("Senha incorreta");
    history.go(-1);
</script>
<?php
            }
        }
    }
    else {
?>
<script>
    alert("Login incorreto");
    history.go(-1);
</script>
<?php
    }
?>