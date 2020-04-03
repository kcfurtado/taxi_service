<?php
     include "../../classe/conecao.php";

    $id = $_GET['veiculo'];

    $elimina = $con->query("DELETE FROM tbl_taxi WHERE ID = '$id'");

    if ($elimina) {
        header("Location: /taxi/particular/conta/meuTaxi.php");
    }else{
        echo '<script> alert("Erro ao Eliminar. Tente novamete."); </script>';
    }
?>