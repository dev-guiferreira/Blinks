<?php
require_once "config.php";
exigirAdmin();
require_once "_conexao.php";
$id=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
if(!$id || $id===$_SESSION["usuario"]["id"]) redirecionar("usuarios.php");
$stmt=$conexao->prepare("SELECT foto FROM usuarios WHERE id=:id");
$stmt->execute([":id"=>$id]);
$u=$stmt->fetch();
if($u){
    $conexao->prepare("DELETE FROM sites_favoritos WHERE usuario_id=:id")->execute([":id"=>$id]);
    $conexao->prepare("DELETE FROM usuarios WHERE id=:id")->execute([":id"=>$id]);
    if($u["foto"]&&file_exists(__DIR__."/uploads/usuarios/".$u["foto"])) unlink(__DIR__."/uploads/usuarios/".$u["foto"]);
                                                                                                            }
redirecionar("usuarios.php?ok=1");
?>
