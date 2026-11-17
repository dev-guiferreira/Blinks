<?php
require_once "config.php";

exigirLogin();

require_once "_conexao.php";

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

$nome = trim($_POST["nome"] ?? "");

$url = trim($_POST["url"] ?? "");

$descricao = trim($_POST["descricao"] ?? "");

$categoria = trim($_POST["categoria"] ?? "");

$stmt = $conexao->prepare("SELECT * FROM sites_favoritos WHERE id=:id AND usuario_id=:usuario_id");

$stmt->execute([":id"=>$id,":usuario_id"=>$_SESSION["usuario"]["id"]]);

$site = $stmt->fetch();

if (!$site) redirecionar("favoritos.php");

$foto = $site["foto"];

if (!empty($_FILES["foto"]["name"])) {

    $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));

    if (!in_array($ext, ["jpg","jpeg","png","webp"], true) || $_FILES["foto"]["size"] > 5*1024*1024) die("Imagem inválida.");

    if ($foto && file_exists(__DIR__."/uploads/sites/".$foto)) unlink(__DIR__."/uploads/sites/".$foto);

    $foto = uniqid("site_", true).".".$ext;

    move_uploaded_file($_FILES["foto"]["tmp_name"], __DIR__."/uploads/sites/".$foto);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }

$stmt = $conexao->prepare("UPDATE sites_favoritos SET nome=:nome,url=:url,descricao=:descricao,categoria=:categoria,foto=:foto WHERE id=:id AND usuario_id=:usuario_id");

$stmt->execute([":nome"=>$nome,":url"=>$url,":descricao"=>$descricao,":categoria"=>$categoria,":foto"=>$foto,":id"=>$id,":usuario_id"=>$_SESSION["usuario"]["id"]]);

redirecionar("favoritos.php?ok=1");
?>
