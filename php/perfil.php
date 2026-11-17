<?php require_once "config.php"; exigirLogin(); require_once "_conexao.php"; $stmt=$conexao->prepare("SELECT * FROM usuarios WHERE id=:id"); $stmt->execute([":id"=>$_SESSION["usuario"]["id"]]); $u=$stmt->fetch(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>
            Meu perfil | BLinks 
        </title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require "_menu.php"; ?>
        <main class="container estreito">
            <div class="titulo-pagina">
                <div>
                    <span class="etiqueta">
                        PERFIL
                    </span>
                    <h1>
                        Minha conta
                    </h1>
                    <p>
                        Informações do usuário atualmente conectado.
                    </p>
                </div>
            </div>
            <div class="painel perfil-card">
                <?php if($u["foto"]): ?>
                    <img class="avatar-grande" src="uploads/usuarios/<?= e($u["foto"]) ?>" alt="Foto de perfil">
                <?php else: ?>
                    <div class="avatar-grande avatar-vazio">
                        W
                    </div>
                <?php endif; ?>
                <h2>
                    <?= e($u["nome"]) ?>
                </h2>
                <p>
                    <strong>
                        Usuário:
                    </strong>
                    <?= e($u["usuario"]) ?>
                </p>
                <p>
                    <strong>
                        Perfil:
                    </strong>
                    <span class="badge">
                        <?= e($u["perfil"]) ?>
                    </span>
                </p>
                <p>
                    <strong>
                        Cadastro:
                    </strong>
                    <?= date("d/m/Y H:i",strtotime($u["data_cadastro"])) ?>
                </p>
            </div>
        </main>
    </body>
</html>
