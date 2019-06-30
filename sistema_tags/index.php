<?php
require 'config.php';


$sql = "SELECT caracteristicas FROM usuarios";
$sql = $pdo->query($sql);

if($sql->rowCount() > 0){
    $lista = $sql->fetchAll();

    $carac = array();

    foreach($lista as $usuario){
        $palavras = explode(",", $usuario['caracteristicas']);
        foreach($palavras as $palavra){
            $palavra = trim($palavra);

            if(isset($carac[$palavra])){
                $carac[$palavra]++;
            }
            else{
                $carac[$palavra] = 1;
            }
        }
      
    }

    arsort($carac);

    $palavras = array_keys($carac);
    $contagens = array_values($carac);

    $tamanhos = array(11,15,20,30);
    

    $maior_contagem = max($contagens);

    for ($i=0; $i < count($palavras);$i++) { 
        $n = $contagens[$i] / $maior_contagem;

        $h = ceil($n * count($tamanhos));

        echo "<p style='font-size:".$tamanhos[$h-1]."px'>".$palavras[$i]." </p>";
        
    }

}





?>