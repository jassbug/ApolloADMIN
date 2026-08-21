<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adicionar Aviso - Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="../css/styles.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<header>

    <?php include '../menu.php'; ?>

</header>

<main class="container py-4">

    <div class="adicionar-aviso-box">

        <!-- Título -->

        <div class="titulo-adicionar-aviso">

            <i class="bi bi-list"></i>

            <h3>

                Adicionar avisos

            </h3>

        </div>


        <form>

            <!-- Título do aviso -->

            <div class="mb-3">

                <label class="form-label">

                    Título

                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Digite o título do aviso">

            </div>


            <!-- Imagem -->

            <div class="mb-3">

                <label class="form-label">

                    Imagem

                </label>

                <label class="upload-aviso">

                    <i class="bi bi-cloud-arrow-up"></i>

                    <span>

                        Upload de imagem

                    </span>

                    <input
                        type="file"
                        accept="image/*"
                        hidden>

                </label>

            </div>


            <!-- Link -->

            <div class="mb-3">

                <label class="form-label">

                    Link

                </label>

                <input
                    type="url"
                    class="form-control"
                    placeholder="Digite o link do aviso">

            </div>


            <!-- Datas -->

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">

                        Data de início

                    </label>

                    <input
                        type="date"
                        class="form-control">

                </div>


                <div class="col-md-6">

                    <label class="form-label">

                        Data de fim

                    </label>

                    <input
                        type="date"
                        class="form-control">

                </div>

            </div>


            <!-- Botões -->

            <div class="botoes-aviso">

                <a
                    href="GerenciarAvisos.php"
                    class="btn btn-secondary">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Salvar

                </button>

            </div>

        </form>

    </div>

</main>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>