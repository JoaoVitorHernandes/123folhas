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
                <a href="../"><img src="../img_principais/logo_semfundo.png" alt="logo 123 folhas" class="logo"></a>
            </div>
            <div class="emcoluna">
                <div id="divbusca"><span>Buscar</span><img src="../img_principais/lupa.png" alt="Buscar" id="lupa_busca">
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
                <div class="DescubraoBrasil">Descubra o Brasil</div>
                <div class="estados">Nacionais</div>
            </div>
            
            <div class="destinosN">Acre (AC)</div>
            <div class="moverallcorpo">
                <p class="descubraN">No coração da Amazônia, o Acre encanta com sua exuberante floresta tropical. Explore trilhas na Reserva Extrativista Chico Mendes ou navegue pelos rios em busca de vida selvagem.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Acre'";
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Alagoas (AL)</div>
            <div class="moverallcorpo">
                <p class="descubraN">No coração da Amazônia, o Acre encanta com sua exuberante floresta tropical. Explore trilhas na Reserva Extrativista Chico Mendes ou navegue pelos rios em busca de vida selvagem.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Alagoas'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Amapá (AP)</div>
            <div class="moverallcorpo">
                <p class="descubraN">A biodiversidade única do Amapá atrai os amantes da natureza para suas reservas ecológicas, como o Parque Nacional Montanhas do Tumucumaque, lar de espécies raras da fauna amazônica.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Amapá'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Amazonas (AM)</div>
            <div class="moverallcorpo">
                <p class="descubraN">O Amazonas é um paraíso natural com a maior floresta tropical do mundo. Passeios de barco pelos rios, caminhadas na selva e observação da vida selvagem são experiências inesquecíveis.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Amazonas'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Bahia (BA)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Além de suas praias famosas, a Bahia oferece ecoturismo em sua Chapada Diamantina, com cachoeiras deslumbrantes, cavernas e trilhas que revelam a beleza natural do estado.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Bahia'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Ceará (CE)</div>
            <div class="moverallcorpo">
                <p class="descubraN">As dunas de areia e lagoas do Parque Nacional de Jericoacoara são destinos imperdíveis para os amantes de aventura e ecoturismo no Ceará.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Ceará'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Distrito Federal (DF)</div>
            <div class="moverallcorpo">
                <p class="descubraN">No coração do Brasil, o Distrito Federal reserva surpresas naturais, como o Parque Nacional de Brasília, oferecendo trilhas ecológicas e contato com a fauna local.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Distrito Federal'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Espírito Santo (ES)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com suas montanhas e praias intocadas, o Espírito Santo proporciona ecoturismo através de trilhas na Mata Atlântica e mergulhos em águas cristalinas.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Espírito Santo'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Goiás (GO)</div>
            <div class="moverallcorpo">
                <p class="descubraN">O Jalapão é o destaque do ecoturismo em Goiás, com paisagens de cerrado, dunas douradas e cachoeiras convidativas para atividades ao ar livre.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Goiás'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Maranhão (MA)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Os Lençóis Maranhenses são um espetáculo natural único, com suas dunas e lagoas, oferecendo aos visitantes a oportunidade de explorar um cenário deslumbrante.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Maranhão'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Mato Grosso (MT)</div>
            <div class="moverallcorpo">
                <p class="descubraN">A vastidão do Pantanal e a exuberância da Amazônia fazem do Mato Grosso um destino essencial para o ecoturismo, com safáris, trilhas e observação de animais selvagens.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Mato Grosso'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Mato Grosso do Sul (MS)</div>
            <div class="moverallcorpo">
                <p class="descubraN">No Mato Grosso do Sul, o Pantanal sul-mato-grossense é um santuário para a vida selvagem, oferecendo safáris fotográficos e atividades de turismo ecológico.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Mato Grosso do Sul'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Minas Gerais (MG)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Suas montanhas e cavernas tornam Minas Gerais um local ideal para trilhas ecológicas, explorando a riqueza natural da Serra da Canastra e suas cachoeiras.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Minas Gerais'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Pará (PA)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com a Floresta Amazônica e rios imponentes, o Pará oferece oportunidades de ecoturismo incomparáveis, incluindo cruzeiros fluviais e trilhas na selva.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Pará'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Paraíba (PB)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com praias e áreas de preservação, a Paraíba oferece trilhas pela Mata Atlântica e mergulhos em suas águas claras, proporcionando experiências únicas para os amantes da natureza.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Paraíba'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Paraná (PR)</div>
            <div class="moverallcorpo">
                <p class="descubraN">A diversidade natural do Paraná é evidente na região da Serra do Mar, com suas trilhas na mata e a rica biodiversidade que encanta os visitantes.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Paraná'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Pernambuco (PE)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Além de suas praias, Pernambuco reserva o ecoturismo na região de Bonito, com cavernas, rios de águas cristalinas e trilhas na Mata Atlântica.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Pernambuco'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Piauí (PI)</div>
            <div class="moverallcorpo">
                <p class="descubraN">As paisagens únicas do Parque Nacional de Sete Cidades, com formações rochosas e sítios arqueológicos, são um convite ao ecoturismo no Piauí.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Piauí'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Rio de Janeiro (RJ)</div>
            <div class="moverallcorpo">
                <p class="descubraN">A cidade maravilhosa oferece não apenas praias famosas, mas também trilhas no Parque Nacional da Tijuca, revelando vistas deslumbrantes da Mata Atlântica.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Rio de Janeiro'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Rio Grande do Norte (RN)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Dunas, falésias e lagoas tornam o Rio Grande do Norte um destino perfeito para o ecoturismo, especialmente nas regiões de Genipabu e Pipa.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Rio Grande do Norte'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Rio Grande do Sul (RS)</div>
            <div class="moverallcorpo">
                <p class="descubraN">A Serra Gaúcha oferece paisagens exuberantes, com montanhas, vales e trilhas que levam a cachoeiras e cânions, atraindo os amantes da natureza.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Rio Grande do Sul'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Rondônia (RO)</div>
            <div class="moverallcorpo">
                <p class="descubraN">As reservas ecológicas de Rondônia proporcionam experiências únicas na Amazônia, com trilhas, passeios de barco e contato direto com a fauna e flora.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Rondônia'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Roraima (RR)</div>
            <div class="moverallcorpo">
                <p class="descubraN">O Monte Roraima e suas paisagens surreais convidam a aventura, com trilhas desafiadoras e uma natureza selvagem que fascina os aventureiros.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Roraima'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Santa Catarina (SC)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com suas praias e a Mata Atlântica, Santa Catarina oferece ecoturismo em suas trilhas na Serra do Mar e atividades ao ar livre em parques ecológicos.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Santa Catarina'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">São Paulo (SP)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Além da agitação urbana, São Paulo reserva espaços naturais como a Serra da Mantiqueira, com trilhas e cachoeiras, ideais para os amantes da natureza.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'São Paulo'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Sergipe (SE)</div>
            <div class="moverallcorpo">
                <p class="descubraN">Com praias preservadas e áreas de mangue, Sergipe oferece oportunidades para ecoturismo, incluindo passeios de barco e trilhas em suas reservas.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Sergipe'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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
                    }
                }
                ?>
            </div>

        </section>
        <section class="navegarcorpo">
            <div class="destinosN">Tocantins (TO)</div>
            <div class="moverallcorpo">
                <p class="descubraN">O Jalapão é o destaque do ecoturismo em Tocantins, com suas dunas, cachoeiras e paisagens de cerrado que convidam a aventuras ao ar livre.</p>
            </div>
            <div class="caixas">
                <?php
                $sql = "SELECT Cod_Lugar, Nome_Lugar, Cidade, Estado, Nivel_dificul, Preco_aprox, Desc_Destino FROM Destino WHERE Estado = 'Tocantins'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bordacaixas">
                            <a href="../destino/index.php?Cod_Lugar=<?php echo $row['Cod_Lugar'] ?>" class="linkcaixa">
                                <img src="../destino/imagens/viagem<?php echo $row['Cod_Lugar']?>.jpg" alt="" class="fotodentro">
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