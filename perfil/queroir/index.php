<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../img_principais/icon_logo.png" type="image/x-icon">
    <title>Quero ir</title>
</head>

<body>
    <?php 
        include("../../connection.php"); 
        session_start();
        if (!isset($_SESSION["Cod_Cliente"])) {
            header("Location: /123folhas/");
            exit();
        }
    ?>
    <header class="navegar">
        <nav class="barranav">
            <div class="logodentro">
                <a href="../../"><img src="../../img_principais/logo_semfundo.png" alt="logo 123 folhas" class="logo"></a>
            </div>
            <div class="emcoluna">
                <div id="divbusca"><span>Buscar</span><img src="../../img_principais/lupa.png" alt="Buscar" id="lupa_busca"></div>

                <div class="alinharletra">
                    <a href="../../nacionais/" class="letra">NACIONAIS</a>
                    <a href="../../internacionais/" class="letra">INTERNACIONAIS</a>
                    <a href="../../blog/" class="letra">BLOG</a>
                    <a href="../../123recompensa/" class="letra">123RECOMPENSA</a>
                </div>
            </div>

            <div class="spaceperfil">
                <?php if (!isset($_SESSION['Cod_Cliente'])): ?>
                    <a href="../../login/">
                        <figure>
                            <img src="../../img_principais/perfil_padrao.jpg" alt="logo 123 folhas" class="perfil">
                            <figcaption>Login</figcaption>
                        </figure>
                    </a>
                <?php else: ?>
                    <?php 
                        $sql = "SELECT Nome FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $nomeCompleto = $row['Nome'];
                        $partesNome = explode(' ', $nomeCompleto);
                        $_clienteLogado = $partesNome[0];
                    ?>
                    <a href="../../perfil/">
                        <figure>
                            <img src="../../img_principais/perfil_padrao.jpg" alt="Foto do Usuário" class="perfil">
                            <figcaption><?php echo $_clienteLogado ?></figcaption>
                        </figure>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>

        <section id="section_conteudo">
            <div id="destinos_queroir_topo">
                <span>Destinos salvos</span>
                <p><img src="../../img_principais/icone_queroir.png">Quero ir</p>
            </div>

            <section id="section_destinos">
                <?php 
                    $sqlID = "SELECT Cod_Inteteresse, fk_Destino_Cod_Lugar, Comentario FROM se_interessa WHERE fk_Cliente_Cod_Cliente = {$_SESSION['Cod_Cliente']}";
                    $resultID = $conn->query($sqlID);
                    if ($resultID->num_rows > 0) {
                        while ($rowID = $resultID->fetch_assoc()) {
                            $sqlD = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais FROM Destino WHERE Cod_Lugar = {$rowID['fk_Destino_Cod_Lugar']}";
                            $resultD = $conn->query($sqlD);
                            if ($resultD->num_rows > 0) {
                                while ($rowD = $resultD->fetch_assoc()) {

                            ?>
                                    <div class="destino_individual">
                                        <div id="imagem_destino"><a href="../../destino/index.php?Cod_Lugar=<?php echo $rowD['Cod_Lugar'] ?>"><img src="../../destino/imagens/viagem<?php echo $rowD['Cod_Lugar'] ?>.jpg" alt="destino1"></a></div>

                                        <div id="textos_destino_individual">
                                            <p id="nome_lugar"><a href="../../destino/index.php?Cod_Lugar=<?php echo $rowD['Cod_Lugar'] ?>"><?php echo $rowD['Nome_Lugar']?></a></p>
                                            <p id="localizacao_lugar"><?php echo $rowD['Cidade']?>, <?php echo $rowD['Estado']?>, <?php echo $rowD['Pais']?></p>

                                            <span id="your_coment">Seu comentário:</span>
                                            <div id="comentario_destino"><p><?php echo $rowID['Comentario']?></p></div>

                                            <img src="../../img_principais/lixeira.png" alt="<?php echo $rowID['Cod_Inteteresse'] ?>" id="lixeira_apagar" class="lixeira_apagar">
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        }
                    }
                ?>



                
            </section>
        </section>
    </main>



    <div id="popup" class="popup">
        <span class="close" id="closePopup">&times;</span>
        <div id="titulo_div">
            <span id="titulo">Pesquisa</span>
            <div class="popup-content">
                <form action="../../busca/" id="form_pesquisa" method="get">
                    <div style="display: flex; align-items: center;">
                        <img src="../../img_principais/lupa.png" alt="lupa busca">
                        <input type="text" id="pesquisa_text" name="busca" placeholder="Procure por destinos" maxlength="30">
                    </div>
                    <hr>

                    <span class="filtro_ordenar">Ordenar por:</span>

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


    <div id="popup_excluir">
        <span class="close" id="closePopup_excluir">&times;</span>
        <div id="titulo_div_excluir">

            <div class="popup-content_excluir">
            <span id="titulo_excluir">Excluir</span>

                <form id="form_senha" method="get" action="quero_php.php">
                    <input type="hidden" name="hidId" id="hidId" value="">
                    <span id="erro_senha">Deseja mesmo apagar esse destino da lista 'Quero ir'</span>
                
                    <input type="submit" value="Excluir" id="botao_excluir_popup">

                </form>
            </div>            
        </div>
    </div>

    <script>

        /* Script popup de busca */

        document.getElementById("divbusca").addEventListener("click", function() {
            document.getElementById("popup").style.display = "block";
        });

        document.getElementById("closePopup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });

        document.getElementById("submit_buscar_popup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });



        /* Script popup excluir destino */

  

        let elementos = document.getElementsByClassName("lixeira_apagar");

        for (var i = 0; i < elementos.length; i++) {
            elementos[i].addEventListener("click", function() {
                document.getElementById("popup_excluir").style.display = "block";
                var valorAlt = this.getAttribute("alt");
                document.getElementById("hidId").value = valorAlt;
            });
        }
    
        document.getElementById("closePopup_excluir").addEventListener("click", function() {
                document.getElementById("popup_excluir").style.display = "none";
            });

        document.getElementById("botao_excluir_popup").addEventListener("click", function() {
                document.getElementById("popup_excluir").style.display = "none";
            });
    </script>



    <footer>
        <div id="dados_div">
            <div class="dados_footer">
                <p>Desenvolvedores</p>
                <ul>
                    <li>Daniel Musse &ensp; &ensp;&ensp; &ensp;<a href="linkedin.com" target="_blank"><img
                                src="../../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com"
                            target="_blank"><img src="../../img_principais/github.png" alt="github"></a></li>
                    <li>Fábio Gortz &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="linkedin.com"
                            target="_blank"><img src="../../img_principais/linkedin.png" alt="linkedin"></a><a
                            href="github.com" target="_blank"><img src="../../img_principais/github.png" alt="github"></a>
                    </li>
                    <li>João Hernandes &ensp;&ensp;<a href="linkedin.com" target="_blank"><img
                                src="../../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com"
                            target="_blank"><img src="../../img_principais/github.png" alt="github"></a></li>
                    <li>Lucas Kempa &ensp;&ensp;&ensp;&ensp;&ensp;<a
                            href="https://www.linkedin.com/in/lucas-kempa-90a265286/" target="_blank"><img
                                src="../../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com"
                            target="_blank"><img src="../../img_principais/github.png" alt="github"></a></li>
                    <li>Pedro Cabral&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a
                            href="https://www.linkedin.com/in/pedro-henrique-silva-cabral-2b820420b/"
                            target="_blank"><img src="../../img_principais/linkedin.png" alt="linkedin"></a><a
                            href="https://github.com/phsilvacabral" target="_blank"><img src="../../img_principais/github.png"
                                alt="github"></a></li>
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
                    <li><a href="../../nacionais/">Viagens Nacionais</a></li>
                    <li><a href="../../internacionais/">Viagens Internacionais</a></li>
                    <li><a href="../../blog/">Blogs</a></li>
                    <li><a href="../../perfil/">Perfil</a></li>
                    <li><a href="../../123recompensa/">123recompensa</a></li>
                </ul>
            </div>
        </div>
        <div id="copy123folhas"><a href="../">&copy;123folhas</a></div>
    </footer>

</body>

</html>