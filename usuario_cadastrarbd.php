<?php
require_once "config.php";
exigirAdmin();
require_once "_conexao.php";
$nome=trim($_POST["nome"]??"");
$usuario=trim($_POST["usuario"]??"");
$senha=$_POST["senha"]??"";
$perfil=$_POST["perfil"]??"usuario";
if($nome===""||$usuario===""||strlen($senha)<6||!in_array($perfil,["admin","usuario"],true)) die("Dados inválidos.");
$foto="";
if(!empty($_FILES["foto"]["name"])){
    $ext=strtolower(pathinfo($_FILES["foto"]["name"],PATHINFO_EXTENSION));
    if(!in_array($ext,["jpg","jpeg","png","webp"],true)) die("Foto inválida.");
    $foto=uniqid("user_",true).".".$ext;
    move_uploaded_file($_FILES["foto"]["tmp_name"],__DIR__."/uploads/usuarios/".$foto);
                        }
try {
    $stmt=$conexao->prepare("INSERT INTO usuarios(nome,usuario,senha,perfil,foto) VALUES(:nome,:usuario,:senha,:perfil,:foto)");
    $stmt->execute([":nome"=>$nome,":usuario"=>$usuario,":senha"=>password_hash($senha,PASSWORD_DEFAULT),":perfil"=>$perfil,":foto"=>$foto]);
    redirecionar("usuarios.php?ok=1");
                                                                            } catch(PDOException $e){
    die("Não foi possível cadastrar. O usuário pode já existir.");
}
?>
