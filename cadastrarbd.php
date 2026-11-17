<?php
require_once "config.php";

exigirLogin();

require_once "_conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") redirecionar("cadastrar.php");

$nome = trim($_POST["nome"] ?? "");

$url = trim($_POST["url"] ?? "");

$descricao = trim($_POST["descricao"] ?? "");

$categoria = trim($_POST["categoria"] ?? "");

if ($nome === "" || $url === "" || $descricao === "" || $categoria === "" || !filter_var($url, FILTER_VALIDATE_URL)) {
    die("Dados inválidos. <a href='cadastrar.php'>Voltar</a>");
                                            }

$foto = "";
if (!empty($_FILES["foto"]["name"])) {
    $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
    $permitidas = ["jpg","jpeg","png","webp"];
    if (!in_array($ext, $permitidas, true) || $_FILES["foto"]["size"] > 5 * 1024 * 1024) {
        die("Imagem inválida. Use JPG, PNG ou WEBP de até 5 MB.");
                                                                                                                                                        }
    $foto = uniqid("site_", true).".".$ext;
    move_uploaded_file($_FILES["foto"]["tmp_name"], __DIR__."/uploads/sites/".$foto);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }

$stmt = $conexao->prepare("INSERT INTO sites_favoritos (usuario_id,nome,url,descricao,categoria,foto) VALUES (:usuario_id,:nome,:url,:descricao,:categoria,:foto)");

$stmt->execute([":usuario_id"=>$_SESSION["usuario"]["id"],":nome"=>$nome,":url"=>$url,":descricao"=>$descricao,":categoria"=>$categoria,":foto"=>$foto]);

redirecionar("favoritos.php?ok=1");
?>
