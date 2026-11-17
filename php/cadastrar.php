<?php require_once "config.php"; exigirLogin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
           BLinks | Catágolo de Sites
        </title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require "_menu.php"; ?>
        <main class="container estreito">
            <div class="titulo-pagina">
                <div>
                    <span class="etiqueta">
                        CADASTRO
                    </span>
                    <h1>
                        Novo site favorito
                    </h1>
                    <p>
                        Preencha as informações do site que deseja guardar.
                    </p>
                </div>
            </div>
            <div class="painel">
                <form action="cadastrarbd.php" method="post" enctype="multipart/form-data" class="formulario">
                    <div class="linha-form">
                        <div class="campo grande">
                            <label>
                                Nome *
                            </label>
                            <input type="text" name="nome" maxlength="150" required>
                        </div>
                        <div class="campo">
                            <label>
                                Categoria *
                            </label>
                            <input type="text" name="categoria" maxlength="80" placeholder="Ex.: Estudos" required>
                        </div>
                    </div>
                    <div class="campo">
                        <label>
                            URL *
                        </label>
                        <input type="url" name="url" maxlength="255" placeholder="https://exemplo.com" required>
                    </div>
                    <div class="campo">
                        <label>
                            Descrição *
                        </label>
                        <textarea name="descricao" rows="5" maxlength="500" required>
                        </textarea>
                    </div>
                    <div class="campo">
                        <label>
                            Foto do site
                        </label>
                        <input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
                    </div>
                    <p class="ajuda">
                        A data de cadastro é registrada automaticamente pelo sistema.
                    </p>
                    <div class="acoes-form">
                        <button class="botao" type="submit">
                            SALVAR SITE
                        </button>
                        <a class="botao cinza" href="favoritos.php">
                            CANCELAR
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
