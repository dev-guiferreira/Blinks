<?php require_once "config.php"; if (usuarioLogado()) { redirecionar("favoritos.php"); } $erro = $_GET["erro"] ?? ""; ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Login | BLinks
        </title>
        <link rel="stylesheet" href="css/estilo.css">

    </head>
    <body class="pagina-login">
        <div class="login-caixa">
            <div class="login-cabecalho">
                <div class="brasao">
                    <img src="img/logo/logo.png" alt="Logo Weboteca" class="logo-site">
                </div>
                <h1>
                    WEBOTECA CLÁSSICA
                </h1>
                <p>
                    Cadastro e consulta de sites favoritos
                </p>
            </div>
            <?php if ($erro === "login"): ?>
                <div class="alerta erro">
                    Usuário ou senha inválidos.
                </div>
            <?php endif; ?>
            <?php if ($erro === "sessao"): ?>
                <div class="alerta erro">
                    Faça login para continuar.
                </div>
            <?php endif; ?>
            <form action="login.php" method="post" class="formulario">
                <label for="usuario">
                    USUÁRIO
                </label>
                <input type="text" id="usuario" name="usuario" required autofocus>
                <label for="senha">
                    SENHA
                </label>
                <input type="password" id="senha" name="senha" required>
                <button type="submit" class="botao">
                    ENTRAR
                </button>
            </form>
            
            <footer>
                &copy Blinks - Todos Os Direitos Reservados 2026
            </footer>
        </div>
    </body>
</html>
