<?php
// DADOS DO BANCO
$host = 'mysql';
$banco = 'pi_apollo';
$usuario = 'apollo_app';
$senha = '123456';
function conectarBanco(){
    global $host, $banco, $usuario, $senha;

    static $conexao = null;

    if ($conexao === null) {
        $dsn = "mysql:host=$host;port=3306;dbname=$banco;charset=utf8mb4";

        $conexao = new PDO(
            $dsn,
            $usuario,
            $senha,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    return $conexao;
}

// Protege textos que vêm do banco antes de aparecerem na tela.
function e($texto)
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

// Busca os itens do carrossel de avisos.
function buscarAvisos()
{
    $conexao = conectarBanco();

    $sql = "
        SELECT id, titulo, descricao, imagem, link
        FROM avisos
        WHERE ativo = 1
        ORDER BY id DESC
    ";

    $consulta = $conexao->query($sql);

    return $consulta->fetchAll();
}

// Busca até quatro obras marcadas como “Em alta”.
function buscarObrasEmAlta()
{
    $conexao = conectarBanco();

    $sql = "
        SELECT id, titulo, tipo, capa
        FROM obras
        WHERE em_alta = 1
          AND ativo = 1
        ORDER BY id DESC
        LIMIT 4
    ";

    $consulta = $conexao->query($sql);

    return $consulta->fetchAll();
}

// Busca até quatro obras marcadas como lançamento.
function buscarLancamentos()
{
    $conexao = conectarBanco();

    $sql = "
        SELECT id, titulo, tipo, capa
        FROM obras
        WHERE lancamento = 1
          AND ativo = 1
        ORDER BY id DESC
        LIMIT 4
    ";

    $consulta = $conexao->query($sql);

    return $consulta->fetchAll();
}

// Busca os gêneros cadastrados.
function buscarGeneros()
{
    $conexao = conectarBanco();

    $sql = "
        SELECT id, nome
        FROM generos
        WHERE ativo = 1
        ORDER BY nome ASC
    ";

    $consulta = $conexao->query($sql);

    return $consulta->fetchAll();
}

// ============================================================
// FUNÇÕES DO ADMINISTRADOR
// ============================================================

/**
 * Retorna a quantidade total de usuários cadastrados.
 */
function contarUsuarios()
{
    $conexao = conectarBanco();

    $consulta = $conexao->query("
        SELECT COUNT(*) 
        FROM usuarios
    ");

    return (int) $consulta->fetchColumn();
}


/**
 * Retorna a quantidade total de obras cadastradas.
 */
function contarObras()
{
    $conexao = conectarBanco();

    $consulta = $conexao->query("
        SELECT COUNT(*)
        FROM obras
    ");

    return (int) $consulta->fetchColumn();
}


/**
 * Retorna a quantidade total de gêneros cadastrados.
 */
function contarGeneros()
{
    $conexao = conectarBanco();

    $consulta = $conexao->query("
        SELECT COUNT(*)
        FROM generos
    ");

    return (int) $consulta->fetchColumn();
}


/**
 * Retorna a quantidade total de avisos cadastrados.
 */
function contarAvisos()
{
    $conexao = conectarBanco();

    $consulta = $conexao->query("
        SELECT COUNT(*)
        FROM avisos
    ");

    return (int) $consulta->fetchColumn();
}


// ============================================================
// FUNÇÕES DE OBRAS - ADMINISTRADOR
// ============================================================

/**
 * Busca todas as obras cadastradas.
 */
function buscarTodasObras()
{
    $conexao = conectarBanco();

    $sql = "
        SELECT
            o.id,
            o.titulo,
            o.descricao,
            o.tipo,
            o.ano_lancamento,
            o.classificacao,
            o.duracao,
            o.estudio,
            o.capa,
            o.em_alta,
            o.lancamento,
            o.ativo
        FROM obras o
        ORDER BY o.id DESC
    ";

    $consulta = $conexao->query($sql);

    $obras = $consulta->fetchAll();

    foreach ($obras as &$obra) {

        $sqlGeneros = "
            SELECT
                g.id,
                g.nome
            FROM generos g
            INNER JOIN obra_genero og
                ON og.genero_id = g.id
            WHERE og.obra_id = :obra_id
            ORDER BY g.nome ASC
        ";

        $consultaGeneros = $conexao->prepare($sqlGeneros);

        $consultaGeneros->execute([
            ':obra_id' => $obra['id']
        ]);

        $obra['generos'] = $consultaGeneros->fetchAll();
    }

    unset($obra);

    return $obras;
}

/**
 * Busca uma obra pelo ID.
 */
function buscarObraPorId($id)
{
    $conexao = conectarBanco();

    $consulta = $conexao->prepare("
        SELECT
            id,
            titulo,
            descricao,
            tipo,
            ano_lancamento,
            classificacao,
            duracao,
            estudio,
            capa,
            em_alta,
            lancamento,
            ativo,
            data_criacao
        FROM obras
        WHERE id = :id
    ");

    $consulta->execute([
        ':id' => $id
    ]);

    $obra = $consulta->fetch();

    if (!$obra) {
        return null;
    }

    $consultaGeneros = $conexao->prepare("
        SELECT genero_id
        FROM obra_genero
        WHERE obra_id = :obra_id
    ");

    $consultaGeneros->execute([
        ':obra_id' => $id
    ]);

    $obra['generos'] = $consultaGeneros->fetchAll(PDO::FETCH_COLUMN);

    return $obra;
}


/**
 * Cadastra uma nova obra.
 */
function cadastrarObra(
    $titulo,
    $descricao,
    $tipo,
    $anoLancamento,
    $classificacao,
    $duracao,
    $estudio,
    $capa,
    $generos,
    $emAlta,
    $lancamento
) {
    $titulo = trim($titulo);
    $descricao = trim($descricao);
    $tipo = trim($tipo);
    $anoLancamento = trim($anoLancamento);
    $classificacao = trim($classificacao);
    $duracao = trim($duracao);
    $estudio = trim($estudio);
    $capa = trim($capa);

    if (
        empty($titulo) ||
        empty($descricao) ||
        empty($tipo) ||
        empty($anoLancamento) ||
        empty($classificacao) ||
        empty($duracao) ||
        empty($estudio) ||
        empty($capa)
    ) {
        return [
            'sucesso' => false,
            'mensagem' => 'Preencha todos os campos obrigatórios.'
        ];
    }

    if (!is_numeric($anoLancamento)) {
        return [
            'sucesso' => false,
            'mensagem' => 'Informe um ano de lançamento válido.'
        ];
    }

    $anoLancamento = (int) $anoLancamento;

    if ($anoLancamento < 1800 || $anoLancamento > date('Y')) {
        return [
            'sucesso' => false,
            'mensagem' => 'Informe um ano de lançamento válido.'
        ];
    }

    if (!is_array($generos)) {
        $generos = [];
    }

    $conexao = conectarBanco();

    try {

        $conexao->beginTransaction();

        /*
         * Insere a obra.
         */
        $consulta = $conexao->prepare("
            INSERT INTO obras (
                titulo,
                descricao,
                tipo,
                ano_lancamento,
                classificacao,
                duracao,
                estudio,
                capa,
                em_alta,
                lancamento,
                ativo
            )
            VALUES (
                :titulo,
                :descricao,
                :tipo,
                :ano_lancamento,
                :classificacao,
                :duracao,
                :estudio,
                :capa,
                :em_alta,
                :lancamento,
                1
            )
        ");

        $consulta->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':tipo' => $tipo,
            ':ano_lancamento' => $anoLancamento,
            ':classificacao' => $classificacao,
            ':duracao' => $duracao,
            ':estudio' => $estudio,
            ':capa' => $capa,
            ':em_alta' => $emAlta ? 1 : 0,
            ':lancamento' => $lancamento ? 1 : 0
        ]);

        $obraId = $conexao->lastInsertId();

        /*
         * Relaciona a obra aos gêneros selecionados.
         */
        if (!empty($generos)) {

            $consultaGenero = $conexao->prepare("
                INSERT INTO obra_genero (
                    obra_id,
                    genero_id
                )
                VALUES (
                    :obra_id,
                    :genero_id
                )
            ");

            foreach ($generos as $generoId) {

                $generoId = (int) $generoId;

                if ($generoId <= 0) {
                    continue;
                }

                $consultaGenero->execute([
                    ':obra_id' => $obraId,
                    ':genero_id' => $generoId
                ]);
            }
        }

        $conexao->commit();

        return [
            'sucesso' => true,
            'mensagem' => 'Obra cadastrada com sucesso.'
        ];

    } catch (Throwable $erro) {

        if ($conexao->inTransaction()) {
            $conexao->rollBack();
        }

        return [
            'sucesso' => false,
            'mensagem' => 'Não foi possível cadastrar a obra.'
        ];
    }
}


/**
 * Atualiza uma obra existente.
 */
function atualizarObra(
    $id,
    $titulo,
    $descricao,
    $tipo,
    $anoLancamento,
    $classificacao,
    $duracao,
    $estudio,
    $capa,
    $generos,
    $emAlta,
    $lancamento,
    $ativo
) {
    $id = (int) $id;

    $titulo = trim($titulo);
    $descricao = trim($descricao);
    $tipo = trim($tipo);
    $anoLancamento = trim($anoLancamento);
    $classificacao = trim($classificacao);
    $duracao = trim($duracao);
    $estudio = trim($estudio);
    $capa = trim($capa);

    if ($id <= 0) {
        return [
            'sucesso' => false,
            'mensagem' => 'Obra inválida.'
        ];
    }

    if (
        empty($titulo) ||
        empty($descricao) ||
        empty($tipo) ||
        empty($anoLancamento) ||
        empty($classificacao) ||
        empty($duracao) ||
        empty($estudio) ||
        empty($capa)
    ) {
        return [
            'sucesso' => false,
            'mensagem' => 'Preencha todos os campos obrigatórios.'
        ];
    }

    if (!is_numeric($anoLancamento)) {
        return [
            'sucesso' => false,
            'mensagem' => 'Informe um ano de lançamento válido.'
        ];
    }

    $anoLancamento = (int) $anoLancamento;

    if ($anoLancamento < 1800 || $anoLancamento > date('Y')) {
        return [
            'sucesso' => false,
            'mensagem' => 'Informe um ano de lançamento válido.'
        ];
    }

    if (!is_array($generos)) {
        $generos = [];
    }

    $conexao = conectarBanco();

    try {

        $conexao->beginTransaction();

        /*
         * Atualiza os dados principais.
         */
        $consulta = $conexao->prepare("
            UPDATE obras
            SET
                titulo = :titulo,
                descricao = :descricao,
                tipo = :tipo,
                ano_lancamento = :ano_lancamento,
                classificacao = :classificacao,
                duracao = :duracao,
                estudio = :estudio,
                capa = :capa,
                em_alta = :em_alta,
                lancamento = :lancamento,
                ativo = :ativo
            WHERE id = :id
        ");

        $consulta->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':tipo' => $tipo,
            ':ano_lancamento' => $anoLancamento,
            ':classificacao' => $classificacao,
            ':duracao' => $duracao,
            ':estudio' => $estudio,
            ':capa' => $capa,
            ':em_alta' => $emAlta ? 1 : 0,
            ':lancamento' => $lancamento ? 1 : 0,
            ':ativo' => $ativo ? 1 : 0,
            ':id' => $id
        ]);

        /*
         * Remove os gêneros antigos.
         */
        $removerGeneros = $conexao->prepare("
            DELETE FROM obra_genero
            WHERE obra_id = :obra_id
        ");

        $removerGeneros->execute([
            ':obra_id' => $id
        ]);

        /*
         * Insere novamente os gêneros selecionados.
         */
        if (!empty($generos)) {

            $consultaGenero = $conexao->prepare("
                INSERT INTO obra_genero (
                    obra_id,
                    genero_id
                )
                VALUES (
                    :obra_id,
                    :genero_id
                )
            ");

            foreach ($generos as $generoId) {

                $generoId = (int) $generoId;

                if ($generoId <= 0) {
                    continue;
                }

                $consultaGenero->execute([
                    ':obra_id' => $id,
                    ':genero_id' => $generoId
                ]);
            }
        }

        $conexao->commit();

        return [
            'sucesso' => true,
            'mensagem' => 'Obra atualizada com sucesso.'
        ];

    } catch (Throwable $erro) {

        if ($conexao->inTransaction()) {
            $conexao->rollBack();
        }

        return [
            'sucesso' => false,
            'mensagem' => 'Não foi possível atualizar a obra.'
        ];
    }
}


/**
 * Exclui uma obra.
 */
function excluirObra($id)
{
    $id = (int) $id;

    if ($id <= 0) {
        return [
            'sucesso' => false,
            'mensagem' => 'Obra inválida.'
        ];
    }

    $conexao = conectarBanco();

    $consulta = $conexao->prepare("
        DELETE FROM obras
        WHERE id = :id
    ");

    $consulta->execute([
        ':id' => $id
    ]);

    if ($consulta->rowCount() === 0) {
        return [
            'sucesso' => false,
            'mensagem' => 'Obra não encontrada.'
        ];
    }

    return [
        'sucesso' => true,
        'mensagem' => 'Obra excluída com sucesso.'
    ];
}


/**
 * Altera o status de uma obra.
 */
function alterarStatusObra($id, $ativo)
{
    $id = (int) $id;

    $conexao = conectarBanco();

    $consulta = $conexao->prepare("
        UPDATE obras
        SET ativo = :ativo
        WHERE id = :id
    ");

    $consulta->execute([
        ':ativo' => $ativo ? 1 : 0,
        ':id' => $id
    ]);

    return [
        'sucesso' => true,
        'mensagem' => $ativo
            ? 'Obra ativada com sucesso.'
            : 'Obra desativada com sucesso.'
    ];
}

// ============================================================
// GÊNEROS
// ============================================================

function buscarTodosGeneros()
{
    $conexao = conectarBanco();

    $sql = "
        SELECT id, nome, ativo
        FROM generos
        ORDER BY nome ASC
    ";

    $consulta = $conexao->query($sql);

    return $consulta->fetchAll();
}


function buscarGeneroPorId($id)
{
    $conexao = conectarBanco();

    $consulta = $conexao->prepare("
        SELECT id, nome, ativo
        FROM generos
        WHERE id = :id
    ");

    $consulta->execute([
        ':id' => $id
    ]);

    return $consulta->fetch();
}


function cadastrarGenero($nome)
{
    $nome = trim($nome);

    if (empty($nome)) {
        return [
            'sucesso' => false,
            'mensagem' => 'Digite o nome do gênero.'
        ];
    }

    $conexao = conectarBanco();

    // Verifica se já existe
    $verificar = $conexao->prepare("
        SELECT id
        FROM generos
        WHERE nome = :nome
    ");

    $verificar->execute([
        ':nome' => $nome
    ]);

    if ($verificar->fetch()) {
        return [
            'sucesso' => false,
            'mensagem' => 'Este gênero já está cadastrado.'
        ];
    }

    $consulta = $conexao->prepare("
        INSERT INTO generos (nome, ativo)
        VALUES (:nome, 1)
    ");

    $consulta->execute([
        ':nome' => $nome
    ]);

    return [
        'sucesso' => true,
        'mensagem' => 'Gênero cadastrado com sucesso.'
    ];
}


function atualizarGenero($id, $nome)
{
    $nome = trim($nome);

    if (empty($nome)) {
        return [
            'sucesso' => false,
            'mensagem' => 'Digite o nome do gênero.'
        ];
    }

    $conexao = conectarBanco();

    // Verifica se outro gênero já possui esse nome
    $verificar = $conexao->prepare("
        SELECT id
        FROM generos
        WHERE nome = :nome
        AND id != :id
    ");

    $verificar->execute([
        ':nome' => $nome,
        ':id' => $id
    ]);

    if ($verificar->fetch()) {
        return [
            'sucesso' => false,
            'mensagem' => 'Já existe outro gênero com esse nome.'
        ];
    }

    $consulta = $conexao->prepare("
        UPDATE generos
        SET nome = :nome
        WHERE id = :id
    ");

    $consulta->execute([
        ':nome' => $nome,
        ':id' => $id
    ]);

    return [
        'sucesso' => true,
        'mensagem' => 'Gênero atualizado com sucesso.'
    ];
}


function alterarStatusGenero($id)
{
    $conexao = conectarBanco();

    $consulta = $conexao->prepare("
        UPDATE generos
        SET ativo = NOT ativo
        WHERE id = :id
    ");

    $consulta->execute([
        ':id' => $id
    ]);

    return [
        'sucesso' => true,
        'mensagem' => 'Status do gênero atualizado.'
    ];
}


function excluirGenero($id)
{
    $conexao = conectarBanco();

    try {

        $consulta = $conexao->prepare("
            DELETE FROM generos
            WHERE id = :id
        ");

        $consulta->execute([
            ':id' => $id
        ]);

        return [
            'sucesso' => true,
            'mensagem' => 'Gênero excluído com sucesso.'
        ];

    } catch (PDOException $erro) {

        return [
            'sucesso' => false,
            'mensagem' => 'Não foi possível excluir este gênero.'
        ];
    }
}



