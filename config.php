<?php
session_start();
define("BASE_URL", "");
define("SITE_NAME", "Weboteca Clássica");
function usuarioLogado(): bool {
    return isset($_SESSION["usuario"]);
                                                                                                    }

function exigirLogin(): void {
    if (!usuarioLogado()) {
        header("Location: index.php");
        exit;
    }
                                                                                                    }

function exigirAdmin(): void {
    exigirLogin();
    if ($_SESSION["usuario"]["perfil"] !== "admin") {
        header("Location: favoritos.php?erro=permissao");
        exit;
    }
                                                                                                                        }

function e(?string $valor): string {
    return htmlspecialchars($valor ?? "", ENT_QUOTES, "UTF-8");
                                                                                                                                            }

function redirecionar(string $url): never {
    header("Location: ".$url);
    exit;
}
?>
