<?php
session_start();
require 'config.php';

if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];
    $valor = str_replace(",", ".", $_POST['valor']);
    $valor = floatval($valor);


    $sql = "INSERT INTO historico SET id_conta = :id_conta, tipo = :tipo, valor = :valor, data_operacao = NOW()";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id_conta", $_SESSION['banco']);
    $sql->bindValue(":tipo", $tipo);
    $sql->bindValue(":valor", $valor);
    $sql->execute();

    if ($tipo == '0') {
        //Deposito
        $sql = "UPDATE contas SET saldo = saldo + :valor WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $_SESSION['banco']);

        $sql->execute();
    } else {
        //Saque
        $sql = "UPDATE contas SET saldo = saldo - :valor WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $_SESSION['banco']);

        $sql->execute();
    }

    header("Location: index.php");
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

    <title>Adicionar transação</title>


</head>

<body>

    <div class="container">

        <div class="row mt-5">
            <div class="col-4 offset-4">
                <form method="POST">
                    <h5>Tipo de transação:</h5>
                    <div class="form-froup">
                        <select name="tipo" class="form-control">
                            <option value="0">Depósito</option>
                            <option value="1">Saque</option>
                        </select>
                    </div>

                    <h5>Valor:</h5>
                    <div class="form-grouo">
                        <input class="form-control" type="text" name="valor" pattern="[0-9.,]{1,}"> <br>
                    </div>

                    <input type="submit" value="Fazer operação" class="btn btn-success">
                </form>
            </div>
        </div>





        <!-- scripts-->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>