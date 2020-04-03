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

    $bi= $_SESSION['user'];
    $con = new mysqli("localhost","root","","bd_taxi");
    $query=" SELECT * FROM tbl_usuario where BI ='$bi'";
    $Selecionar = $con->query($query);
    $get = $Selecionar->fetch_assoc();  
    if($get['Sexo']==1){
        $sexo= "Masculino";
    }else{
        $sexo= "Feminino";
    }
    if(isseT($_POST['guardar'])){
        $bi = $con->real_escape_string(trim($_POST['BI']));
        $nome = $con->real_escape_string(trim($_POST['Nome']));
        $apelido = $con->real_escape_string(trim($_POST['Apelido']));
        $dat = $con->real_escape_string(trim($_POST['DataNascimento']));
        $sexo = $con->real_escape_string(trim($_POST['Sexo']));
        $emai = $con->real_escape_string(trim($_POST['Email']));
        $password = $con->real_escape_string(trim($_POST['Password']));
        
        $query = "UPDATE tbl_usuario 
                  SET BI ='$bi', Nome='$nome', Apelido='$apelido', DataNascimento='$dat', Sexo='$sexo', Email='$emai', Password='$password'
                  WHERE  BI='$bi'
                   ";
        if($con->query($query) === TRUE){
            header("Location: index.php");
        }
        
    }                  
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi - Perfil</title>
    <link rel="stylesheet" href="../../css/conta.css">
    <link rel="stylesheet" href="../../css/cliente.css">
    <script type="text/javascript" src="../../js/funcoes.js"></script>
</head>
<body>
    <div id="corpo">
        <header>
            <h1><a href="../../"><samp>Nha</samp>Taxi</a></h1>
            <nav>
                <li><a href="#">Viagens</a></li>
                <li><a  href="#">Pedir Taxi</a></li>
                <li><a  href="perfil.php">Dados Pessoais</a></li>
                <li><a class="ativo" href="#">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
        
        <section id="avalia">
            <div id="dados-avaliar">
                <div id="avaliar">
                    <form method="POST">
                        <label>Reportar aqui...</label><br>
                        <textarea name="comentario" rows="7" cols="50"></textarea><br>
                        <input  id="avaliar" type="submit" name="avaliar" value="avaliar"><br>
                        
                    </form>
                </div> 
                <div id="ver-avalia">
                </div>              
            </div>
        </section>

         <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
    </div>
</body>
</html>