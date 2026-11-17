<?php
require_once __DIR__ . "/config.php";
?>
<header class="topo">
    <div class="marca">
        <img src="img/logo/logo.png" alt="Logo Weboteca" class="logo-site">
        <div>
            <strong>BLinks</strong>
            <small>Catálogo de sites favoritos</small>
        </div>
    </div>
    <nav class="menu">
        <a href="favoritos.php">Favoritos</a>
        <a href="cadastrar.php">Novo site</a>
        <?php
if ($_SESSION["usuario"]["perfil"] === "admin"):
?>
            <a href="usuarios.php">Usuários</a>
        <?php
endif;
?>
        <a href="perfil.php">Meu perfil</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>
