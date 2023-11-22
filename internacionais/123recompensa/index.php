<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img_principais/icon_logo.png" type="image/x-icon">
    <title>123recompensa</title>
</head>

<body>
    <?php 
        include("../connection.php"); 
        session_start();    
        
        $Código = 'Código';

        if (isset($_GET['cupom'])) {
            $cupom = $_GET['cupom'];
            
            // Use prepared statements ou sanitize os dados do usuário para prevenir injeção SQL
            $cupom = $conn->real_escape_string($cupom);

            $sqlL = "SELECT Cod_cupom, Valor_cupom FROM Cupom WHERE TRIM(Nome_cupom) = '$cupom'";

            $resultL = $conn->query($sqlL);
        
            if ($resultL) {
                if ($resultL->num_rows > 0) {
                    $rowL = $resultL->fetch_assoc();
                    $_Cupom = $rowL['Cod_cupom'];
                    $_Valor = $rowL['Valor_cupom'];

                    $checkQuery = "SELECT * FROM usa WHERE fk_Cliente_Cod_Cliente = {$_SESSION['Cod_Cliente']} AND fk_Cupom_Cod_cupom = $_Cupom";
                    $checkResult = $conn->query($checkQuery);
                    if ($checkResult && $checkResult->num_rows > 0){
                        $Código = 'Cupom já utilizado!';
                    } else {
                        $sqlPontos = "SELECT 123Pontos FROM Cliente WHERE Cod_cliente = {$_SESSION['Cod_Cliente']}";
                        $resultPontos = $conn->query($sqlPontos);
            
                        if ($resultPontos && $resultPontos->num_rows > 0) {
                            $rowPontos = $resultPontos->fetch_assoc();
                            $pontosAtuais = $rowPontos['123Pontos'];
            
                            // Calcula os novos pontos
                            $novosPontos = $pontosAtuais + $_Valor;
            
                            // Atualiza os pontos do cliente
                            $sqlU = "UPDATE Cliente SET 123Pontos = $novosPontos WHERE Cod_cliente = {$_SESSION['Cod_Cliente']}";
                            $conn->query($sqlU);
            
                            $sqlM = "INSERT INTO usa (fk_Cliente_Cod_Cliente, fk_Cupom_Cod_cupom) VALUES ({$_SESSION['Cod_Cliente']}, $_Cupom)";
                            $conn->query($sqlM);
                            $Código = 'Cupom Resgatado!';   
                        } else {
                            $Código = 'Erro ao buscar Pontos do Cliente!';   
                        }
                    }

                } else {
                    $Código = 'Cupom não encontrado';            
                }
            } else {
                $Código = 'Erro ao buscar o Cupom!';    
            }
        }
        
    ?>
    <header class="navegar">
        <nav class="barranav">
            <div class="logodentro">
                <a href="../"><img src="../img_principais/logo_semfundo.png" alt="logo 123 folhas" class="logo"></a>
            </div>
            <div class="emcoluna">
                <div id="divbusca"><span>Buscar</span><img src="../img_principais/lupa.png" alt="Buscar" id="lupa_busca"></div>

                <div class="alinharletra">
                    <a href="../nacionais/" class="letra">NACIONAIS</a>
                    <a href="../internacionais/" class="letra">INTERNACIONAIS</a>
                    <a href="../blog/" class="letra">BLOG</a>
                    <a href="../123recompensa/" class="letra">123RECOMPENSA</a>
                </div>
            </div>

            <div class="spaceperfil">
                <?php if (!isset($_SESSION['Cod_Cliente'])): ?>
                    <a href="../login/">
                        <figure>
                            <img src="../img_principais/perfil_padrao.jpg" alt="logo 123 folhas" class="perfil">
                            <figcaption>Login</figcaption>
                        </figure>
                    </a>
                <?php else: ?>
                    <?php 
                        $sqlP = "SELECT Nome, 123Pontos FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
                        $resultP = $conn->query($sqlP);
                        $rowP = $resultP->fetch_assoc();
                        $nomeCompleto = $rowP['Nome'];
                        $Pontos = $rowP['123Pontos'];
                        $partesNome = explode(' ', $nomeCompleto);
                        $_clienteLogado = $partesNome[0];
                    ?>
                    <a href="../perfil/">
                        <figure>
                            <img src="../img_principais/perfil_padrao.jpg" alt="Foto do Usuário" class="perfil">
                            <figcaption><?php echo $_clienteLogado ?></figcaption>
                        </figure>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <section id="section_conteudo">
                <div id="resgate_topo">
                    <div id="div_resgate">
                        <p id="tit">123recompensa</p>
                        <?php if (isset($_SESSION['Cod_Cliente'])):?>
                            <p id="sub_tit">Resgate seu cupom promocional</p>

                            <form action="" method="get">
                                <input type="text" name="cupom" placeholder="<?php echo $Código ?>" maxlength="10">
                                <input type="submit" value="Resgatar">
                            </form>
                        </div>
                    
                        <div id="div_perfil_resgata" onclick="">
                            <img src="../img_principais/perfil_padrao.jpg">
                            <div><span><?php echo $nomeCompleto ?></span>
                                <p><span>$<?php echo $Pontos ?></span> pontos</p>
                                <?php else: ?>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>


            <hr id="linha_pagina">
            <section id="section_produtos">
                <?php
                $sql = "SELECT * FROM Brinde";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="produto_individual">
                            <div id="imagem_produto"><img src="imagens/brinde<?php echo $row['Cod_produto']?>.jpg" alt="brinde <?php echo $row['Nome'] ?>"></div>

                            <div id="textos_produto_individual">
                                <div class="nome_desc"><p id="nome_produto"><?php echo $row['Nome'] ?></p>
                                <div id="descricao_produto">
                                    <p><?php echo $row['Descricao'] ?></p>
                                </div></div>
                                
                                <div id="valor_e_botao">
                                    <p>$<?php echo $row['Preco'] ?> pontos</p>
                                    <div class="resgatar_brinde_pagina"><a href="resgate.php?id_brinde=<?php echo $row['Cod_produto']?>">Resgatar</a></div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </section>
        </section>
    </main>



    <div id="popup_resgatar">

        <span id="close_resgatar">&times;</span>
        <div id="titulo_div_resgata">
            <span id="titulo_resgata">Resgate</span>

            <div id="popup-content_resgata">
                <form method="post" id="form_lista_resgata">
                    <div id="resumo_brinde">
                        <?php $id_brinde = isset($_GET["id_brinde"]) ? $_GET["id_brinde"] : 1;
                        if ($id_brinde == 0) {
                            echo 'Escolha uma brinde primeiramente!';
                        } else {
                            $sql = "SELECT * FROM Brinde WHERE Cod_produto = $id_brinde";
                            $result = $conn->query($sql);

                            if ($result === false) {
                                echo 'Erro na consulta: ' . $conn->error;
                            } elseif ($result->num_rows == 0) {
                                echo 'Nenhum resultado encontrado para o destino com o ID ' . $id;
                            } else {
                                $row = $result->fetch_assoc();
                            }
                        }
                        ?>
                        <img src="imagens/brinde<?php echo $row['Cod_produto']?>.jpg" id="img_brinde_resumo">

                        <div id="nome_quant_brinde_popup">
                            <h4><?php echo $row['Nome'] ?></h4>
                            <span>Quantidade: <input type="number" min="1" max="10" value="1" name="quantidade_brinde" id="quantidade_brinde"></span>
                        </div>

                        <div id="preco_popup">$<?php echo $row['Preco'] ?></div>

                    </div>
                    <input type="submit" value="Resgatar" id="resgatar_brinde_popup">
                </form>

                <input type="text" class="inputs_enfeite" placeholder="Endereço">

                <input type="text" class="inputs_enfeite" placeholder="CEP">

                <input type="text" class="inputs_enfeite" placeholder="Número">
            </div>
        </div>
    </div>





    <div id="popup" class="popup">
            <span class="close" id="closePopup">&times;</span>
            <div id="titulo_div">
                <span id="titulo">Pesquisa</span>
                <div class="popup-content">

                    <form action="../busca/index.php" id="form_pesquisa" method="get">
                        <div style="display: flex; align-items: center;">
                            <img src="../img_principais/lupa.png" alt="lupa busca">
                            <input type="text" id="pesquisa_text" name="busca" placeholder="Procure por destinos" maxlength="30">
                        </div>
                        <hr>
                        <span class="filtro_ordenar">Ordenar por: </span>
                        <div id="inputs_filtros">
                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Nome_Lugar">
                                <span class="checkbox-text">Destino</span>
                            </label>

                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Cidade">
                                <span class="checkbox-text">Cidade</span>
                            </label>

                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Estado">
                                <span class="checkbox-text">Estado</span>
                            </label>

                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Pais">
                                <span class="checkbox-text">País</span>
                            </label>

                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Continente">
                                <span class="checkbox-text">Continente</span>
                            </label>

                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Nivel_dificul">
                                <span class="checkbox-text">Dificuldade</span>
                            </label>

                            <label class="custom-checkbox">
                                <input type="radio" id="meu-checkbox" name="order" value="Preco_aprox">
                                <span class="checkbox-text">Preço</span>
                            </label>
                        </div>


                        <input type="submit" value="Buscar" id="submit_buscar_popup">
                    </form>


                </div>
            </div>

        </div>




    <script>
        /* Script popup de busca */

        document.getElementById("div_perfil_resgata").addEventListener("click", function() {
            window.location.href = 'resgatado/'
        });

        document.getElementById("divbusca").addEventListener("click", function() {
            document.getElementById("popup").style.display = "block";
        });

        document.getElementById("closePopup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });

        document.getElementById("submit_buscar_popup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });
    </script>



    <footer>
        <div id="dados_div">
            <div class="dados_footer">
                <p>Desenvolvedores</p>
                <ul>
                    <li>Daniel Musse &ensp; &ensp;&ensp; &ensp;<a href="linkedin.com" target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                    <li>Fábio Gortz &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="linkedin.com" target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="../img_principais/github.png" alt="github"></a>
                    </li>
                    <li>João Hernandes &ensp;&ensp;<a href="linkedin.com" target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                    <li>Lucas Kempa &ensp;&ensp;&ensp;&ensp;&ensp;<a href="https://www.linkedin.com/in/lucas-kempa-90a265286/" target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                    <li>Pedro Cabral&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="https://www.linkedin.com/in/pedro-henrique-silva-cabral-2b820420b/" target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a href="https://github.com/phsilvacabral" target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                </ul>
            </div>

            <div class="dados_footer">
                <p>Professores</p>
                <ul>
                    <li>Cristina de Souza&ensp;&ensp; &ensp;-&ensp;&ensp;&ensp;Banco de Dados</li>
                    <li>Emeson Paraíso&ensp;&ensp;&ensp;&ensp;&ensp;-&ensp;&ensp;&ensp;Interação Humano Computador</li>
                    <li>Maicris Fernandes&ensp;&ensp;&ensp;-&ensp;&ensp;&ensp;Programação WEB</li>
                    <li>Sheila Reinehr&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;-&ensp;&ensp;&ensp;Engenharia de
                        requisitos</li>
                </ul>
            </div>

            <div class="dados_footer" id="links_footer">
                <p>Links</p>
                <ul>
                    <li><a href="../nacionais/">Viagens Nacionais</a></li>
                    <li><a href="../internacionais/">Viagens Internacionais</a></li>
                    <li><a href="../blog/">Blogs</a></li>
                    <li><a href="../perfil/">Perfil</a></li>
                    <li><a href="../123recompensa/">123recompensa</a></li>
                </ul>
            </div>
        </div>
        <div id="copy123folhas"><a href="../">&copy;123folhas</a></div>
    </footer>

</body>

</html>