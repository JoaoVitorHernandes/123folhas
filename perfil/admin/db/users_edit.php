<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuário</title>
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
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $sql = "SELECT Cod_Cliente, Nome, CPF, Email, Senha_login, Genero, CEP, DT_Nasc, Faixa_preco, Inter_Nacional, 123Pontos FROM cliente WHERE Cod_Cliente = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Nome = $row['Nome'];
                    $CPF = $row['CPF'];
                    $CEP = $row['CEP'];
                    $Genero = $row['Genero'];
                    $Data_Nasc = $row['DT_Nasc'];
                    $Email = $row['Email'];
                    $Senha = $row['Senha_login'];
                    $Faixa_Preco = $row['Faixa_preco'];
                    $Inter_Nacional = $row['Inter_Nacional'];
                    $Pontos = $row['123Pontos'];
                }
            }  
        }     
    ?>
    <h1>Edição de Usuário</h1>
    <form id="form1" name="form1" method="post" action="users_edit_php.php" onsubmit="return verificar()">
        <label for="">Codigo de Cliente Atual: <?php echo $id?><input type="hidden" name="hidId" value="<?php echo $id?>"></label> <br>
        
        <label for="txtNome"> Nome: <input type="text" id="txtNome" name="txtNome" value="<?php echo $Nome?>" maxlength="100" required> </label>

        <label for="txtCPF"> CPF: <input type="text" id="txtCPF" name="txtCPF" value="<?php echo $CPF?>" oninput="this.value = maskCPF(this.value)" title="Modelo: XXX.XXX.XXX-XX" maxlength="14" required> </label>

        <label for="txtCEP"> CEP: <input type="text" id="txtCEP" name="txtCEP" value="<?php echo $CEP?>"  oninput="this.value = maskCEP(this.value)" title="Modelo: XXXXX-XXX" maxlength="9" required> </label>

        <label for="selectGenero">Genero:
        <select name="selectGenero">
            <option value="M" <?php if ($Genero == 'M') echo 'selected'; ?>>Masculino</option>
            <option value="F" <?php if ($Genero == 'F') echo 'selected'; ?>>Feminino</option>
            <option value="O" <?php if ($Genero == 'O') echo 'selected'; ?>>Outro</option>
        </select></label>

        <label for="dateData_Nasc"> Data de Nascimento: <input type="date" id="dateData_Nasc" name="dateData_Nasc" value="<?php echo date('Y-m-d', strtotime($Data_Nasc))?>"  max="9999-12-31" required> </label>

        <label for="email"> Email: <input type="email" name="email" id="email" value="<?php echo $Email?>" maxlength="100" required> </label>

        <label for="txtSenha"> Senha: <input type="text" name="txtSenha" id="txtSenha" value="<?php echo $Senha?>" maxlength="20" required> </label>

        <label for="numberFaixa_Preco"> Faixa de Preço: <input type="number" id="numberFaixa_Preco" name="numberFaixa_Preco" value="<?php echo $Faixa_Preco?>" max="2147483647" required> </label>

        <label for="selectInter_Nacional"> Preferencia de Viagem: 
        <select name="selectInter_Nacional" id="selectInter_Nacional">
            <option value="N" <?php if ($Inter_Nacional == 'N') echo 'selected'; ?>>Nacional</option>
            <option value="I" <?php if ($Inter_Nacional == 'I') echo 'selected'; ?>>Internacional</option>
            <option value="A" <?php if ($Inter_Nacional == 'A') echo 'selected'; ?>>Ambos</option>
        </select></label>

        <label for="numberPontos"> Pontos Possuidos: <input type="number" id="selectInter_Nacional" name="numberPontos" value="<?php echo $Pontos?>" max="2147483647" required> </label>

        <input type="submit" value="Atualizar">
        <a href="../db/users_lst.php">Cancelar</a>
    </form>
    <script>
        const txtNome = document.getElementById('txtNome')
        const txtCPF = document.getElementById('txtCPF')
        const txtCEP = document.getElementById('txtCEP')
        const email = document.getElementById('email')       
        function verificar() {
            if (isNomeValido(txtNome.value)){
                if(isCPFValido(txtCPF.value) && validarCPF(txtCPF.value)){
                    if (isCEPValido(txtCEP.value)){
                        if (isEmailValido(email.value)){
                            return true
                        } else {
                            window.alert('Email inválido!')
                            return false
                        }
                    } else {
                        window.alert('CEP inválido!')
                        return false
                    }
                } else {
                    window.alert('CPF inválido!')
                    return false
                }
            } else {
                window.alert('Nome inválido!')
                return false
            }
        }
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '')
            let soma = 0
            let resto

            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i)
            }

            resto = 11 - (soma % 11);
            if (resto === 10 || resto === 11) {
                resto = 0
            }

            if (resto !== parseInt(cpf.charAt(9))) {
                return false
            }

            soma = 0
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i)
            }

            resto = 11 - (soma % 11);
            if (resto === 10 || resto === 11) {
                resto = 0
            }

            if (resto !== parseInt(cpf.charAt(10))) {
                return false
            }

            return true
        }
        
        function isNomeValido(nome) {
            const reN = /^\w*[a-zA-ZÀ-ú\s]+$/
            return reN.test(nome)
        }
        function isCPFValido(cpf) {
            const reC = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/
            return reC.test(cpf)
        }
        function isCEPValido(cep) {
            const reCE = /^\d{5}-\d{3}$/
            return reCE.test(cep)
        }
        function isEmailValido(email) {
            const reEM = /^\w.+@\w{3}.*\.\w{2,3}$/
            return reEM.test(email)
        }
        function maskCPF(cpf) {
            return cpf.trim().replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")
        }
        function maskCEP(cep) {
            return cep.trim().replace(/^(\d{5})(\d{3})$/, '$1-$2')
        }
    </script>
</body>
</html>