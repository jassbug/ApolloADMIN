<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

$generoId = $_GET['genero'] ?? '';

// Validar o ID do gênero
if (!ctype_digit((string) $generoId) || (int) $generoId <= 0) {
    header('Location: /Generos.php');
    exit;
}

$conexao = conectarBanco();

// Buscar o gênero selecionado
$sqlGenero = "
    SELECT id, nome
    FROM generos
    WHERE id = :id
      AND ativo = 1
";

$consultaGenero = $conexao->prepare($sqlGenero);
$consultaGenero->execute([
    ':id' => (int) $generoId
]);

$generoSelecionado = $consultaGenero->fetch();

// Se o gênero não existir, voltar para a página de gêneros
if (!$generoSelecionado) {
    header('Location: /Generos.php');
    exit;
}

// Buscar as obras desse gênero
$obras = buscarObrasCatalogo([
    'genero' => $generoId
]);

// Filtrar a lista de obras por tipo
$filmes = [];
$series = [];
$animes = [];

foreach ($obras as $obra) {
    $tipo = mb_strtolower(trim($obra['tipo']));

    if ($tipo === 'filme') {
        $filmes[] = $obra;
    } elseif ($tipo === 'série' || $tipo === 'serie') {
        $series[] = $obra;
    } elseif ($tipo === 'anime') {
        $animes[] = $obra;
    }
}

// Preparar o nome do gênero para exibição
$nomeGenero = $generoSelecionado['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($nomeGenero) ?> | Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/catalogo.css">
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>

<main class="catalogo-pagina">
    <div class="catalogo-container">

        <header class="catalogo-cabecalho">
            <span class="catalogo-etiqueta">
                <i class="bi bi-collection-play"></i>
                EXPLORE POR GÊNERO
            </span>

            <h1 class="catalogo-titulo">
                <?= e($nomeGenero) ?>
            </h1>

            <p class="catalogo-descricao">
                Explore filmes, séries e animes do gênero
                <?= e($nomeGenero) ?> disponíveis no Apollo.
            </p>
        </header>

        <section class="catalogo-resultados">

            <h2 class="catalogo-subtitulo">
                Obras de <?= e($nomeGenero) ?>
            </h2>

            <p class="catalogo-contagem">
                <?= count($obras) ?>
                <?= count($obras) === 1 ? 'obra encontrada' : 'obras encontradas' ?>
            </p>

            <?php if (empty($obras)): ?>

                <div class="catalogo-vazio">
                    <i class="bi bi-film"></i>

                    <h3>Nenhuma obra encontrada</h3>

                    <p>
                        Ainda não há obras cadastradas para este gênero.
                    </p>

                    <a href="/Generos.php" class="catalogo-botao-voltar">
                        <i class="bi bi-arrow-left"></i>
                        Voltar aos gêneros
                    </a>
                </div>

            <?php else: ?>

                <?php
                $grupos = [
                    'Filmes' => $filmes,
                    'Séries' => $series,
                    'Animes' => $animes
                ];
                ?>

                <?php foreach ($grupos as $nomeGrupo => $obrasGrupo): ?>

                    <?php if (!empty($obrasGrupo)): ?>

                        <div class="genero-grupo">

                            <h3 class="genero-grupo-titulo">
                                <?= e($nomeGrupo) ?>
                                <span><?= count($obrasGrupo) ?></span>
                            </h3>

                            <div class="catalogo-grade">

                                <?php foreach ($obrasGrupo as $obra): ?>

                                    <article class="catalogo-card">

                                        <div class="catalogo-card-capa">

                                            <?php if (!empty($obra['capa'])): ?>

                                                <img
                                                    src="<?= e($obra['capa']) ?>"
                                                    alt="Capa de <?= e($obra['titulo']) ?>"
                                                    loading="lazy"
                                                >

                                            <?php else: ?>

                                                <div class="catalogo-sem-capa">
                                                    <i class="bi bi-image"></i>
                                                    <span>Sem capa</span>
                                                </div>

                                            <?php endif; ?>

                                            <?php if (!empty($obra['em_alta'])): ?>
                                                <span class="catalogo-selo">
                                                    <i class="bi bi-fire"></i>
                                                    Em alta
                                                </span>
                                            <?php endif; ?>

                                        </div>

                                        <div class="catalogo-card-info">

                                            <span class="catalogo-card-tipo">
                                                <?= e($obra['tipo']) ?>
                                            </span>

                                            <h4 class="catalogo-card-titulo">
                                                <?= e($obra['titulo']) ?>
                                            </h4>

                                            <div class="catalogo-card-detalhes">

                                                <?php if (!empty($obra['ano_lancamento'])): ?>
                                                    <span>
                                                        <?= e($obra['ano_lancamento']) ?>
                                                    </span>
                                                <?php endif; ?>

                                                <?php if (!empty($obra['classificacao'])): ?>
                                                    <span class="catalogo-classificacao">
                                                        <?= e($obra['classificacao']) ?>
                                                    </span>
                                                <?php endif; ?>

                                            </div>

                                            <?php if (!empty($obra['generos'])): ?>

                                                <div class="catalogo-card-generos">

                                                    <?php foreach ($obra['generos'] as $generoObra): ?>

                                                        <span class="catalogo-genero-tag">
                                                            <?= e($generoObra['nome']) ?>
                                                        </span>

                                                    <?php endforeach; ?>

                                                </div>

                                            <?php endif; ?>

                                        </div>

                                    </article>

                                <?php endforeach; ?>

                            </div>
                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php endif; ?>

        </section>

        <a href="/Generos.php" class="catalogo-botao-voltar">
            <i class="bi bi-arrow-left"></i>
            Ver todos os gêneros
        </a>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```