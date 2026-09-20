<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

$numeroUsuarios = contarUsuarios();
$numeroObras = contarObras();
$numeroGeneros = contarGeneros();
$numeroAvisos = contarAvisos();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Controle do site | Apollo</title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS do Apollo -->

    <link
        rel="stylesheet"
        href="../css/styles.css">

</head>


<body>


    <!-- =====================================================
         MENU
         ===================================================== -->

    <header>

        <?php include '../menu.php'; ?>

    </header>


    <!-- =====================================================
         CONTEÚDO PRINCIPAL
         ===================================================== -->

    <main class="container py-5">


        <!-- =================================================
             CABEÇALHO
             ================================================= -->

        <section class="admin-cabecalho mb-5">

            <p class="hero-etiqueta">

                <i class="bi bi-shield-lock"></i>

                ÁREA ADMINISTRATIVA

            </p>


            <h1>

                Controle do site

            </h1>


            <p class="texto-autenticacao">

                Gerencie os principais conteúdos e informações
                da plataforma Apollo.

            </p>

        </section>



        <!-- =================================================
             INFORMAÇÕES DO SITE
             ================================================= -->

        <section class="mb-5">


            <div class="titulo-secao">

                <div>

                    <p>
                        VISÃO GERAL
                    </p>

                    <h2>
                        Informações do site
                    </h2>

                </div>


                <i class="bi bi-bar-chart-fill"></i>

            </div>



            <div class="row g-4">


                <!-- USUÁRIOS -->

                <div class="col-md-6 col-xl-3">

                    <div class="admin-info-card">


                        <div class="admin-info-icone">

                            <i class="bi bi-people-fill"></i>

                        </div>


                        <div>

                            <span>
                                Usuários
                            </span>

                            <strong>
                                <?= $numeroUsuarios ?>
                            </strong>

                        </div>


                    </div>

                </div>



                <!-- OBRAS -->

                <div class="col-md-6 col-xl-3">

                    <div class="admin-info-card">


                        <div class="admin-info-icone">

                            <i class="bi bi-film"></i>

                        </div>


                        <div>

                            <span>
                                Obras
                            </span>

                            <strong>
                                <?= $numeroObras ?>
                            </strong>

                        </div>


                    </div>

                </div>



                <!-- GÊNEROS -->

                <div class="col-md-6 col-xl-3">

                    <div class="admin-info-card">


                        <div class="admin-info-icone">

                            <i class="bi bi-grid-fill"></i>

                        </div>


                        <div>

                            <span>
                                Gêneros
                            </span>

                            <strong>
                                <?= $numeroGeneros ?>
                            </strong>

                        </div>


                    </div>

                </div>



                <!-- AVISOS -->

                <div class="col-md-6 col-xl-3">

                    <div class="admin-info-card">


                        <div class="admin-info-icone">

                            <i class="bi bi-megaphone-fill"></i>

                        </div>


                        <div>

                            <span>
                                Avisos
                            </span>

                            <strong>
                                <?= $numeroAvisos ?>
                            </strong>

                        </div>


                    </div>

                </div>


            </div>

        </section>



        <!-- =================================================
             AÇÕES ADMINISTRATIVAS
             ================================================= -->

        <section>


            <div class="titulo-secao">

                <div>

                    <p>
                        ADMINISTRAÇÃO
                    </p>

                    <h2>
                        Ações do site
                    </h2>

                </div>


                <i class="bi bi-gear-fill"></i>

            </div>



            <!--
                IMPORTANTE:

                Os cards estão diretamente dentro de
                .admin-acoes.

                Não usamos div.col-lg-3 aqui.
            -->

            <div class="admin-acoes">


                <!-- =================================================
                     GERENCIAR OBRAS
                     ================================================= -->

                <a
                    href="GerenciarObras.php"
                    class="admin-acao">


                    <i class="bi bi-film"></i>


                    <div>

                        <strong>
                            Gerenciar obras
                        </strong>


                        <span>
                            Cadastrar, editar e excluir obras.
                        </span>

                    </div>


                    <i class="bi bi-arrow-right"></i>


                </a>



                <!-- =================================================
                     GERENCIAR USUÁRIOS
                     ================================================= -->

                <a
                    href="GerenciarUsuarios.php"
                    class="admin-acao">


                    <i class="bi bi-people"></i>


                    <div>

                        <strong>
                            Gerenciar usuários
                        </strong>


                        <span>
                            Visualizar e administrar contas.
                        </span>

                    </div>


                    <i class="bi bi-arrow-right"></i>


                </a>



                <!-- =================================================
                     MODERAR COMENTÁRIOS
                     ================================================= -->

                <a
                    href="GerenciarComentarios.php"
                    class="admin-acao">


                    <i class="bi bi-chat-left-text"></i>


                    <div>

                        <strong>
                            Moderar comentários
                        </strong>


                        <span>
                            Gerenciar comentários da comunidade.
                        </span>

                    </div>


                    <i class="bi bi-arrow-right"></i>


                </a>



                <!-- =================================================
                     GERENCIAR AVISOS
                     ================================================= -->

                <a
                    href="GerenciarAvisos.php"
                    class="admin-acao">


                    <i class="bi bi-megaphone"></i>


                    <div>

                        <strong>
                            Gerenciar avisos
                        </strong>


                        <span>
                            Criar e administrar avisos.
                        </span>

                    </div>


                    <i class="bi bi-arrow-right"></i>


                </a>



                <!-- =================================================
                     GERENCIAR GÊNEROS
                     ================================================= -->

                <a
                    href="GerenciarGeneros.php"
                    class="admin-acao">


                    <i class="bi bi-grid"></i>


                    <div>

                        <strong>
                            Gerenciar gêneros
                        </strong>


                        <span>
                            Cadastrar, editar e excluir gêneros.
                        </span>

                    </div>


                    <i class="bi bi-arrow-right"></i>


                </a>


            </div>

        </section>


    </main>



    <!-- =====================================================
         RODAPÉ
         ===================================================== -->

    <footer>

        <div class="container">

            <p>
                © <?= date('Y') ?> Apollo — Controle do site.
            </p>

        </div>

    </footer>



    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>