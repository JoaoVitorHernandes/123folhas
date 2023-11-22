<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img_principais/icon_logo.png" type="image/x-icon">
    <title>123folhas</title>
</head>

<body>
    <?php 
        include("../connection.php"); 
        session_start();
    ?>
    <header class="navegar">
        <nav class="barranav">
            <div class="logodentro">
                <a href="../"><img src="../img_principais/logo_semfundo.png" alt="logo 123 folhas"
                        class="logo"></a>
            </div>
            <div class="emcoluna">
                <div id="divbusca"><span>Buscar</span><img src="../img_principais/lupa.png" alt="Buscar"
                        id="lupa_busca">
                </div>

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
                        $sqlP = "SELECT Nome FROM Cliente WHERE Cod_Cliente = '{$_SESSION['Cod_Cliente']}'";
                        $resultP = $conn->query($sqlP);
                        $rowP = $resultP->fetch_assoc();
                        $nomeCompleto = $rowP['Nome'];
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
        <section class="navegarcorpo">
            <div class="alinhardescubraobrasil">
                <div class="DescubraoBrasil">Descubra o mundo</div>
                <div class="estados">Internacionais</div>
            </div>
            <div class="destinosN">África</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com uma diversidade selvagem inigualável, o continente africano é o lar de safáris inesquecíveis. Do Serengeti às selvas do Congo, o ecoturismo aqui permite vivenciar a beleza natural e contribuir para a preservação de espécies icônicas.</p>
            </div>
            <div class="caixas">
            <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Continente = 'África'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" alt="" class="fotodentro">
                                <div class="linha0">
                                    <div>
                                        <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                        <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado']. ' - '. $row['Pais']?></p>
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
                    }
                }
                ?>
            </div>

        </section>

        <section class="navegarcorpo">
            <div class="destinosN">América</div>
            <div class="moverallcorpo">
                <p class="descubraN">Da Amazônia à Patagônia, as Américas oferecem uma gama incrível de ecossistemas. Através de trilhas na floresta tropical, expedições glaciais ou mergulhos em recifes, o ecoturismo neste continente é uma jornada de descoberta e respeito pela biodiversidade.</p>
            </div>
            <div class="caixas">
            <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Continente, Nivel_dificul, Preco_aprox, Desc_Destino 
                FROM Destino WHERE Continente LIKE 'América%' AND Pais <> 'Brasil';";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" alt="" class="fotodentro">
                                <div class="linha0">
                                    <div>
                                        <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                        <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado']. ' - '. $row['Pais']?></p>
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
                    }
                }
                ?>
            </div>

        </section>

        <section class="navegarcorpo">
            <div class="destinosN">Antartida</div>
            <div class="moverallcorpo">
                <p class="descubraN">Descubra a magia gelada da Antártida! Embarque em uma jornada única e ecoconsciente, preservando a beleza intocada deste santuário polar. Faça parte da mudança positiva, promovendo o ecoturismo e protegendo esse ecossistema frágil. Junte-se a nós na preservação do último continente selvagem. </p>
            </div>
            <div class="caixas">
            <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Continente = 'Antartida'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" alt="" class="fotodentro">
                                <div class="linha0">
                                    <div>
                                        <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                        <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado']. ' - '. $row['Pais']?></p>
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
                    }
                }
                ?>
            </div>

        </section>

        <section class="navegarcorpo">
            <div class="destinosN">Ásia</div>
            <div class="moverallcorpo">
                <p class="descubraN">Das montanhas do Himalaia às praias paradisíacas do sudeste asiático, este continente é um tesouro para os amantes da natureza. Ecoturismo na Ásia significa explorar templos antigos, florestas exuberantes e encontros com animais selvagens únicos.</p>
            </div>
            <div class="caixas">
            <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Continente = 'Ásia'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" alt="" class="fotodentro">
                                <div class="linha0">
                                    <div>
                                        <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                        <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado']. ' - '. $row['Pais']?></p>
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
                    }
                }
                ?>
            </div>

        </section>

        <section class="navegarcorpo">
            <div class="destinosN">Europa</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com uma mistura de paisagens deslumbrantes e práticas de conservação, a Europa oferece uma abordagem única para o ecoturismo. Trilhas pelas montanhas, passeios de bicicleta por vales verdejantes e visitas a reservas naturais revelam a riqueza ecológica deste continente.</p>
            </div>
            <div class="caixas">
            <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Continente = 'Europa'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" alt="" class="fotodentro">
                                <div class="linha0">
                                    <div>
                                        <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                        <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado']. ' - '. $row['Pais']?></p>
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
                    }
                }
                ?>
            </div>

        </section>

        <section class="navegarcorpo">
            <div class="destinosN">Oceania</div>
            <div class="moverallcorpo">
                <p class="descubraN">Composta por ilhas tropicais e vastos territórios selvagens, a Oceania é um paraíso para o ecoturismo. Dos recifes de coral da Grande Barreira na Austrália às florestas tropicais da Nova Zelândia, esta região oferece aventuras imersivas e experiências de preservação única.</p>
            </div>
            <div class="caixas">
            <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Pais, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Continente = 'Oceania'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar'] ?>.jpg" alt="" class="fotodentro">
                                <div class="linha0">
                                    <div>
                                        <p class="titulocaixa"><?php echo $row['Nome_Lugar'] ?></p>
                                        <p class="lugarcaixa"><?php echo $row['Cidade'] . ' - ' . $row['Estado']. ' - '. $row['Pais']?></p>
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
                    }
                }
                ?>
            </div>

        </section>

        <div id="popup" class="popup">
        <span class="close" id="closePopup">&times;</span>
        <div id="titulo_div">
            <span id="titulo">Pesquisa</span>
            <div class="popup-content">
                <form action="../busca/" id="form_pesquisa" method="get">
                    <div style="display: flex; align-items: center;">
                        <img src="../img_principais/lupa.png" alt="lupa busca">
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

        <script>

            document.getElementById("divbusca").addEventListener("click", function () {
                document.getElementById("popup").style.display = "block";
            });

            document.getElementById("closePopup").addEventListener("click", function () {
                document.getElementById("popup").style.display = "none";
            });

            document.getElementById("submit_buscar_popup").addEventListener("click", function () {
                document.getElementById("popup").style.display = "none";
            });

        </script>

        <footer>
            <div id="dados_div">
                <div class="dados_footer">
                    <p>Desenvolvedores</p>
                    <ul>
                        <li>Daniel Musse &ensp; &ensp;&ensp; &ensp;<a href="linkedin.com" target="_blank"><img
                                    src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com"
                                target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                        <li>Fábio Gortz &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="linkedin.com"
                                target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a
                                href="github.com" target="_blank"><img src="../img_principais/github.png"
                                    alt="github"></a>
                        </li>
                        <li>João Hernandes &ensp;&ensp;<a href="linkedin.com" target="_blank"><img
                                    src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com"
                                target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                        <li>Lucas Kempa &ensp;&ensp;&ensp;&ensp;&ensp;<a
                                href="https://www.linkedin.com/in/lucas-kempa-90a265286/" target="_blank"><img
                                    src="../img_principais/linkedin.png" alt="linkedin"></a><a href="github.com"
                                target="_blank"><img src="../img_principais/github.png" alt="github"></a></li>
                        <li>Pedro Cabral&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a
                                href="https://www.linkedin.com/in/pedro-henrique-silva-cabral-2b820420b/"
                                target="_blank"><img src="../img_principais/linkedin.png" alt="linkedin"></a><a
                                href="https://github.com/phsilvacabral" target="_blank"><img
                                    src="../img_principais/github.png" alt="github"></a></li>
                    </ul>
                </div>

                <div class="dados_footer">
                    <p>Professores</p>
                    <ul>
                        <li>Cristina de Souza&ensp;&ensp; &ensp;-&ensp;&ensp;&ensp;Banco de Dados</li>
                        <li>Emeson Paraíso&ensp;&ensp;&ensp;&ensp;&ensp;-&ensp;&ensp;&ensp;Interação Humano Computador
                        </li>
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