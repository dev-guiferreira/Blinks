<?php require_once "config.php"; exigirLogin(); require_once "_conexao.php"; $busca = trim($_GET["busca"] ?? ""); $categoria = trim($_GET["categoria"] ?? ""); $sql = "SELECT s.*, u.nome AS dono FROM sites_favoritos s INNER JOIN usuarios u ON u.id = s.usuario_id WHERE s.usuario_id = :usuario_id"; $params = [":usuario_id" => $_SESSION["usuario"]["id"]]; if ($busca !== "") { $sql .= " AND (s.nome LIKE :busca OR s.descricao LIKE :busca OR s.url LIKE :busca)"; $params[":busca"] = "%".$busca."%"; } if ($categoria !== "") { $sql .= " AND s.categoria = :categoria"; $params[":categoria"] = $categoria; } $sql .= " ORDER BY s.data_cadastro DESC, s.id DESC"; $stmt = $conexao->prepare($sql); $stmt->execute($params); $sites = $stmt->fetchAll(); $categorias = $conexao->query("SELECT DISTINCT categoria FROM sites_favoritos WHERE usuario_id = ".$conexao->quote($_SESSION["usuario"]["id"])." ORDER BY categoria")->fetchAll(PDO::FETCH_COLUMN); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Favoritos | BLinks
        </title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require "_menu.php"; ?>
        <main class="container">
            <div class="titulo-pagina">
                <div>
                    <span class="etiqueta">
                        CATÁLOGO
                    </span>
                    <h1>
                        Meus sites favoritos
                    </h1>
                    <p>
                        Consulte, altere ou remova seus sites cadastrados.
                    </p>
                </div>
                <a class="botao" href="cadastrar.php">
                    + CADASTRAR SITE
                </a>
            </div>
            <?php if (isset($_GET["ok"])): ?>
                <div class="alerta sucesso">
                    Operação realizada com sucesso.
                </div>
            <?php endif; ?>
            <?php if (isset($_GET["erro"]) && $_GET["erro"] === "permissao"): ?>
                <div class="alerta erro">
                    Você não possui permissão para esta operação.
                </div>
            <?php endif; ?>
            <section class="painel filtro">
                <form method="get" class="linha-form">
                    <div class="campo">
                        <label>
                            Pesquisar
                        </label>
                        <input type="text" name="busca" value="<?= e($busca) ?>" placeholder="Nome, URL ou descrição">
                    </div>
                    <div class="campo">
                        <label>
                            Categoria
                        </label>
                        <select name="categoria">
                            <option value="">
                                Todas
                            </option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= e($cat) ?>" <?= $categoria === $cat ? "selected" : "" ?>>
                                    <?= e($cat) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="botao secundario" type="submit">
                        PESQUISAR
                    </button>
                    <a class="botao cinza" href="favoritos.php">
                        LIMPAR
                    </a>
                </form>
            </section>
            <div class="grade-sites">
                <?php if (!$sites): ?>
                    <div class="vazio painel">
                        Nenhum site encontrado. O catálogo está tão vazio que até o Internet Explorer se sentiria em casa.
                    </div>
                <?php endif; ?>
                <?php foreach ($sites as $site): ?>
                    <article class="cartao-site">
                        <div class="foto-site">
                            <?php if ($site["foto"] && file_exists("uploads/sites/".$site["foto"])): ?>
                                <img src="uploads/sites/<?= e($site["foto"]) ?>" alt="<?= e($site["nome"]) ?>">
                            <?php else: ?>
                                <span>
                                    WEB
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="site-corpo">
                            <span class="categoria">
                                <?= e($site["categoria"]) ?>
                            </span>
                            <h2>
                                <?= e($site["nome"]) ?>
                            </h2>
                            <p>
                                <?= e($site["descricao"]) ?>
                            </p>
                            <a class="url" href="<?= e($site["url"]) ?>" target="_blank" rel="noopener">
                                <?= e($site["url"]) ?>
                            </a>
                            <small>
                                Cadastrado em
                                <?= date("d/m/Y H:i", strtotime($site["data_cadastro"])) ?>
                            </small>
                            <div class="acoes">
                                <a href="atualizar.php?id=<?= $site["id"] ?>" class="botao pequeno">
                                    EDITAR
                                </a>
                                <a href="excluir.php?id=<?= $site["id"] ?>" class="botao pequeno perigo">
                                    EXCLUIR
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </main>
    </body>
</html>
