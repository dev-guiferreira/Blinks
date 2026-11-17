<?php
require_once "config.php";
require_once "_conexao.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirecionar("index.php");
                                                                                                                                    }

$usuario = trim($_POST["usuario"] ?? "");
$senha = $_POST["senha"] ?? "";
$stmt = $conexao->prepare("SELECT id, nome, usuario, senha, perfil, foto FROM usuarios WHERE usuario = :usuario AND ativo = 1 LIMIT 1");
$stmt->execute([":usuario" => $usuario]);
$dados = $stmt->fetch();
if ($dados && password_verify($senha, $dados["senha"])) {
    session_regenerate_id(true);
    unset($dados["senha"]);
    $_SESSION["usuario"] = $dados;
    redirecionar("favoritos.php");
                                                                                                                        }

redirecionar("index.php?erro=login");
?>