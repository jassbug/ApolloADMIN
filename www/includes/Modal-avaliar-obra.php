```php
<div class="modal-avaliar-fundo" id="modal-avaliar-obra">

    <div
        class="modal-avaliar-caixa"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-avaliar-titulo"
    >

        <button
            type="button"
            class="modal-avaliar-fechar"
            id="fechar-modal-avaliar"
            aria-label="Fechar"
        >
            &times;
        </button>

        <h2 id="modal-avaliar-titulo">Avaliar obra</h2>

        <form action="/avaliarObra.php" method="POST">

            <input
                type="hidden"
                name="obra_id"
                value="<?= (int) $obra['id'] ?>"
            >

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

            <div class="modal-avaliar-comentario">

                <label for="comentario-obra" class="visualmente-oculto">
                    Escrever comentário
                </label>

                <textarea
                    name="comentario"
                    id="comentario-obra"
                    placeholder="Escrever comentário"
                    maxlength="2000"
                ></textarea>

            </div>

            <button type="submit" class="modal-avaliar-salvar">
                Salvar
            </button>

        </form>

    </div>

</div>
```