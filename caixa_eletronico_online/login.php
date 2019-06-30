<?php
session_start();
require "config.php";

if (!empty($_POST['agencia']) || !empty($_POST['conta']) || !empty($_POST['senha'])) {
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM contas WHERE agencia = :agencia AND conta = :conta AND senha = :senha";

    $sql = $pdo->prepare($sql);
    $sql->bindValue(":agencia", $agencia);
    $sql->bindValue(":conta", $conta);
    $sql->bindValue(":senha", $senha);

    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();

        //adicionar sessão
        $_SESSION['banco'] = $dados['id'];
        //redirecionando para index
        header("Location: index.php");
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Login - Banco</title>


</head>

<body>
    <div class="row align-items-start">
        <div class="col-3 offset-4">
            <div class="icone text-center">
                <i class="far fa-money-bill-alt mx-auto"></i>
            </div>

            <form method="POST">
                <div class="form-group">
                    <h5 class="p-auto">Agência:</h5>
                    <input class="form-control" type="text" name="agencia"> <br>
                </div>

                <div class="form-group">
                    <h5>Conta:</h5>
                    <input type="text" class="form-control" name="conta"> <br>
                </div>

                <div class="form-group">
                    <h5>Senha:</h5>
                    <input type="password" class="form-control" name="senha"> <br><br>
                </div>

                <input type="submit" value="Entrar" class="btn btn-success">
            </form>
        </div>
    </div>






    <!-- scripts-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>