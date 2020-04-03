<?php
    include "../../classe/conecao.php";

    session_start();


    if (!$_SESSION['motorista']) {
        header("Location: ../");
    }

     $id = $_GET['veiculo'];

    $Erro = "";
    $registo = TRUE;

    if (isset($_POST['Alterar'])) {
       //verificar se os campos não estão vazios
         if (empty($_POST['Matricula'])) {
            $Erro = "Tens de informar a Matricula do Veiculo";
            $registo = FALSE;
         }else{
            $Matricula =  $_POST['Matricula'];
        }

            if (empty($_POST['Marca'])) {
                $Erro = "Tens de inserir a Marca do seu veiculo.";
                $registo = FALSE;
            }else{
                $Marca = $_POST['Marca'];
            }

             if (empty($_POST['Modelo'])) {
                $Erro = "Tens de inserir o Modelo do seu veiculo.";
                $registo = FALSE;
            }else{
                $Modelo = $_POST['Modelo'];
            }

            if (empty($_POST['Ilha'])) {
                $Erro = "Tens de informar a Ilha onde irás trabalhar com veiculo.";
                $registo = FALSE;
            }else{
                $Ilha = $_POST['Ilha'];
            }

             if (empty($_POST['Cidade'])) {
                $Erro = "Tens de inserir a cidade onde irás trabalhar com veiculo.";
                $registo = FALSE;
            }else{
                $Cidade = $_POST['Cidade'];
            }

            $dataRegisto = date("Y-m-d");


            if (empty($_POST['DataCompra'])) {
                $Erro = "Tens de inserir a Data de Compra do Veiculo.";
                $registo = FALSE;
            }else{
                $DataCompra = $_POST['DataCompra'];
            }

             $Garantia = $_POST['Garantia'];


             //registar no bd 
              if ($registo == TRUE) {
                  $Insere = $con->query("UPDATE tbl_taxi SET Matricula = '$Matricula', Marca = '$Marca', Modelo = '$Modelo', Ilha = '$Ilha', Cidade = '$Cidade', DataCompra = '$DataCompra', Garantia = '$Garantia' WHERE ID = '$id'");

                  if ($Insere) {
                      header("Location: meuTaxi.php");
                  }else{
                       $Erro = "Erro ao gravar os dados. Tente novamente mas tarde.";           
                  }
              } else {
            //$Erro = "Alguns dados informados estão incorretos.";
            //echo '<script> alert("Alguns dados informados estão incorretos."); </script>';
        }
      
    }

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Alterar Dados</title>
    <link rel="stylesheet" href="../../css/conta.css">
    <link rel="stylesheet" href="../../css/particular_sub.css">
</head>
<body>
    <div id="corpo">
        <header>
            <h1><a href="../../"><samp>Nha</samp>Taxi</a></h1>
            <nav>
                <li><a href="index.php">Viagens</a></li>
                <li><a class="ativo" href="meuTaxi.php">Meus Taxís</a></li>
                <li><a href="#">Dados Pessoais</a></li>
                <li><a href="#">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
     <section id="alterar">
            <form method="POST">

                <?php
                  //Alterar dados
                        $pegar = $con->query("SELECT * FROM tbl_taxi WHERE ID = '$id'");
                        $dados = $pegar->fetch_assoc();

                        echo '
                             <h2>Altere dados do seu veiculo</h2><br>

                            <span style="color: red">'.$Erro.'</span><br>
                            <input type="text" name="Matricula" value="'.$dados['Matricula'].'" placeholder="Matricula" required><br>
                            <input type="text" name="Marca" value="'.$dados['Marca'].'" placeholder="Marca" required><br>
                            <input type="text" name="Modelo" value="'.$dados['Modelo'].'" placeholder="Modelo" required><br>
                            <select name="Ilha" id="" value="'.$dados['Ilha'].'" required>
                                <option value="'.$dados['Ilha'].'">'.$dados['Ilha'].'</option>
                                <option value="Fogo">Fogo</option>
                                <option value="Santiago">Santiago</option>
                                <option value="Maio">Maio</option>
                                <option value="São Niculau">São Niculau</option>
                                <option value="Boavista">Boavista</option>
                                <option value="Sal">Sal</option>
                                <option value="São Vicente">São Vicente</option>
                                <option value="Santo Antão">Santo Antão</option>
                            </select><br>
                            <input type="text" name="Cidade" value="'.$dados['Cidade'].'" placeholder="Cidade"><br>
                            
                            <input type="number" value="'.$dados['Garantia'].'" name="Garantia" placeholder="Anos de Garantia"><br>
                            <br>
                            <label for="datacompra">Data de Compra</label>
                            <input type="date" value="'.$dados['DataCompra'].'" name="DataCompra" id="datacompra" placeholder="Data Compra" required><br><br>
                            <input class="btn" type="submit" name="Alterar" value="Alterar">
                        ';
                      ?>
            </form>
        </section>

        <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
        </div>
</body>
</html>