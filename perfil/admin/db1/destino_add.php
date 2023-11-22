<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Destino</title>
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
    <h1>Adição de Destino</h1>
    <form id="form1" name="form1" method="post" action="destino_add_php.php" onsubmit="return verificar()">
        <label for="txtNome">Nome: <input type="text" id="txtNome" name="txtNome" value="" maxlength="50" required></label>

        <label for="txtCidade">Cidade: <input type="text" id="txtCidade" name="txtCidade" value="" maxlength="30" required></label>

        <label for="txtEstado">Estado: <input type="text" id="txtEstado" name="txtEstado" value="" maxlength="30" required></label>

        <label for="txtPais">Pais: <input type="text" id="txtPais" name="txtPais" value="" maxlength="30" required></label>

        <label for="">Continente: <input type="text" id="txtContinente" name="txtContinente" value="" maxlength="30" required></label>

        <label for="txtDescricao">Descrição: <textarea id="txtDescricao" name="txtDescricao" rows="5" cols="30" style="resize: none;" oninput="limitarCaracteres()" required></textarea></label>

        <label for="selectNivel_dificul">Nivel de Dificulade: 
        <select name="selectNivel_dificul">
            <option value="5">Nível 5</option>
            <option value="4">Nível 4</option>
            <option value="3">Nível 3</option>
            <option value="2">Nível 2</option>
            <option value="1">Nível 1</option>
        </select></label>
        
        <label for="numberPreco_aprox">Preço Aproximado:     
        <input type="number" id="numberPreco_aprox" name="numberPreco_aprox" value="0" min="0" max="2147483647"></label>

        <label for="txtHTML">HTML da Pagina:<textarea id="txtHTML" name="txtHTML" rows="5" cols="30" style="resize: none;" required></textarea></label>

        <input type="submit" value="Enviar">
        <a href="../db1/destino_lst.php">Cancelar</a>
    </form>
    <script>
        const txtNome = document.getElementById('txtNome')
        const txtCidade = document.getElementById('txtCidade')
        const txtEstado = document.getElementById('txtEstado')
        const txtPais = document.getElementById('txtPais')
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