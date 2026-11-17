<?php
$dns = "mysql:host=127.0.0.1;dbname=weboteca;charset=utf8mb4";
$user = "root";
$pass = "";
try {
    $conexao = new PDO($dns, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
                                                                                            } catch (PDOException $erro) {
    die("Não foi possível conectar ao banco de dados. Verifique o XAMPP e o MySQL.");
}
?>
