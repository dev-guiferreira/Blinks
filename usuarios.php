<?php require_once "config.php"; exigirAdmin(); require_once "_conexao.php"; $usuarios = $conexao->query("SELECT id,nome,usuario,perfil,ativo,foto,data_cadastro FROM usuarios ORDER BY nome")->fetchAll(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>
            Usuários | BLinks 
        </title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require "_menu.php"; ?>
        <main class="container">
            <div class="titulo-pagina">
                <div>
                    <span class="etiqueta">
                        ADMINISTRAÇÃO
                    </span>
                    <h1>
                        Usuários do sistema
                    </h1>
                    <p>
                        Somente administradores possuem acesso a este cadastro.
                    </p>
                </div>
                <a class="botao" href="usuario_cadastrar.php">
                    + NOVO USUÁRIO
                </a>
            </div>
            <div class="painel">
                <table>
                    <thead>
                        <tr>
                            <th>
                                Foto
                            </th>
                            <th>
                                Nome
                            </th>
                            <th>
                                Usuário
                            </th>
                            <th>
                                Perfil
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Cadastro
                            </th>
                            <th>
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $u): ?>
                            <tr>
                                <td>
                                    <?php if($u["foto"]): ?>
                                        <img class="avatar-mini" src="uploads/usuarios/<?= e($u["foto"]) ?>" alt="Foto">
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= e($u["nome"]) ?>
                                </td>
                                <td>
                                    <?= e($u["usuario"]) ?>
                                </td>
                                <td>
                                    <span class="badge">
                                        <?= e($u["perfil"]) ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $u["ativo"] ? "ATIVO" : "INATIVO" ?>
                                </td>
                                <td>
                                    <?= date("d/m/Y",strtotime($u["data_cadastro"])) ?>
                                </td>
                                <td>
                                    <a class="botao pequeno" href="usuario_atualizar.php?id=<?= $u["id"] ?>">
                                        EDITAR
                                    </a>
                                    <?php if($u["id"] != $_SESSION["usuario"]["id"]): ?>
                                        <a class="botao pequeno perigo" href="usuario_excluir.php?id=<?= $u["id"] ?>">
                                            EXCLUIR
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
