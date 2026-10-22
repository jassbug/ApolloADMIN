<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// BUSCAR O ID DA OBRA
$idObra = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$idObra || $idObra <= 0) {
    header('Location: /index.php');
    exit;
}

// BUSCAR A OBRA
$obra = buscarObraPorId($idObra);

// VERIFICAR SE A OBRA EXISTE E ESTÁ ATIVA
if (!$obra || (int) $obra['ativo'] !== 1) {
    header('Location: /index.php');
    exit;
}

$conexao = conectarBanco();

// BUSCAR A MÉDIA DAS AVALIAÇÕES
$consultaAvaliacao = $conexao->prepare("
    SELECT
        AVG(nota) AS media,
        COUNT(*) AS quantidade
    FROM avaliacoes
    WHERE obra_id = :obra_id
");

$consultaAvaliacao->execute([
    ':obra_id' => $idObra
]);

$resultadoAvaliacao = $consultaAvaliacao->fetch();

$mediaAvaliacao = (float) ($resultadoAvaliacao['media'] ?? 0);
$quantidadeAvaliacoes = (int) ($resultadoAvaliacao['quantidade'] ?? 0);

// BUSCAR A AVALIAÇÃO DO USUÁRIO LOGADO
$avaliacaoUsuario = null;

if (usuarioLogado()) {
    $consultaUsuario = $conexao->prepare("
        SELECT nota
        FROM avaliacoes
        WHERE obra_id = :obra_id
          AND usuario_id = :usuario_id
    ");

    $consultaUsuario->execute([
        ':obra_id' => $idObra,
        ':usuario_id' => idUsuarioLogado()
    ]);

    $notaUsuario = $consultaUsuario->fetchColumn();

    if ($notaUsuario !== false) {
        $avaliacaoUsuario = (int) $notaUsuario;
    }
}

// CALCULAR AS ESTRELAS
$estrelasPreenchidas = (int) round($mediaAvaliacao / 2);

$estrelasPreenchidas = max(0, min(5, $estrelasPreenchidas));

// FORMATAR AS INFORMAÇÕES
$ano = $obra['ano_lancamento'] ?? '';
$estudio = $obra['estudio'] ?? '';
$duracao = $obra['duracao'] ?? '';
$classificacao = $obra['classificacao'] ?? '';
$descricao = $obra['descricao'] ?? '';
$capa = $obra['capa'] ?? '';

// BUSCAR O NOME DOS GÊNEROS
$generosObra = [];

if (!empty($obra['generos'])) {
    $idsGeneros = $obra['generos'];
    $marcadores = implode(',', array_fill(0, count($idsGeneros), '?'));

    $consultaGeneros = $conexao->prepare("
        SELECT nome
        FROM generos
        WHERE id IN ($marcadores)
          AND ativo = 1
        ORDER BY nome ASC
    ");

    $consultaGeneros->execute($idsGeneros);

    $generosObra = $consultaGeneros->fetchAll(PDO::FETCH_COLUMN);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($obra['titulo']) ?> - Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <?php require_once __DIR__ . '/menu.php'; ?>

    <main class="obra-pagina">

        <div class="obra-container">

            <!-- INFORMAÇÕES PRINCIPAIS -->
            <section class="obra-principal">

                <!-- CAPA -->
                <div class="obra-capa-container">

                    <?php if (!empty($capa)): ?>

                        <img
                            src="<?= e($capa) ?>"
                            alt="Capa de <?= e($obra['titulo']) ?>"
                            class="obra-capa"
                        >

                    <?php else: ?>

                        <div class="obra-sem-capa">
                            <i class="bi bi-image"></i>
                            <span>Capa indisponível</span>
                        </div>

                    <?php endif; ?>

                </div>

                <!-- DADOS DA OBRA -->
                <div class="obra-dados">

                    <span class="obra-etiqueta">
                        <?= e($obra['tipo']) ?>
                    </span>

                    <h1 class="obra-titulo">
                        <?= e($obra['titulo']) ?>
                    </h1>

                    <div class="obra-informacoes-rapidas">

                        <?php if (!empty($ano)): ?>
                            <span><?= e($ano) ?></span>
                        <?php endif; ?>

                        <?php if (!empty($estudio)): ?>
                            <span><?= e($estudio) ?></span>
                        <?php endif; ?>

                        <?php if (!empty($duracao)): ?>
                            <span><?= e($duracao) ?></span>
                        <?php endif; ?>

                    </div>

                    <!-- AVALIAÇÃO MÉDIA -->
                    <div class="obra-avaliacao">

                        <div class="obra-estrelas" aria-label="Média de avaliação">

                            <?php for ($i = 1; $i <= 5; $i++): ?>

                                <span class="<?= $i <= $estrelasPreenchidas ? 'estrela-ativa' : 'estrela-inativa' ?>">
                                    ★
                                </span>

                            <?php endfor; ?>

                        </div>

                        <div class="obra-media">

                            <?php if ($quantidadeAvaliacoes > 0): ?>

                                <strong>
                                    <?= number_format($mediaAvaliacao, 1, ',', '.') ?>/10
                                </strong>

                                <span>
                                    (<?= $quantidadeAvaliacoes ?>
                                    <?= $quantidadeAvaliacoes === 1 ? 'avaliação' : 'avaliações' ?>)
                                </span>

                            <?php else: ?>

                                <span>Esta obra ainda não possui avaliações.</span>

                            <?php endif; ?>

                        </div>

                    </div>

                    <!-- GÊNEROS -->
                    <?php if (!empty($generosObra)): ?>

                        <div class="obra-generos">

                            <?php foreach ($generosObra as $genero): ?>

                                <span class="obra-genero-tag">
                                    <?= e($genero) ?>
                                </span>

                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>

                    <!-- DESCRIÇÃO -->
                    <div class="obra-descricao">

                        <?php if (!empty($descricao)): ?>

                            <p><?= nl2br(e($descricao)) ?></p>

                        <?php else: ?>

                            <p>Esta obra ainda não possui uma descrição cadastrada.</p>

                        <?php endif; ?>

                    </div>

                    <!-- BOTÕES -->
                    <div class="obra-botoes">

                        <button
                            type="button"
                            class="obra-botao"
                            id="botao-minha-lista"
                        >
                            <i class="bi bi-plus-circle"></i>
                            Minha lista
                        </button>

                        <button
                            type="button"
                            class="obra-botao"
                            id="botao-favoritar"
                        >
                            <i class="bi bi-heart"></i>
                            Favoritar
                        </button>

                        <button
                            type="button"
                            class="obra-botao obra-botao-avaliar"
                            id="abrir-modal-avaliar"
                        >
                            <i class="bi bi-chat-dots"></i>
                            Avaliar obra
                        </button>

                    </div>

                </div>

            </section>

            <!-- ABAS -->
            <section class="obra-secao">

                <div class="obra-abas">

                    <button
                        type="button"
                        class="obra-aba ativa"
                        data-aba="comentarios"
                    >
                        Comentários
                    </button>

                    <button
                        type="button"
                        class="obra-aba"
                        data-aba="informacoes"
                    >
                        Informações
                    </button>

                </div>

                <!-- CONTEÚDO DOS COMENTÁRIOS -->
                <div
                    class="obra-conteudo-aba ativa"
                    id="aba-comentarios"
                >

                    <div class="obra-mensagem-vazia">

                        <i class="bi bi-chat-square-text"></i>

                        <h3>Comentários</h3>

                        <p>
                            Os comentários desta obra aparecerão aqui.
                        </p>

                        <button
                            type="button"
                            class="obra-botao"
                            id="abrir-modal-comentario"
                        >
                            Escrever comentário
                        </button>

                    </div>

                </div>

                <!-- CONTEÚDO DAS INFORMAÇÕES -->
                <div
                    class="obra-conteudo-aba"
                    id="aba-informacoes"
                >

                    <div class="obra-informacoes-lista">

                        <div>
                            <span>Título</span>
                            <strong><?= e($obra['titulo']) ?></strong>
                        </div>

                        <div>
                            <span>Tipo</span>
                            <strong><?= e($obra['tipo']) ?></strong>
                        </div>

                        <div>
                            <span>Ano de lançamento</span>
                            <strong><?= e($ano ?: 'Não informado') ?></strong>
                        </div>

                        <div>
                            <span>Estúdio</span>
                            <strong><?= e($estudio ?: 'Não informado') ?></strong>
                        </div>

                        <div>
                            <span>Duração</span>
                            <strong><?= e($duracao ?: 'Não informada') ?></strong>
                        </div>

                        <div>
                            <span>Classificação indicativa</span>
                            <strong><?= e($classificacao ?: 'Não informada') ?></strong>
                        </div>

                        <div>
                            <span>Gêneros</span>
                            <strong>
                                <?= !empty($generosObra) ? e(implode(', ', $generosObra)) : 'Não informados' ?>
                            </strong>
                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>

    <!-- MODAL DE AVALIAÇÃO -->
    <?php require __DIR__ . '/includes/Modal-avaliar-obra.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ABRIR E FECHAR O MODAL
        const modalAvaliacao = document.getElementById('modal-avaliar-obra');
        const botaoAbrirAvaliacao = document.getElementById('abrir-modal-avaliar');
        const botaoAbrirComentario = document.getElementById('abrir-modal-comentario');
        const botaoFecharAvaliacao = document.getElementById('fechar-modal-avaliar');

        function abrirModalAvaliacao() {
            if (modalAvaliacao) {
                modalAvaliacao.classList.add('ativo');
                document.body.classList.add('modal-aberto');
            }
        }

        function fecharModalAvaliacao() {
            if (modalAvaliacao) {
                modalAvaliacao.classList.remove('ativo');
                document.body.classList.remove('modal-aberto');
            }
        }

        if (botaoAbrirAvaliacao) {
            botaoAbrirAvaliacao.addEventListener('click', abrirModalAvaliacao);
        }

        if (botaoAbrirComentario) {
            botaoAbrirComentario.addEventListener('click', abrirModalAvaliacao);
        }

        if (botaoFecharAvaliacao) {
            botaoFecharAvaliacao.addEventListener('click', fecharModalAvaliacao);
        }

        if (modalAvaliacao) {
            modalAvaliacao.addEventListener('click', function(evento) {
                if (evento.target === modalAvaliacao) {
                    fecharModalAvaliacao();
                }
            });
        }

        document.addEventListener('keydown', function(evento) {
            if (evento.key === 'Escape') {
                fecharModalAvaliacao();
            }
        });

        // TROCAR ENTRE AS ABAS
        const botoesAbas = document.querySelectorAll('.obra-aba');
        const conteudosAbas = document.querySelectorAll('.obra-conteudo-aba');

        botoesAbas.forEach(function(botao) {
            botao.addEventListener('click', function() {
                const nomeAba = botao.dataset.aba;

                botoesAbas.forEach(function(outroBotao) {
                    outroBotao.classList.remove('ativa');
                });

                conteudosAbas.forEach(function(conteudo) {
                    conteudo.classList.remove('ativa');
                });

                botao.classList.add('ativa');

                const conteudoSelecionado = document.getElementById('aba-' + nomeAba);

                if (conteudoSelecionado) {
                    conteudoSelecionado.classList.add('ativa');
                }
            });
        });
    </script>

</body>

</html>