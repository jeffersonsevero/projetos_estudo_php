<?php
session_start();
//destruir sessão
unset($_SESSION['banco']);
header("Location: index.php");
exit();

?>