<?php
session_start();
require "config.php";

if (isset($_SESSION['banco']) && !empty($_SESSION['banco'])) {
    $id = $_SESSION['banco'];

    $sql = "SELECT * from contas WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
    } else {
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
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

    <title>Banco</title>


</head>

<body class="fundo">

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 box-inicio offset-3">
                <h1 class="text-center">Banco XYZ</h1>
                Titular: <?php echo $dados['titular']  ?> <br>
                Agência: <?php echo $dados['agencia']  ?> <br>
                Conta: <?php echo $dados['conta'] ?> <br>
                Saldo: <?php echo $dados['saldo']  ?> <br>
            </div>
        </div>
        <br>


        <a class="btn btn-danger offset-11" href="sair.php">Sair</a>
        <hr>
        <a href="adicionar_transacao.php" class="btn btn-success offset-11">Adicionar transação</a>

        <h3>Movimentação/Extrato</h3>


        <table border="1" class="table col-3 table-striped">
            <tr>
                <th>Data</th>
                <th>Valor</th>
            </tr>
            <?php
            $sql = "SELECT * FROM historico WHERE id_conta = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll();
                foreach ($dados as $item) {
                    echo "<tr>";
                    echo "<td>";
                    echo date('d/m/Y H:i', strtotime($item['data_operacao']));
                    echo "</td>";

                    if ($item['tipo'] == '0') {
                        echo "<td>";
                        echo "<font color='green'>" . $item['valor'] . "</font>";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        echo "<font color='red'>" . $item['valor'] . "</font>";
                        echo "</td>";
                    }

                    echo "</tr>";
                }
            }





            ?>




        </table>

    </div>






    <!-- scripts-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>



</html>