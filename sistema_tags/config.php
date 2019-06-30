<?php
$db_infos = "mysql:dbname=pojeto_tags;host=localhost";
$db_user = "root";
$db_pass = "teste";

try{
    $pdo = new PDO($db_infos, $db_user, $db_pass);
}catch(PDOException $e){
    echo "ERROR: ".$e->getMessage();
    exit();
}


?>