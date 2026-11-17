<?php
require_once "config.php";
exigirAdmin();
require_once "_conexao.php";
$id=filter_input(INPUT_POST,"id",FILTER_VALIDATE_INT);
$nome=trim($_POST["nome"]??"");
$usuario=trim($_POST["usuario"]??"");
$perfil=$_POST["perfil"]??"usuario";
$ativo=(int)($_POST["ativo"]??1);
$senha=$_POST["senha"]??"";
$stmt=$conexao->prepare("SELECT * FROM usuarios WHERE id=:id");
$stmt->execute([":id"=>$id]);
$u=$stmt->fetch();
if(!$u) redirecionar("usuarios.php");
$foto=$u["foto"];
if(!empty($_FILES["foto"]["name"])){
    $ext=strtolower(pathinfo($_FILES["foto"]["name"],PATHINFO_EXTENSION));
    if(!in_array($ext,["jpg","jpeg","png","webp"],true)) die("Foto inválida.");
    if($foto&&file_exists(__DIR__."/uploads/usuarios/".$foto)) unlink(__DIR__."/uploads/usuarios/".$foto);
    $foto=uniqid("user_",true).".".$ext;
    move_uploaded_file($_FILES["foto"]["tmp_name"],__DIR__."/uploads/usuarios/".$foto);
                                                        }
if($senha!==""){
    $stmt=$conexao->prepare("UPDATE usuarios SET nome=:nome,usuario=:usuario,senha=:senha,perfil=:perfil,ativo=:ativo,foto=:foto WHERE id=:id");
    $stmt->execute([":nome"=>$nome,":usuario"=>$usuario,":senha"=>password_hash($senha,PASSWORD_DEFAULT),":perfil"=>$perfil,":ativo"=>$ativo,":foto"=>$foto,":id"=>$id]);
                        } else {
    $stmt=$conexao->prepare("UPDATE usuarios SET nome=:nome,usuario=:usuario,perfil=:perfil,ativo=:ativo,foto=:foto WHERE id=:id");
    $stmt->execute([":nome"=>$nome,":usuario"=>$usuario,":perfil"=>$perfil,":ativo"=>$ativo,":foto"=>$foto,":id"=>$id]);
                                                                                                                        }
if($id===$_SESSION["usuario"]["id"]){
    $_SESSION["usuario"]["nome"]=$nome;
    $_SESSION["usuario"]["usuario"]=$usuario;
    $_SESSION["usuario"]["perfil"]=$perfil;
    $_SESSION["usuario"]["foto"]=$foto;
                                                                                                            }
redirecionar("usuarios.php?ok=1");
?>
