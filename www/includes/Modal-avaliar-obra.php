<div class="modal-avaliar-fundo" id="modal-avaliar-obra">

    <div
        class="modal-avaliar-caixa"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-avaliar-titulo"
    >

        <!-- BOTÃO FECHAR -->
        <button
            type="button"
            class="modal-avaliar-fechar"
            id="fechar-modal-avaliar"
            aria-label="Fechar"
        >
            &times;
        </button>

        <!-- TÍTULO -->
        <h2 id="modal-avaliar-titulo">
            <?= $comentarioUsuario ? 'Editar comentário' : 'Avaliar obra' ?>
        </h2>

        <!-- FORMULÁRIO DE AVALIAÇÃO E COMENTÁRIO -->
        <form action="/avaliarObra.php" method="POST">

            <input
                type="hidden"
                name="obra_id"
                value="<?= (int) $obra['id'] ?>"
            >

            <!-- NOTA -->
            <div class="modal-avaliar-nota">

                <label for="nota-obra">Dê sua nota</label>

                <select
                    name="nota"
                    id="nota-obra"
                    required
                >
                    <option value="">Dar uma nota de 1 a 10</option>

                    <?php for ($nota = 1; $nota <= 10; $nota++): ?>

                        <option
                            value="<?= $nota ?>"
                            <?= isset($avaliacaoUsuario) && $avaliacaoUsuario === $nota ? 'selected' : '' ?>
                        >
                            <?= $nota ?>
                        </option>

                    <?php endfor; ?>

                </select>

            </div>

            <!-- COMENTÁRIO -->
            <div class="modal-avaliar-comentario">

                <label
                    for="comentario-obra"
                    class="visualmente-oculto"
                >
                    Escrever comentário
                </label>

                <textarea
                    name="comentario"
                    id="comentario-obra"
                    placeholder="Escrever comentário"
                    maxlength="2000"
                ><?= e($comentarioUsuario['comentario'] ?? '') ?></textarea>

            </div>

            <!-- SALVAR -->
            <button
                type="submit"
                class="modal-avaliar-salvar"
            >
                <?= $comentarioUsuario ? 'Salvar alterações' : 'Salvar' ?>
            </button>

        </form>

        <!-- EXCLUIR COMENTÁRIO -->
        <?php if ($comentarioUsuario): ?>

            <form
                action="/curtirComentario.php"
                method="POST"
                onsubmit="return confirm('Tem certeza de que deseja excluir seu comentário?');"
            >

                <input
                    type="hidden"
                    name="acao"
                    value="excluir"
                >

                <input
                    type="hidden"
                    name="obra_id"
                    value="<?= (int) $obra['id'] ?>"
                >

                <button
                    type="submit"
                    class="modal-avaliar-excluir"
                >
                    <i class="bi bi-trash"></i>
                    Excluir comentário
                </button>

            </form>

        <?php endif; ?>

    </div>

</div>