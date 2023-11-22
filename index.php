<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img_principais/icon_logo.png" type="image/x-icon">
    <title>123folhas</title>
</head>

<body>
    <?php
        include('connection.php');
        session_start();
    ?>
    <header class="navegar">
        <nav class="barranav">
            <div class="logodentro">
                <a href=""><img src="img_principais/logo_semfundo.png" alt="logo 123 folhas" class="logo"></a>
            </div>
            <div class="emcoluna">
                <div id="divbusca"><span>Buscar</span><img src="img_principais/lupa.png" alt="Buscar" id="lupa_busca">
                </div>

                <div class="alinharletra">
                    <a href="nacionais/" class="letra">NACIONAIS</a>
                    <a href="internacionais/" class="letra">INTERNACIONAIS</a>
                    <a href="blog/" class="letra">BLOG</a>
                    <a href="123recompensa/" class="letra">123RECOMPENSA</a>
                </div>
            </div>

            <div class="spaceperfil">
                <?php if (!isset($_SESSION['Cod_Cliente'])): ?>
                    <a href="login/">
                        <figure>
                            <img src="img_principais/perfil_padrao.jpg" alt="logo 123 folhas" class="perfil">
                            <figcaption>Login</figcaption>
                        </figure>
                    </a>
                <?php else: ?>
                    <?php 
                        $sqlP = "SELECT Nome FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
                        $resultP = $conn->query($sqlP);
                        $rowP = $resultP->fetch_assoc();
                        $nomeCompleto = $rowP['Nome'];
                        $partesNome = explode(' ', $nomeCompleto);
                        $_clienteLogado = $partesNome[0];
                    ?>
                    <a href="perfil/">
                        <figure>
                            <img src="img_principais/perfil_padrao.jpg" alt="Foto do Usuário" class="perfil">
                            <figcaption><?php echo $_clienteLogado ?></figcaption>
                        </figure>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>

        <div id="popup" class="popup">
            <span class="close" id="closePopup">&times;</span>
            <div id="titulo_div">
                <span id="titulo">Pesquisa</span>
                <div class="popup-content">

                    <form action="busca/index.php" id="form_pesquisa" method="get">
                        <div style="display: flex; align-items: center;">
                            <img src="img_principais/lupa.png" alt="lupa busca">
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
            // Código regex barra de pesquisa
            document.addEventListener('DOMContentLoaded', function() {
                var inputBusca = document.getElementById('pesquisa_text');

                inputBusca.addEventListener('input', function() {
                    var inputValue = inputBusca.value;
                    var regex = /^[a-zA-Z0-9 ]*$/;

                    if (!regex.test(inputValue)) {
                        alert('Por favor, insira apenas caracteres alfanuméricos, números e espaços.');
                        // ou você pode limpar o valor, redefinir para uma string vazia, ou tomar outra ação apropriada
                        inputBusca.value = '';
                    }
                });
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


    </main>

    <section class="firstnavegarcorpo">
        <div class="destinosN"><a href="nacionais/" id="destinoslink">Nacionais</a></div>
        <div class="moverallcorpo">
            <p class="descubraN">Descubra o Brasil: Natureza exuberante, cultura vibrante e sustentabilidade em
                um só destino!</p>
        </div>
        <div class="caixas">

            <?php
            $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Pais = 'Brasil' ORDER BY RAND()";
            $result = $conn->query($sql);
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="bordacaixas">
                        <a href="destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                            <img src="destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" class="fotodentro">
                            <div class="linha0">
                                <div>
                                    <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                    <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado'] ?></p>
                                    <div class="escritacaixa">
                                        <p><?php echo $row['Desc_Destino'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="secaoprecodificuldade">
                                <p class="precocaixa">R$ <?php echo $row['Preco_aprox'] ?></p>
                                <p class="dificuldadecaixa">Dificuldade: <?php echo $row['Nivel_dificul'] ?></p>
                            </div>

                        </a>
                    </div>
            <?php
                    $count++;
                    if ($count >= 10) {
                        break;
                    }
                }
            }
            ?>
        </div>

    </section>
    <section class="navegarcorpo">
        <div class="destinosN">
            <a href="internacionais/" id="destinoslink">Internacionais</a>
        </div>
        <div class="moverallcorpo">
            <p class="descubraN">Não importa se você deseja mergulhar nos ecossistemas aquáticos, caminhar em terras protegidas ou se maravilhar com paisagens deslumbrantes, há um mundo natural esperando por você.</p>
        </div>

        <div class="caixas">
            <?php
            $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Pais != 'Brasil' ORDER BY RAND()";
            $result = $conn->query($sql);
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="bordacaixas">
                        <a href="destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                            <img src="destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" class="fotodentro">
                            <div class="linha0">
                                <div>
                                    <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                    <p class="lugarcaixa"><?php echo $row['Estado'] . ' - ' . $row['Pais'] . ' - ' . $row['Continente'] ?></p>
                                    <div class="escritacaixa">
                                        <p><?php echo $row['Desc_Destino'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="secaoprecodificuldade">
                                <p class="precocaixa">R$ <?php echo $row['Preco_aprox'] ?></p>
                                <p class="dificuldadecaixa">Dificuldade: <?php echo $row['Nivel_dificul'] ?></p>
                            </div>

                        </a>
                    </div>
            <?php
                    $count++;
                    if ($count >= 10) {
                        break;
                    }
                }
            }
            ?>
        </div>

    </section>

    <section class="navegarcorpo">
        <div class="destinosN"><a href="blog/" id="destinoslink">Blogs</a></div>
        <div class="moverallcorpo">
            <p class="descubraN">Descubra insights e inspirações valiosas para um futuro sustentável em nosso blog. Comece a leitura e seja parte da mudança positiva que o mundo precisa</p>
        </div>

        <div class="linhablog">

            <?php
            $sql = "SELECT Cod_blog, Titulo, Autor, DATE_FORMAT(Data_publicada, '%d/%m/%Y') AS DT_publicacao FROM Blog ORDER BY Gostei DESC";
            $result = $conn->query($sql);
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <a href="blog/acessar/index.php?Cod_blog=<?php echo $row['Cod_blog']; ?>">
                        <div class="bordacaixasblog">
                            <img class="conteudocaixasblog" src="blog/imagens/blog<?php echo $row['Cod_blog'] ?>.jpg">
                            <div class="alinharescritasblog">
                                <div class="conteudoescritablog"><?php echo $row['Titulo']; ?></div>
                                <div class="autordatablog">
                                    <div class="autorblog">by <?php echo $row['Autor'] ?></div>
                                    <div class="datablog"><?php echo $row['DT_publicacao']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php
                    $count++;
                    if ($count >= 2) {
                        break;
                    }
                }
            }
            ?>

        </div>

        <div class="linhablog">

            <?php
            $sql = "SELECT Cod_blog, Titulo, Autor, DATE_FORMAT(Data_publicada, '%d/%m/%Y') AS DT_publicacao FROM Blog ORDER BY Titulo";
            $result = $conn->query($sql);
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <a href="blog/acessar/index.php?Cod_blog=<?php echo $row['Cod_blog'] ?>">
                        <div class="bordacaixasblog">
                            <img class="conteudocaixasblog" src="blog/imagens/blog<?php echo $row['Cod_blog'] ?>.jpg">
                            <div class="alinharescritasblog">
                                <div class="conteudoescritablog"><?php echo $row['Titulo'] ?></div>
                                <div class="autordatablog">
                                    <div class="autorblog">by <?php echo $row['Autor'] ?></div>
                                    <div class="datablog"><?php echo $row['DT_publicacao'] ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php
                    $count++;
                    if ($count >= 2) {
                        break;
                    }
                }
            }
            ?>

        </div>
    </section>

    <footer>
        <div id="dados_div">
            <div class="dados_footer">
                <p>Desenvolvedores</p>
                <ul>
                    <li>Daniel Musse &ensp; &ensp;&ensp; &ensp;<a href="linkedin.com" target="_blank"><img src="img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="img_principais/github.png" alt="github"></a></li>
                    <li>Fábio Gortz &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="linkedin.com" target="_blank"><img src="img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="img_principais/github.png" alt="github"></a>
                    </li>
                    <li>João Hernandes &ensp;&ensp;<a href="linkedin.com" target="_blank"><img src="img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="img_principais/github.png" alt="github"></a></li>
                    <li>Lucas Kempa &ensp;&ensp;&ensp;&ensp;&ensp;<a href="https://www.linkedin.com/in/lucas-kempa-90a265286/" target="_blank"><img src="img_principais/linkedin.png" alt="linkedin"></a><a href="github.com" target="_blank"><img src="img_principais/github.png" alt="github"></a></li>
                    <li>Pedro Cabral&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="https://www.linkedin.com/in/pedro-henrique-silva-cabral-2b820420b/" target="_blank"><img src="img_principais/linkedin.png" alt="linkedin"></a><a href="https://github.com/phsilvacabral" target="_blank"><img src="img_principais/github.png" alt="github"></a></li>
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
                    <li><a href="nacionais/">Viagens Nacionais</a></li>
                    <li><a href="internacionais/">Viagens Internacionais</a></li>
                    <li><a href="blog/">Blogs</a></li>
                    <li><a href="perfil/">Perfil</a></li>
                    <li><a href="123recompensa/">123recompensa</a></li>
                </ul>
            </div>
        </div>
        <div id="copy123folhas"><a href="../">&copy;123folhas</a></div>
    </footer>
    <script>
    </script>
    </script>
    </script>
</body>

</html>