<?php require_once "config.php"; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>
            Novo usuário | BLinks 
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
                        Cadastrar usuário
                    </h1>
                    <p>
                        O cadastro de contas é exclusivo do administrador.
                    </p>
                </div>
            </div>
            <div class="painel">
                <form action="usuario_cadastrarbd.php" method="post" enctype="multipart/form-data" class="formulario">
                    <div class="linha-form">
                        <div class="campo grande">
                            <label>
                                Nome completo *
                            </label>
                            <input type="text" name="nome" required>
                        </div>
                        <div class="campo">
                            <label>
                                Perfil *
                            </label>
                            <select name="perfil">
                                <option value="usuario">
                                    Usuário
                                </option>
                                <option value="admin">
                                    Administrador
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="campo">
                        <label>
                            Usuário *
                        </label>
                        <input type="text" name="usuario" required>
                    </div>
                    <div class="linha-form">
                        <div class="campo">
                            <label>
                                Senha *
                            </label>
                            <input type="password" name="senha" minlength="6" required>
                        </div>
                        <div class="campo">
                            <label>
                                Foto
                            </label>
                            <input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
                        </div>
                    </div>
                    <div class="acoes-form">
                        <button class="botao" type="submit">
                            CADASTRAR
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
