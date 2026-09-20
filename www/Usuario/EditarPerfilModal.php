<div
    class="modal fade modal-apollo"
    id="modalEditarPerfil"
    tabindex="-1"
    aria-labelledby="tituloEditarPerfil"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <p class="etiqueta-autenticacao">
                        <i class="bi bi-pencil-square"></i> MINHA CONTA
                    </p>

                    <h2 class="modal-title" id="tituloEditarPerfil">
                        Editar perfil
                    </h2>
                </div>

                <button
                    type="button"
                    class="botao-fechar-modal"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">

                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form action="atualizar_perfil.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="campo-formulario">
                        <label for="nome">Nome</label>

                        <div>
                            <i class="bi bi-person"></i>
                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                value="<?= e($usuario['nome']) ?>"
                                required>
                        </div>
                    </div>

                    <div class="campo-formulario">
                        <label for="email">E-mail</label>

                        <div>
                            <i class="bi bi-envelope"></i>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?= e($usuario['email']) ?>"
                                required>
                        </div>
                    </div>

                    <div class="campo-formulario">
                        <label for="bio">Biografia</label>

                        <textarea
                            id="bio"
                            name="bio"
                            maxlength="255"
                            placeholder="Conte um pouco sobre você..."><?= e($usuario['bio']) ?></textarea>
                    </div>

                    <div class="campo-formulario">
                        <label for="foto">Foto de perfil</label>

                        <div>
                            <i class="bi bi-image"></i>

                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                accept=".jpg,.jpeg,.png,.webp">

                        </div>

                        <small class="texto-ajuda">
                            Envie uma imagem JPG, PNG ou WEBP de até 2 MB.
                        </small>
                    </div>
                    

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn botao-cancelar"
                        data-bs-dismiss="modal">

                        Cancelar
                    </button>

                    <button type="submit" class="btn botao-roxo">
                        Salvar alterações
                        <i class="bi bi-check-lg"></i>
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>