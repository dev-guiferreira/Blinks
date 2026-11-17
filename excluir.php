<?php require_once "config.php"; exigirLogin(); require_once "_conexao.php"; $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT); $stmt = $conexao->prepare("SELECT * FROM sites_favoritos WHERE id=:id AND usuario_id=:usuario_id"); $stmt->execute([":id"=>$id,":usuario_id"=>$_SESSION["usuario"]["id"]]); $site = $stmt->fetch(); if (!$site) redirecionar("favoritos.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>
            Excluir | BLinks 
        </title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require "_menu.php"; ?>
        <main class="container estreito">
            <div class="painel confirmacao">
                <span class="alerta-icone">
                    !
                </span>
                <h1>
                    Excluir site?
                </h1>
                <p>
                    Você está prestes a excluir
                    <strong>
                        <?= e($site["nome"]) ?>
                    </strong>
                    . Esta ação não poderá ser desfeita.
                </p>
                <form action="excluirbd.php" method="post">
                    <input type="hidden" name="id" value="<?= $site["id"] ?>">
                    <button class="botao perigo" type="submit">
                        SIM, EXCLUIR
                    </button>
                    <a class="botao cinza" href="favoritos.php">
                        CANCELAR
                    </a>
                </form>
            </div>
        </main>
    </body>
</html>
