<?php require_once "config.php"; exigirAdmin(); require_once "_conexao.php"; $id=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT); $stmt=$conexao->prepare("SELECT * FROM usuarios WHERE id=:id"); $stmt->execute([":id"=>$id]); $u=$stmt->fetch(); if(!$u) redirecionar("usuarios.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>
            Editar usuário | BLinks 
        </title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require "_menu.php"; ?>
        <main class="container estreito">
            <div class="titulo-pagina">
                <div>
                    <span class="etiqueta">
                        ADMINISTRADOR
                    </span>
                    <h1>
                        Editar usuário
                    </h1>
                </div>
            </div>
            <div class="painel">
                <form action="usuario_atualizarbd.php" method="post" enctype="multipart/form-data" class="formulario">
                    <input type="hidden" name="id" value="<?= $u["id"] ?>">
                    <div class="linha-form">
                        <div class="campo grande">
                            <label>
                                Nome
                            </label>
                            <input type="text" name="nome" value="<?= e($u["nome"]) ?>" required>
                        </div>
                        <div class="campo">
                            <label>
                                Perfil
                            </label>
                            <select name="perfil">
                                <option value="usuario" <?= $u["perfil"]==="usuario"?"selected":"" ?>>
                                    Usuário
                                </option>
                                <option value="admin" <?= $u["perfil"]==="admin"?"selected":"" ?>>
                                    Administrador
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="campo">
                        <label>
                            Usuário
                        </label>
                        <input type="text" name="usuario" value="<?= e($u["usuario"]) ?>" required>
                    </div>
                    <div class="campo">
                        <label>
                            Nova senha (deixe vazio para manter)
                        </label>
                        <input type="password" name="senha">
                    </div>
                    <div class="campo">
                        <label>
                            Nova foto
                        </label>
                        <input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
                    </div>
                    <div class="campo">
                        <label>
                            Status
                        </label>
                        <select name="ativo">
                            <option value="1" <?= $u["ativo"]?"selected":"" ?>>
                                Ativo
                            </option>
                            <option value="0" <?= !$u["ativo"]?"selected":"" ?>>
                                Inativo
                            </option>
                        </select>
                    </div>
                    <div class="acoes-form">
                        <button class="botao" type="submit">
                            ATUALIZAR
                        </button>
                        <a class="botao cinza" href="usuarios.php">
                            VOLTAR
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
