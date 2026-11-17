<?php require_once "config.php"; exigirLogin(); require_once "_conexao.php"; $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT); $stmt = $conexao->prepare("SELECT * FROM sites_favoritos WHERE id = :id AND usuario_id = :usuario_id"); $stmt->execute([":id"=>$id,":usuario_id"=>$_SESSION["usuario"]["id"]]); $site = $stmt->fetch(); if (!$site) redirecionar("favoritos.php"); ?>
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
                        EDIÇÃO
                    </span>
                    <h1>
                        Atualizar site favorito
                    </h1>
                    <p>
                        Altere os dados necessários e salve novamente.
                    </p>
                </div>
            </div>
            <div class="painel">
                <form action="atualizarbd.php" method="post" enctype="multipart/form-data" class="formulario">
                    <input type="hidden" name="id" value="<?= $site["id"] ?>">
                    <div class="linha-form">
                        <div class="campo grande">
                            <label>
                                Nome *
                            </label>
                            <input type="text" name="nome" value="<?= e($site["nome"]) ?>" required>
                        </div>
                        <div class="campo">
                            <label>
                                Categoria *
                            </label>
                            <input type="text" name="categoria" value="<?= e($site["categoria"]) ?>" required>
                        </div>
                    </div>
                    <div class="campo">
                        <label>
                            URL *
                        </label>
                        <input type="url" name="url" value="<?= e($site["url"]) ?>" required>
                    </div>
                    <div class="campo">
                        <label>
                            Descrição *
                        </label>
                        <textarea name="descricao" rows="5" required>
                            <?= e($site["descricao"]) ?>
                        </textarea>
                    </div>
                    <div class="campo">
                        <label>
                            Substituir foto
                        </label>
                        <input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
                    </div>
                    <div class="acoes-form">
                        <button class="botao" type="submit">
                            ATUALIZAR
                        </button>
                        <a class="botao cinza" href="favoritos.php">
                            VOLTAR
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
