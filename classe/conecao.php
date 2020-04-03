<?php
    $sevidor = "localhost";
    $utilizador = "root";
    $password = "";
    $bd = "bd_taxi";

    $con = new mysqli($sevidor, $utilizador, $password, $bd) or die("Não foi possível conectar ao servido no momento! Tente mais tarde.");
?>