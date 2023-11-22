<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img_principais/icon_logo.png" type="image/x-icon">
    <title>Cadastro</title>
</head>

<body>
    <main>
        <?php
        include("connection.php");
        session_start();
        if (isset($_SESSION["Cod_Cliente"])) {
            header("Location: /123folhas/index.php");
            exit();
        }
        ?>
        <section class="box">
            <span id="X" onclick="voltarPagina()">&times;</span>

                    <div class="alinharelementos">
                        <img src="../img_principais/logo_login.png" alt="" id="logo">
                    </div>

                    <div class="alinharelementosescrita">
                        <p id="elemento1">Fazer Cadastro</p>
                        <p id="elemento2">Digite seus dados e crie uma senha</p>
                    </div>

                    <form id="form1" name="form1" method="post" action="cadastro_php.php" onsubmit="return verificar()">
                        <div class="espacodentrobox">

                            <input type="text" name="txtNome" value="" maxlength="100" id="primeiroinput" placeholder="Nome" class="campocheio" required>

                            <input type="text" placeholder="CPF" id="cpf" name="txtCPF" value="" oninput="this.value = maskCPF(this.value)" maxlength="14" class="campomedio" required>
                            <select name="selectGenero" id="genero" class="campomedio" required>
                                <option value="genero" disabled selected>Gênero</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outro</option>
                            </select>

                            <input type="text" placeholder="Data de nascimento" id="nascimento" name="dateData_Nasc" oninput="this.value = maskData(this.value)" class="campomedio" required>
                            <input type="text" placeholder="CEP" id="CEP" name="txtCEP" value="" oninput="this.value = maskCEP(this.value)" maxlength="9" class="campomedio" required>

                            <input type="email" name="email" id="email" value="" placeholder="E-mail" maxlength="100" class="campocheio" required>

                            <input type="password" name="txtSenha" value="" id="senha" placeholder="Senha" class="campocheio" maxlength="20" required>

                        </div>

                        <div class="conteudocaixarange">
                            <div>
                                <p id="textocaixarange">Tenho interesse em destinos:</p>
                            </div>

                            <div class="moverjustifydestinos">
                                <div class="justifydestinos">
                                    <div><input type="radio" name="destinos" value="N">Nacionais</div>
                                    <div><input type="radio" name="destinos" value="I">Internacionais</div>
                                    <div><input type="radio" name="destinos" value="A" checked>Ambos</div>
                                </div>
                            </div>

                            <div class="faixapreco">
                                <p>Em qual faixa de preço diário?</p>
                            </div>

                            <div class="alinharelementorange">
                                <input type="range" id="valor" name="numberFaixa_Preco" min="0" max="10000" step="10" value="0" oninput="mostrarValorIntervalo()">

                            </div>
                            <p id="valorOutput">R$ 0</p>
                        </div>

                        <input type="submit" value="Criar conta" id="enviarsubmit">
                    </form>

                    <p id="folhascopy"><a href="../">&copy;123folhas</a></p>
        </section>
    </main>

    <script>
        function mostrarValorIntervalo() {
            var valor = document.getElementById('valor').value;
            document.getElementById('valorOutput').textContent = 'R$ ' + valor;
        }

        const txtNome = document.getElementById('primeiroinput')
        const txtCPF = document.getElementById('cpf')
        const txtCEP = document.getElementById('CEP')
        const email = document.getElementById('email')

        function verificar() {
            if (isNomeValido(txtNome.value)) {
                if (isCPFValido(txtCPF.value) && validarCPF(txtCPF.value)) {
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

        function maskData(data) {
            const digits = data.replace(/\D/g, '');
            const formatted = digits
                .replace(/^(\d{2})(\d)/, '$1/$2')
                .replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3')
                .substr(0, 10);

            const minDate = new Date('1900-01-01');
            const maxDate = new Date();

            const enteredDate = new Date(formatted.split('/').reverse().join('-'));

            if (enteredDate < minDate || enteredDate > maxDate) {
                return data; // Retorna a data original se estiver fora do intervalo
            }

            return formatted;
        }

        let today = new Date().toISOString().split('T')[0];
        document.getElementById('nascimento').setAttribute('max', today);

        function voltarPagina() {
            window.history.back();
        }
    </script>

</body>

</html>