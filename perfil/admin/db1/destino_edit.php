<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Destino</title>
    <link rel="stylesheet" href="../style_form.css">
    <link rel="shortcut icon" href="../../../img_principais/icon_logo.png" type="image/x-icon">
</head>
<body>
    <?php 
        session_start(); 
        if (!isset($_SESSION["Cod_Cliente"])) {
            header("Location: /123folhas/");
            exit();
        }

        if ($_SESSION["Cod_Cliente"] > 13) {
            header("Location: ../db0/erro.php");
            exit();
        }

    ?>
    <?php
        include("../db0/connection.php");
        if (isset($_GET["Cod_Lugar"])) {
            $id = $_GET["Cod_Lugar"];
            $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, HTML_pagina, Desc_Destino FROM destino WHERE Cod_Lugar = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Nome = $row['Nome_Lugar'];
                    $Cidade = $row['Cidade'];
                    $Estado = $row['Estado'];
                    $Pais = $row['Pais'];
                    $Continente = $row['Continente'];
                    $Nivel_dificul = $row['Nivel_dificul'];
                    $Preco_aprox = $row['Preco_aprox'];
                    $HTML_pagina = $row['HTML_pagina'];
                    $Descricao = $row['Desc_Destino'];
                }
            }  
        }     
    ?>
    <h1>Edição de Destino</h1>
    <form id="form1" name="form1" method="post" action="destino_edit_php.php" onsubmit="return verificar()">
        <label>Codigo de Destino Atual: <?php echo $id?><input type="hidden" name="hidId" value="<?php echo $id?>"></label> <br>

        <label for="txtNome"> Nome: <input type="text" id="txtNome" name="txtNome" value="<?php echo $Nome?>" maxlength="50" required></label>

        <label for="txtCidade"> Cidade: <input type="text" id="txtCidade" name="txtCidade" value="<?php echo $Cidade?>" maxlength="30" required> </label>

        <label for="txtEstado"> Estado: <input type="text" id="txtEstado" name="txtEstado" value="<?php echo $Estado?>" maxlength="30" required> </label>

        <label for="txtPais"> Pais: <input type="text" id="txtPais" name="txtPais" value="<?php echo $Pais?>" maxlength="30" required> </label>

        <label for="txtContinente"> Continente: <input type="text" id="txtContinente" name="txtContinente" value="<?php echo $Continente?>" maxlength="30" required></label>

        <label for="txtDescricao"> Descrição:
        <textarea id="txtDescricao" name="txtDescricao" rows="5" cols="30" style="resize: none;" oninput="limitarCaracteres()" required><?php echo $Descricao?></textarea></label>

        <label for="selectNivel_dificul"> Nivel de Dificulade:
        <select name="selectNivel_dificul">
            <option value="5" <?php if ($Nivel_dificul == '5') echo 'selected'; ?>>Nível 5</option>
            <option value="4" <?php if ($Nivel_dificul == '4') echo 'selected'; ?>>Nível 4</option>
            <option value="3" <?php if ($Nivel_dificul == '3') echo 'selected'; ?>>Nível 3</option>
            <option value="2" <?php if ($Nivel_dificul == '2') echo 'selected'; ?>>Nível 2</option>
            <option value="1" <?php if ($Nivel_dificul == '1') echo 'selected'; ?>>Nível 1</option>
        </select></label>

        <label for="numberPreco_aprox">Preço Aproximado: <input type="number" id="numberPreco_aprox" name="numberPreco_aprox" value="<?php echo $Preco_aprox?>" max="2147483647" required> </label>

        <label for="txtHTML">HTML da Pagina:
        <textarea id="txtHTML" name="txtHTML" rows="5" cols="30" style="resize: none;" required><?php echo $HTML_pagina?></textarea></label>
        
        <input type="submit" value="Atualizar">
        <a href="../db1/destino_lst.php">Cancelar</a>
    </form>
    <script>
        const txtNome = document.getElementById('txtNome')
        const txtCidade = document.getElementById('txtCidade')
        const txtEstado = document.getElementById('txtEstado')
        const txtContinente = document.getElementById('txtContinente')
        function verificar() {
            if (isNomeValido(txtNome.value)){
                if(isNomeValido(txtCidade.value)){
                    if (isNomeValido(txtEstado.value)){
                        if (isNomeValido(txtPais.value)){
                            if (isNomeValido(txtContinente.value)){
                                return true
                            } else {
                                window.alert('Continente inválido!')
                                return false
                            }
                        } else {
                            window.alert('País inválido!')
                            return false
                        }
                    } else {
                        window.alert('Estado inválido!')
                        return false
                    }
                } else {
                    window.alert('Cidade inválido!')
                    return false
                }
            } else {
                window.alert('Nome inválido!')
                return false
            }
        }
        
        function isNomeValido(nome) {
            const reN = /^\w*[a-zA-ZÀ-ú\s]+$/
            return reN.test(nome)
        }

        function limitarCaracteres() {
            const textarea = document.getElementById("txtDescricao");
            const limite = 255;
            if (textarea.value.length > limite) {
                textarea.value = textarea.value.substring(0, limite);
            }
        }
    </script>
</body>
</html>