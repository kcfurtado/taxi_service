<?php

    session_start();

    if (!$_SESSION['user']) {
        header("Location: ../");
    }

    if (isset($_POST['btnsair'])) {
       session_unset();
       session_destroy();
       header("Location: ../");
    }

    function ola(){
        echo '<script> alert("sou eu Oooooooooooooooooooooooooo"); </script>';
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi - Viagens</title>
    <link rel="stylesheet" href="../../css/conta.css">
</head>
<body>
    <div id="corpo">
        <header>
            <h1><a href="../../"><samp>Nha</samp>Taxi</a></h1>
            <nav>
                <li><a class="ativo" href="#">Pedir Taxi</a></li>
                <li><a href="#">Viagens</a></li>
                <li><a href="perfil.php">Dados Pessoais</a></li>
                <li><a href="avaliacao.php">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
        
        <section id="pedir">
            <div id="ct">
                <div id="for">
                    <form action="" method="POST">
                        <input type="text" placeholder="Origen" name="origen"><br>
                        <input type="text" placeholder="Destino" name="destino"><br>
                        <input type="text" name="taxi">
                        <input type="submit" value="Fazer Pedido">
                    </form>
                </div>
                <div id="seltaxi">
                    <h3>Taxís despoiveis no momento</h3>
                    <table>
                        <tr>
                            <th>Taxi</th>
                            <th>Motorista</th>
                        </tr>
                        <tr>
                            <td>ST-20-MS</td>
                            <td>Kelton Furtado</td>
                            <td><a id="1" class="selected" href="#">Selecionar</a></td>
                        </tr>
                        <tr>
                            <td>ST-00-TG</td>
                            <td>Txaka Zula</td>
                             <td><a id="2" class="select" href="#">Selecionar</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>

         <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
    </div
</body>
</html>