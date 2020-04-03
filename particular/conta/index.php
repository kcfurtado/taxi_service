<?php
    session_start();

    if (!$_SESSION['motorista']) {
        header("Location: ../");
    }

    if (isset($_POST['btnsair'])) {
       session_unset();
       session_destroy();
       header("Location: ../");
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
                <li><a class="ativo" href="#">Viagens</a></li>
                <li><a href="meuTaxi.php">Meus Taxís</a></li>
                <li><a href="pessoais.php">Dados Pessoais</a></li>
                <li><a href="#">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
        
        <section id="viagen">
            <nav></nav>
        </section>

         <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
    </div
</body>
</html>