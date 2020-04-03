<?php
     include "../classe/conecao.php";
     
    $Erro = "* Preenchemento obrigatórios";   
    $BiErro = "";
    $NomeErro = "";
    $ApelidoErro = "";
    $NumeroCartaErro = "";
    $EmailErro = "";
    $NomeUtilizadorErro = "";
    $PasswordErro = "";
    $DataNascimentoErro = "";

    $registo = TRUE;
    if (isset($_POST['registar'])) {

        if (empty($_POST['bi'])) {
            $BiErro = "Tens de informar seu número BI";
            $registo = FALSE;
        }else{
            $bi = $_POST['bi'];
            $verificar = $con->query("SELECT * FROM tbl_motorista WHERE BI = '$bi'");
            if ($verificar->num_rows > 0) {
                $BiErro = "Este BI já esta registado.";
                $registo = FALSE;
            }
        }

        if (empty($_POST['nome'])) {
            $NomeErro = "Informe seu nome";
            $registo = FALSE;
        }else{
            $nome = $_POST['nome'];
        }

         if (empty($_POST['apelido'])) {
            $ApelidoErro = "Tens de informar seu apelido";
            $registo = FALSE;
        }else{
            $apelido = $_POST['apelido'];
        }

         if (empty($_POST['numerocarta'])) {
            $NumeroCartaErro = "Tens de informar número de carta de condução";
            $registo = FALSE;
        }else{
            $numeroCarta = $_POST['numerocarta'];
        }

         if (empty($_POST['email'])) {
            $EmailErro = "Tens de informar qual seu email";
            $registo = FALSE;
        }else{
            $email = $_POST['email'];
            $verificar = $con->query("SELECT * FROM tbl_motorista WHERE Email = '$email'");
            if ($verificar->num_rows > 0) {
                $EmailErro = "Este Email já foi registado.";
                $registo = FALSE;
            }
        }

         if (empty($_POST['nomeutilizador'])) {
            $NomeUtilizadorErro = "Tens de informar seu Nome de Utilizador";
            $registo = FALSE;
        }else{
            $nomeUtiizador = $_POST['nomeutilizador'];

            $verificar = $con->query("SELECT * FROM tbl_motorista WHERE NomeUtilizador = '$nomeUtiizador'");
            if ($verificar->num_rows > 0) {
                $EmailErro = "Este Nome Utilizador já está sendo utilizado.";
                $registo = FALSE;
            }
        }

         if (empty($_POST['password'])) {
            $PasswordErro = "Tens de informar seu password";
            $registo = FALSE;
        }else{
            $password = $_POST['password'];
        }

         if (empty($_POST['datanascimento'])) {
            $DataNascimentoErro = "Tens de informar sua Data de Nascimento";
            $registo = FALSE;
        }else{
            $dataNascimento = $_POST['datanascimento'];
        }

        if ($registo == TRUE) {
            $data = date("Y-m-d");

            $Inserir = $con->query("INSERT INTO tbl_motorista(BI, Nome, Apelido, DataNascimento, NumeroCarta, Email, NomeUtilizador, Password, DataRegisto) 
                                    VALUES ('$bi', '$nome', '$apelido', '$dataNascimento', '$numeroCarta', '$email', '$nomeUtiizador', '$password', '$data')");
            if ($Inserir) {
                session_start();
                $_SESSION['motorista'] = $bi;
                header("location: conta/");
            } else {
                $Erro = "Erro ao gravar os dados. Tente novamente mas tarde.";
            }
            
        } else {
            $Erro = "Alguns dados informados estão incorretos.";
        }
        

    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi - Particular</title>
    <link rel="stylesheet" href="../css/particular.css">
</head>
<body>
    
    <div id="corpo">
        <?php
            $pagina = "particular";
            include "../include/cabecalho.php";
        ?>
        
        <!-- Formulario de registro-->        
        <section id="home">  
            <h1>Torne-seum Motorista NhaTaxi</h1>
            <h5>Trabalhe como você merece e fice mas perto de seus Clientes</h5>

            <img src="../img/embreve.png">
            
            <form id="formulario_particular" method="POST">

                <h2>Registe-se Agora</h2>
                <p>E popularize seu trabalho</p>

                <span class="error"><?php if ($Erro != "") {            
                    echo $Erro; }?></span>

                    <br>
                
                <input type="number" placeholder="BI" name="bi">
                <span class="error">* <br>
                        <?php if ($BiErro != "") {
                        echo $BiErro;
                        }  ?>
                    </span><br>  

                <input type="text" placeholder="Nome" name="nome">
                <span class="error">* <br>
                        <?php if ($NomeErro != "") {
                        echo $NomeErro;
                        }  ?>
                    </span><br>

                <input type="text" placeholder="Apelido" name="apelido">                
                <span class="error">* <br>
                        <?php if ($ApelidoErro != "") {
                        echo $ApelidoErro;
                        }  ?>
                    </span><br>
  

                <input type="number" placeholder="Número Carta" name="numerocarta">
                <span class="error">* <br>
                        <?php if ($NumeroCartaErro != "") {
                        echo $NumeroCartaErro;
                        }  ?>
                    </span><br>

                <input type="text" placeholder="E-mail" name="email">
                <span class="error"><br>
                        <?php if ($EmailErro != "") {
                        echo $EmailErro;
                        }  ?>
                    </span><br>   

                <input type="text" placeholder="Nome Utilizador" name="nomeutilizador">
                <span class="error"><br>
                        <?php if ($NumeroCartaErro != "") {
                        echo $NumeroCartaErro;
                        }  ?>
                    </span><br>

                <input type="password" placeholder="Senha" name="password"> 
                <span class="error">* <br>
                        <?php if ($PasswordErro != "") {
                        echo $PasswordErro;
                        }  ?>
                    </span><br>  

                <label for="DataNascimento">Data Nascimento</label>
                <input type="date"  name="datanascimento">   
                <span class="error">* <br>
                        <?php if ($DataNascimentoErro != "") {
                        echo $DataNascimentoErro;
                        }  ?>
                    </span><br>       

                <input type="submit" value="Registar" name="registar">
            </form>
        </section>
        
        
         <?php
            $onde = "";
            include "../include/rodape.php";
        ?>
        
    </div
    
</body>
</html>