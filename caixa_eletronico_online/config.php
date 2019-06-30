<?php
$db_info = "mysql:dbname=caixa;host:localhost";
$db_user = "root";
$db_senha = "teste";

try{
    $pdo = new PDO($db_info, $db_user, $db_senha);
}catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}


?>
