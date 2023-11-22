<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Editar perfil</title>
</head>

<body>
    <?php
    include('connection.php');
    session_start();

    if (!isset($_SESSION["Cod_Cliente"])) {
        header("Location: /123folhas/");
        exit();
    }

    $ERROR = '';

    $sqlN = "SELECT Nome, CEP, Email, Senha_login, Inter_Nacional, Faixa_preco FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
    $resultN = $conn->query($sqlN);
    $rowN = $resultN->fetch_assoc();
    $Nome = $rowN['Nome'];
    $CEP = $rowN['CEP'];
    $Email = $rowN['Email'];
    $Senha_login = $rowN['Senha_login'];
    $Faixa_preco = $rowN['Faixa_preco'];
    $Inter_Nacional = $rowN['Inter_Nacional'];

    if (isset($_GET['senha_excluir'])) {
        $sqlS = "SELECT Senha_login FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
        $resultS = $conn->query($sqlS);
        $rowS = $resultS->fetch_assoc();
        if ($rowS['Senha_login'] == $_GET['senha_excluir']) {
            if ($_SESSION['Cod_Cliente'] <= 13) {
                $ERROR = 'Não é possível deletar contas administadoras';
            } else {
                $sql = "DELETE FROM cliente WHERE Cod_Cliente = {$_SESSION['Cod_Cliente']}";
                $conn->query($sql);
                session_destroy();
                header("Location: /123folhas/");
                exit();
            }
        } else {
            $ERROR = 'Senha Incorreta';
        }
    }

    ?>
    <main>
        <section class="box">
            <span id="X"><a href="../">&times;</a></span>

            <div class="alinharelementos">
                <img src="../../img_principais/logo_login.png" alt="" id="logo">
            </div>

            <div class="alinharelementosescrita">
                <p id="elemento1">Editar perfil</p>
                <p id="elemento2">Edite seu nome, e-mail, senha, CEP e interesses</p>
            </div>

            <form id="form1" name="form1" method="post" action="edit_php.php" onsubmit="return verificar()">
                <div class="espacodentrobox">

                    <input type="text" name="txtNome" maxlength="100" id="primeiroinput" placeholder="Nome" class="campocheio" value="<?php echo $Nome ?>" required>

                    <input type="text" placeholder="CEP" id="CEP" name="txtCEP" oninput="this.value = maskCEP(this.value)" maxlength="9" class="campocheio" value="<?php echo $CEP ?>" required>

                    <input type="email" name="email" id="email" maxlength="100" placeholder="E-mail" class="campocheio" value="<?php echo $Email ?>" required>

                    <input type="password" name="txtSenha" id="senha" maxlength="20" placeholder="Senha" class="campocheio" value="<?php echo $Senha_login ?>" required>

                </div>

                <div class="conteudocaixarange">
                    <div>
                        <p id="textocaixarange">Tenho interesse em destinos:</p>
                    </div>

                    <div class="moverjustifydestinos">
                        <div class="justifydestinos">
                            <div><input type="radio" name="destinos" value="N" <?php echo ($Inter_Nacional === 'N') ? 'checked' : ''; ?>>Nacionais</div>
                            <div><input type="radio" name="destinos" value="I" <?php echo ($Inter_Nacional === 'I') ? 'checked' : ''; ?>>Internacionais</div>
                            <div><input type="radio" name="destinos" value="A" <?php echo ($Inter_Nacional === 'A') ? 'checked' : ''; ?>>Ambos</div>
                        </div>
                    </div>

                    <div class="faixapreco">
                        <p>Em qual faixa de preço diário?</p>
                    </div>

                    <div class="alinharelementorange">
                        <input type="range" id="valor" name="numberFaixa_Preco" min="0" max="10000" step="10" value="<?php echo $Faixa_preco ?>" oninput="mostrarValorIntervalo()">

                    </div>
                    <p id="valorOutput">R$ <?php echo $Faixa_preco ?></p>
                </div>

                <div id="botoes">
                    <input type="button" value="Excluir conta" id="excluirsubmit">

                    <input type="submit" value="Atualizar" id="enviarsubmit">
                </div>
                <span id="erro_senha"><?php echo $ERROR ?></span>

            </form>

            <p id="folhascopy"><a href="../../">&copy;123folhas</a></p>
        </section>



        <div id="popup" class="popup">
            <span class="close" id="closePopup">&times;</span>
            <div id="titulo_div">

                <div class="popup-content">
                    <span id="titulo">Excluir</span>

                    <form action="" id="form_senha" method="get">

                        <div style="display: flex; align-items: center;">
                            <input type="password" id="senha_excluir" name="senha_excluir" placeholder="Confirme com sua senha" required>
                        </div>

                        <input type="submit" value="Excluir" id="botao_excluir_popup">

                    </form>
                </div>
            </div>
        </div>

    </main>

    <script>
        const txtNome = document.getElementById('primeiroinput')
        const txtCEP = document.getElementById('CEP')
        const email = document.getElementById('email')

        function verificar() {
            if (isNomeValido(txtNome.value)) {
                if (isCEPValido(txtCEP.value)) {
                    if (isEmailValido(email.value)) {
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
                window.alert('Nome inválido!')
                return false
            }
        }


        function isNomeValido(nome) {
            const reN = /^\w*[a-zA-ZÀ-ú\s]+$/
            return reN.test(nome)
        }

        function isCEPValido(cep) {
            const reCE = /^\d{5}-\d{3}$/
            return reCE.test(cep)
        }

        function isEmailValido(email) {
            const reEM = /^\w.+@\w{3}.*\.\w{2,3}$/
            return reEM.test(email)
        }

        function maskCEP(cep) {
            return cep.trim().replace(/^(\d{5})(\d{3})$/, '$1-$2')
        }


        function mostrarValorIntervalo() {
            var valor = document.getElementById('valor').value;
            document.getElementById('valorOutput').textContent = 'R$ ' + valor;
        }

        document.getElementById("excluirsubmit").addEventListener("click", function() {
            document.getElementById("popup").style.display = "block";
        });

        document.getElementById("closePopup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });

        document.getElementById("botao_excluir_popup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });
    </script>

</body>

</html>