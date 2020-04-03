<?php

    include "../../classe/conecao.php";

    session_start();


    if (!$_SESSION['motorista']) {
        header("Location: ../");
    }

    if (isset($_POST['btnsair'])) {
       session_unset();
       session_destroy();
       header("Location: ../");
    }

    //Para fazer a inserção dos taxis o sistema
    $Erro = "";
    $registo = TRUE;

    if (isset($_POST['Registar'])) {
       //verificar se os campos não estão vazios
         if (empty($_POST['Matricula'])) {
            $Erro = "Tens de informar a Matricula do Veiculo";
            $registo = FALSE;
         }else{
            $Matricula =  $_POST['Matricula'];
            $verificar = $con->query("SELECT * FROM tbl_taxi WHERE Matricula = '$Matricula'");
            if ($verificar->num_rows > 0) {
                $Erro = "Já existe um veiculo com esta Matricula.";
                $registo = FALSE;
            }
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
                  $Insere = $con->query("INSERT INTO tbl_taxi(Matricula, Marca, Modelo, Ilha, Cidade, DataRegisto, DataCompra, Garantia) 
                  VALUES ('$Matricula', '$Marca', '$Modelo', '$Ilha', '$Cidade', '$dataRegisto', '$DataCompra', '$Garantia')");

                  if ($Insere) {
                      //header("Location: taxi/particular/conta/meuTaxi.php");
                    //  $Erro = "Sucesso.";
                     // echo '<script> alert("Sucesso."); </script>';

                  }else{
                       $Erro = "Erro ao gravar os dados. Tente novamente mas tarde.";
                      // echo '<script> alert("Erro ao gravar os dados. Tente novamente mas tarde."); </script>';
           
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
    <title>Meus Taxís</title>
    <link rel="stylesheet" href="../../css/conta.css">
    <link rel="stylesheet" href="../../css/particular_sub.css">
    <script src="../../js/funcoes.js"></script>
</head>
<body>
    <div id="corpo">
        <header>
            <h1><a href="../../"><samp>Nha</samp>Taxi</a></h1>
            <nav>
                <li><a href="index.php">Viagens</a></li>
                <li><a class="ativo" href="meuTaxi.php">Meus Taxís</a></li>
                <li><a href="pessoais.php">Dados Pessoais</a></li>
                <li><a href="#">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
        
        <section id="meutaxi">
            <a id="novo" href="javascript:void(0)" onclick="mostrar('inserir',0.01);">Inserir Novo</a>

            <table id="tbltaxi">
                <tr>
                    <th>Matricula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th></th>
                </tr>

                <?php
                    $Selecionar = $con->query("SELECT ID, Matricula, Marca, Modelo FROM tbl_taxi");

                    if ($Selecionar->num_rows > 0) {
                         while ($linha = $Selecionar->fetch_assoc()) {
                        echo '
                            <tr>
                                <td>'.$linha["Matricula"].'</td>
                                <td>'.$linha["Marca"].'</td>
                                <td>'.$linha["Modelo"].'</td>
                                <td><a class="manipular" href="alterar.php?veiculo='.$linha["ID"].'">Alterar</a> <a class="manipular" href="eliminar.php?veiculo='.$linha["ID"].'">Eliminar</a></td>
                            </tr>
                        ';
                    }
                    } else {
                        echo '
                            <tr>
                                <td>Não possui nenhum taxi!</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        ';
                    }
                    
                   
                ?>
            </table>
        </section>

        <section id="inserir">
            <a id="fechar" href="javascript:void(0)" onclick="ocultar('inserir', 0.01);">X</a>
            <form method="POST">

                            <h2>Registe seu veiculo</h2><br>

                            <span><?php if ($Erro != "") {
                                echo $Erro;
                            } ?></span><br>

                            <input type="text" name="Matricula" placeholder="Matricula" required>
                            <input type="text" name="Marca" placeholder="Marca" required>
                            <input type="text" name="Modelo" placeholder="Modelo" required>
                            <select name="Ilha" id="" required>
                                <option value="">Selecione a Ilha</option>
                                <option value="Fogo">Fogo</option>
                                <option value="Santiago">Santiago</option>
                                <option value="Maio">Maio</option>
                                <option value="São Niculau">São Niculau</option>
                                <option value="Boavista">Boavista</option>
                                <option value="Sal">Sal</option>
                                <option value="São Vicente">São Vicente</option>
                                <option value="Santo Antão">Santo Antão</option>
                            </select>
                            <input type="text" name="Cidade" placeholder="Cidade">
                            
                            <input type="number" name="Garantia" placeholder="Anos de Garantia">
                            <br>
                            <label for="datacompra">Data de Compra</label>
                            <input type="date" name="DataCompra" id="datacompra" placeholder="Data Compra" required><br>
                            <input class="btn" type="submit" name="Registar" value="Registar">
                            <input class="btn" type="reset" value="Limpar">
            </form>
        </section>
            
         <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
    </div>

    <script>
       var error = '<?php echo $Erro; ?>';
       if(error != ""){
           document.getElementById('inserir').style.display = "block";
       }else{
            document.getElementById('inserir').style.display = "none";
       }
    </script>
</body>
</html>