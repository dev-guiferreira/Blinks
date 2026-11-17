<?php
require_once "config.php";
exigirLogin();
require_once "_conexao.php";
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$stmt = $conexao->prepare("SELECT foto FROM sites_favoritos WHERE id=:id AND usuario_id=:usuario_id");
$stmt->execute([":id"=>$id,":usuario_id"=>$_SESSION["usuario"]["id"]]);
$site = $stmt->fetch();
if ($site) {
    $del = $conexao->prepare("DELETE FROM sites_favoritos WHERE id=:id AND usuario_id=:usuario_id");
    $del->execute([":id"=>$id,":usuario_id"=>$_SESSION["usuario"]["id"]]);
    if ($site["foto"] && file_exists(__DIR__."/uploads/sites/".$site["foto"])) unlink(__DIR__."/uploads/sites/".$site["foto"]);
                                                                                                                }
redirecionar("favoritos.php?ok=1");
?>
